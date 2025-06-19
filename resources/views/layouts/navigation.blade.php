<nav x-data="{ open: false, loginOpen: false, registerOpen: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="{{ asset('logo.svg') }}" alt="{{ config('app.name', 'SIP Calculator') }}" class="h-10 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <!-- Calculators Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            Calculators
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('sip-calculator') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">SIP Calculator</a>
                            <a href="{{ route('lumpsum-calculator') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Lumpsum Calculator</a>
                            <a href="{{ route('goal-based-calculator') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Goal-Based Calculator</a>
                            <a href="{{ route('step-up-calculator') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Step-Up Calculator</a>
                        </div>
                    </div>

                    <!-- Mutual Funds Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            Mutual Funds
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('mutual-funds.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Browse Funds</a>
                            <a href="{{ route('mutual-funds.ranking') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Fund Rankings</a>
                            <a href="{{ route('mutual-funds.compare') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Compare Funds</a>
                        </div>
                    </div>

                    <x-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.*')">
                        {{ __('Blog') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('glossary')" :active="request()->routeIs('glossary')">
                        {{ __('Glossary') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                @csrf
                                <x-dropdown-link href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-4">
                        <button class="text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 open-login-modal">Log in</button>
                        <button class="text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 open-register-modal">Register</button>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <!-- Mobile Calculators -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">Calculators</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('sip-calculator')" :active="request()->routeIs('sip-calculator')">
                        SIP Calculator
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('lumpsum-calculator')" :active="request()->routeIs('lumpsum-calculator')">
                        Lumpsum Calculator
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('goal-based-calculator')" :active="request()->routeIs('goal-based-calculator')">
                        Goal-Based Calculator
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('step-up-calculator')" :active="request()->routeIs('step-up-calculator')">
                        Step-Up Calculator
                    </x-responsive-nav-link>
                </div>
            </div>

            <!-- Mobile Mutual Funds -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">Mutual Funds</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('mutual-funds.index')" :active="request()->routeIs('mutual-funds.index')">
                        Browse Funds
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('mutual-funds.ranking')" :active="request()->routeIs('mutual-funds.ranking')">
                        Fund Rankings
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('mutual-funds.compare')" :active="request()->routeIs('mutual-funds.compare')">
                        Compare Funds
                    </x-responsive-nav-link>
                </div>
            </div>

            <x-responsive-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.*')">
                {{ __('Blog') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('glossary')" :active="request()->routeIs('glossary')">
                {{ __('Glossary') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1">
                <button class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 open-login-modal">Log in</button>
                <button class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 open-register-modal">Register</button>
            </div>
        @endauth
    </div>

    <!-- Login Modal -->
    <div x-show="loginOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="loginOpen = false"></div>
            
            <div class="relative bg-white dark:bg-gray-800 rounded-lg max-w-md w-full p-6 shadow-xl">
                <div class="absolute right-4 top-4">
                    <button @click="loginOpen = false" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Login</h2>
                
                <div id="loginError" class="mb-4 text-sm text-red-600 dark:text-red-400" style="display: none;"></div>
                
                <form id="loginForm" onsubmit="handleLogin(event)">
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
                            <span class="text-red-500 text-sm error-email"></span>
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                            <span class="text-red-500 text-sm error-password"></span>
                        </div>

                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" name="remember" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <button type="button" @click="loginOpen = false; registerOpen = true" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                                {{ __('Need an account?') }}
                            </button>
                            <x-primary-button type="submit">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div x-show="registerOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="registerOpen = false"></div>
            
            <div class="relative bg-white dark:bg-gray-800 rounded-lg max-w-md w-full p-6 shadow-xl">
                <div class="absolute right-4 top-4">
                    <button @click="registerOpen = false" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Register</h2>
                
                <div id="registerError" class="mb-4 text-sm text-red-600 dark:text-red-400" style="display: none;"></div>
                
                <form id="registerForm" onsubmit="handleRegister(event)">
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                            <span class="text-red-500 text-sm error-name"></span>
                        </div>

                        <div>
                            <x-input-label for="reg_email" :value="__('Email')" />
                            <x-text-input id="reg_email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                            <span class="text-red-500 text-sm error-email"></span>
                        </div>

                        <div>
                            <x-input-label for="reg_password" :value="__('Password')" />
                            <x-text-input id="reg_password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                            <span class="text-red-500 text-sm error-password"></span>
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <span class="text-red-500 text-sm error-password_confirmation"></span>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <button type="button" @click="registerOpen = false; loginOpen = true" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                                {{ __('Already registered?') }}
                            </button>
                            <x-primary-button type="submit">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    function updateUIAfterAuth(userData) {
        // Close modals
        loginOpen = false;
        registerOpen = false;

        // Update navigation
        const navMenu = document.querySelector('.sm\\:flex.sm\\:items-center.sm\\:ml-6');
        if (navMenu) {
            navMenu.innerHTML = `
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>${userData.name}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                            @csrf
                            <x-dropdown-link href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            `;
        }

        // Update mobile menu
        const mobileMenu = document.querySelector('[x-show="open"]');
        if (mobileMenu) {
            mobileMenu.innerHTML = `
                <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">${userData.name}</div>
                        <div class="font-medium text-sm text-gray-500">${userData.email}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            `;
        }

        // Update any guest/auth elements
        document.querySelectorAll('[data-guest-only]').forEach(el => el.style.display = 'none');
        document.querySelectorAll('[data-auth-only]').forEach(el => el.style.display = 'block');
    }

    function handleLogin(event) {
        event.preventDefault();
        const form = event.target;
        const errorDiv = document.getElementById('loginError');
        const submitButton = form.querySelector('button[type="submit"]');
        
        // Clear previous errors
        errorDiv.style.display = 'none';
        errorDiv.textContent = '';
        form.querySelectorAll('.error-email, .error-password').forEach(el => el.textContent = '');
        
        // Disable submit button and show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = 'Logging in...';

        // Create form data
        const formData = new URLSearchParams();
        formData.append('email', form.email.value);
        formData.append('password', form.password.value);
        formData.append('remember', form.remember.checked ? '1' : '0');
        formData.append('_token', '{{ csrf_token() }}');

        // Make the request
        fetch('{{ route("login") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData.toString()
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(({ status, body }) => {
            if (status === 422) {
                throw new Error(JSON.stringify(body));
            }
            if (body.status === 'success') {
                updateUIAfterAuth(body.user);
            }
        })
        .catch(error => {
            submitButton.disabled = false;
            submitButton.innerHTML = 'Log in';
            
            try {
                const data = JSON.parse(error.message);
                if (data.errors) {
                    Object.entries(data.errors).forEach(([key, messages]) => {
                        const errorElement = form.querySelector(`.error-${key}`);
                        if (errorElement) {
                            errorElement.textContent = messages[0];
                        }
                    });
                }
            } catch (e) {
                errorDiv.textContent = 'An error occurred. Please try again.';
            }
            errorDiv.style.display = 'block';
        });
    }

    function handleRegister(event) {
        event.preventDefault();
        const form = event.target;
        const errorDiv = document.getElementById('registerError');
        const submitButton = form.querySelector('button[type="submit"]');
        
        // Clear previous errors
        errorDiv.style.display = 'none';
        errorDiv.textContent = '';
        form.querySelectorAll('.error-name, .error-email, .error-password, .error-password_confirmation').forEach(el => el.textContent = '');
        
        // Disable submit button and show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = 'Registering...';

        // Create form data
        const formData = new URLSearchParams();
        formData.append('name', form.name.value);
        formData.append('email', form.email.value);
        formData.append('password', form.password.value);
        formData.append('password_confirmation', form.password_confirmation.value);
        formData.append('_token', '{{ csrf_token() }}');

        // Make the request
        fetch('{{ route("register") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData.toString()
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(({ status, body }) => {
            if (status === 422) {
                throw new Error(JSON.stringify(body));
            }
            if (body.status === 'success') {
                updateUIAfterAuth(body.user);
            }
        })
        .catch(error => {
            submitButton.disabled = false;
            submitButton.innerHTML = 'Register';
            
            try {
                const data = JSON.parse(error.message);
                if (data.errors) {
                    Object.entries(data.errors).forEach(([key, messages]) => {
                        const errorElement = form.querySelector(`.error-${key}`);
                        if (errorElement) {
                            errorElement.textContent = messages[0];
                        }
                    });
                    errorDiv.textContent = 'Please fix the errors below.';
                }
            } catch (e) {
                errorDiv.textContent = 'An error occurred. Please try again.';
            }
            errorDiv.style.display = 'block';
        });
    }
</script>
@endpush
