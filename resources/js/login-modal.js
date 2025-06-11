document.addEventListener('DOMContentLoaded', function() {
    // Get modal elements
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');
    const openLoginButtons = document.querySelectorAll('.open-login-modal');
    const openRegisterButtons = document.querySelectorAll('.open-register-modal');
    const closeModalButtons = document.querySelectorAll('.close-modal');
    const submitLoginButton = document.getElementById('submitLoginForm');
    const submitRegisterButton = document.getElementById('submitRegisterForm');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

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
            loginForm.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        }
        if (registerForm) {
            registerForm.reset();
            registerForm.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        }
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

    // Handle login form submission
    if (submitLoginButton && loginForm) {
        submitLoginButton.addEventListener('click', function(e) {
            e.preventDefault();
            const formData = new FormData(loginForm);

            fetch(loginForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = data.redirect;
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        Object.entries(data.errors).forEach(([key, messages]) => {
                            const errorElement = loginForm.querySelector(`.error-${key}`);
                            if (errorElement) {
                                errorElement.textContent = messages[0];
                            }
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }

    // Handle register form submission
    if (submitRegisterButton && registerForm) {
        submitRegisterButton.addEventListener('click', function(e) {
            e.preventDefault();
            const formData = new FormData(registerForm);

            fetch(registerForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = data.redirect;
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        Object.entries(data.errors).forEach(([key, messages]) => {
                            const errorElement = registerForm.querySelector(`.error-${key}`);
                            if (errorElement) {
                                errorElement.textContent = messages[0];
                            }
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
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