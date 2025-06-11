document.addEventListener('DOMContentLoaded', function() {
    // Get modal elements
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');
    const openLoginButtons = document.querySelectorAll('.open-login-modal');
    const openRegisterButtons = document.querySelectorAll('.open-register-modal');
    const closeModalButtons = document.querySelectorAll('.close-modal');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Open login modal function
    function openLoginModal() {
        if (loginModal) {
            loginModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            if (registerModal) {
                registerModal.classList.add('hidden');
            }
        }
    }

    // Open register modal function
    function openRegisterModal() {
        if (registerModal) {
            registerModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            if (loginModal) {
                loginModal.classList.add('hidden');
            }
        }
    }

    // Close modal function
    function closeModal() {
        if (loginModal) {
            loginModal.classList.add('hidden');
        }
        if (registerModal) {
            registerModal.classList.add('hidden');
        }
        document.body.style.overflow = 'auto';
        // Clear forms and errors
        if (loginForm) {
            loginForm.reset();
            clearErrors(loginForm);
        }
        if (registerForm) {
            registerForm.reset();
            clearErrors(registerForm);
        }
    }

    // Clear error messages
    function clearErrors(form) {
        form.querySelectorAll('.error-message, .error-email, .error-password, .error-name, .error-password_confirmation')
            .forEach(el => el.textContent = '');
    }

    // Add click events to open modal buttons
    openLoginButtons.forEach(button => {
        button.addEventListener('click', openLoginModal);
    });

    openRegisterButtons.forEach(button => {
        button.addEventListener('click', openRegisterModal);
    });

    // Add click events to close modal buttons
    closeModalButtons.forEach(button => {
        button.addEventListener('click', closeModal);
    });

    // Close modals when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === loginModal || event.target === registerModal) {
            closeModal();
        }
    });

    // Handle form submissions
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(loginForm);

            // Send login request
            $.ajax({
                url: loginForm.action,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    clearErrors(loginForm);
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(key => {
                            const errorElement = loginForm.querySelector(`.error-${key}`);
                            if (errorElement) {
                                errorElement.textContent = errors[key][0];
                            }
                        });
                    }
                }
            });
        });
    }

    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(registerForm);

            // Send register request
            $.ajax({
                url: registerForm.action,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    clearErrors(registerForm);
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(key => {
                            const errorElement = registerForm.querySelector(`.error-${key}`);
                            if (errorElement) {
                                errorElement.textContent = errors[key][0];
                            }
                        });
                    }
                }
            });
        });
    }

    // Close modals on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
}); 