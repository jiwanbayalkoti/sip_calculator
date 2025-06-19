<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SIP Calculator') }}</title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Navigation -->
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}" class="flex items-center">
                                    <img src="{{ asset('logo.svg') }}" alt="{{ config('app.name', 'SIP Calculator') }}" class="h-10 w-auto">
                                </a>
                            </div>
                        </div>
                        <div class="flex items-center">
                            @if (Route::has('login'))
                                <div class="space-x-8 sm:-my-px sm:ml-10">
                                    @auth
                                        <a href="{{ route('dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">Dashboard</a>
                                        <form method="POST" action="{{ route('logout') }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">
                                                Logout
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">Log in</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Advertisement Banner -->
            <x-ad-banner />

            <!-- Main Content -->
            <main class="py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Hero Section -->
                    <div class="text-center mb-12">
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                            Plan Your <span class="text-blue-600 dark:text-blue-400">Financial Future</span>
                        </h1>
                        <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                            Calculate your SIP returns and discover how systematic investment can help you build wealth over time
                        </p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Calculator Form -->
                        <div class="lg:col-span-2">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                                <!-- Form Header -->
                                <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-white/20 rounded-lg p-2">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h2 class="text-2xl font-bold text-white">SIP Calculator</h2>
                                            <p class="text-blue-100">Enter your investment details below</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Content -->
                                <div class="p-8">
                                    <form id="sipForm" class="space-y-6">
                                        <!-- Monthly Investment -->
                                        <div class="relative">
                                            <label for="monthly_investment" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Monthly Investment Amount
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 dark:text-gray-400 text-lg font-medium">₹</span>
                                                </div>
                                                <input type="number" 
                                                       id="monthly_investment" 
                                                       name="monthly_investment" 
                                                       placeholder="10,000"
                                                       class="block w-full pl-8 pr-4 py-4 text-lg border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900 transition-all duration-200" 
                                                       required>
                                            </div>
                                            <span class="text-red-500 text-sm error-monthly_investment mt-1"></span>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Recommended: ₹5,000 - ₹50,000 per month</p>
                                        </div>

                                        <!-- Annual Return Rate -->
                                        <div class="relative">
                                            <label for="annual_return_rate" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Expected Annual Return Rate
                                            </label>
                                            <div class="relative">
                                                <input type="number" 
                                                       step="0.01" 
                                                       id="annual_return_rate" 
                                                       name="annual_return_rate" 
                                                       placeholder="12.00"
                                                       class="block w-full px-4 py-4 text-lg border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900 transition-all duration-200" 
                                                       required>
                                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 dark:text-gray-400 text-lg font-medium">%</span>
                                                </div>
                                            </div>
                                            <span class="text-red-500 text-sm error-annual_return_rate mt-1"></span>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Typical range: 8% - 15% for equity funds</p>
                                        </div>

                                        <!-- Investment Duration -->
                                        <div class="relative">
                                            <label for="investment_duration" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Investment Duration
                                            </label>
                                            <div class="relative">
                                                <input type="number" 
                                                       id="investment_duration" 
                                                       name="investment_duration" 
                                                       placeholder="10"
                                                       class="block w-full px-4 py-4 text-lg border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900 transition-all duration-200" 
                                                       required>
                                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 dark:text-gray-400 text-lg font-medium">years</span>
                                                </div>
                                            </div>
                                            <span class="text-red-500 text-sm error-investment_duration mt-1"></span>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Longer duration = Higher potential returns</p>
                                        </div>

                                        <!-- Calculate Button -->
                                        <button type="submit" 
                                                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-xl text-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 shadow-lg hover:shadow-xl">
                                            <div class="flex items-center justify-center space-x-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                                <span>Calculate Returns</span>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Results Display -->
                        <div class="lg:col-span-1">
                            <div id="results" class="results-display hidden">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                                    <!-- Results Header -->
                                    <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="bg-white/20 rounded-lg p-2">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-xl font-bold text-white">Your Results</h3>
                                                <p class="text-green-100">Investment summary</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Results Content -->
                                    <div class="p-6 space-y-6">
                                        <!-- Total Investment -->
                                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Investment</p>
                                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">₹<span id="total_investment">0</span></p>
                                                </div>
                                                <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-2">
                                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Total Interest -->
                                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Interest Earned</p>
                                                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">₹<span id="total_interest">0</span></p>
                                                </div>
                                                <div class="bg-green-100 dark:bg-green-900 rounded-lg p-2">
                                                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Maturity Amount -->
                                        <div class="bg-gradient-to-r from-purple-50 to-blue-50 dark:from-purple-900 dark:to-blue-900 rounded-xl p-4 border-2 border-purple-200 dark:border-purple-700">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-purple-600 dark:text-purple-400 font-medium">Maturity Amount</p>
                                                    <p class="text-3xl font-bold text-purple-700 dark:text-purple-300">₹<span id="maturity_amount">0</span></p>
                                                </div>
                                                <div class="bg-purple-100 dark:bg-purple-800 rounded-lg p-2">
                                                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Investment Tips -->
                                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 border border-blue-200 dark:border-blue-700">
                                            <div class="flex items-start space-x-3">
                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-blue-800 dark:text-blue-200">Investment Tip</p>
                                                    <p class="text-sm text-blue-700 dark:text-blue-300 mt-1">Start early and stay consistent. Even small amounts can grow significantly over time with compound interest.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- History Section -->
                    <div class="mt-12">
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                            <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-white/20 rounded-lg p-2">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-bold text-white">Recent Calculations</h3>
                                            <p class="text-gray-200">Your calculation history</p>
                                        </div>
                                    </div>
                                    @guest
                                        <div class="text-right">
                                            <p class="text-sm text-gray-200">
                                                <a href="{{ route('login') }}" class="text-blue-300 hover:text-blue-200 underline">Login</a>
                                                to save permanently
                                            </p>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                            <div class="p-6">
                                <div id="history" class="space-y-4">
                                    <!-- History items will be added here dynamically -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script>
            $(document).ready(function() {
                // Initialize localStorage history if not exists
                if (!localStorage.getItem('sipHistory')) {
                    localStorage.setItem('sipHistory', JSON.stringify([]));
                }

                // Load history from localStorage or server
                function loadHistory() {
                    @auth
                        // For authenticated users, load from server
                        $.get('{{ route("sip.history") }}', function(response) {
                            if (response.status === 'success') {
                                displayHistory(response.history);
                            }
                        });
                    @else
                        // For guests, load from localStorage
                        const history = JSON.parse(localStorage.getItem('sipHistory') || '[]');
                        displayHistory(history);
                    @endauth
                }

                function displayHistory(history) {
                    const historyHtml = history.map(item => `
                        <div class="bg-white dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-gray-600 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-2">
                                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Calculation</p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">${new Date(item.created_at).toLocaleDateString()}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-purple-600 dark:text-purple-400">₹${numberFormat(item.maturity_amount)}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Maturity Amount</p>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-gray-50 dark:bg-gray-600 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Monthly Investment</p>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">₹${numberFormat(item.monthly_investment)}</p>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-600 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Return Rate</p>
                                        <p class="text-lg font-semibold text-green-600 dark:text-green-400">${item.annual_return_rate}%</p>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-600 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Duration</p>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">${item.investment_duration} years</p>
                                    </div>
                                </div>
                                
                                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Total Investment</p>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">₹${numberFormat(item.total_investment)}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Interest Earned</p>
                                            <p class="text-sm font-semibold text-green-600 dark:text-green-400">₹${numberFormat(item.total_interest)}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('');
                    $('#history').html(historyHtml || '<div class="text-center py-8"><div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-8"><svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg><p class="text-gray-500 dark:text-gray-400">No calculations yet</p><p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Start by calculating your first SIP</p></div></div>');
                }

                $('#sipForm').on('submit', function(e) {
                    e.preventDefault();
                    
                    // Clear previous errors
                    $('.text-red-500').text('');

                    const formData = new FormData(this);
                    
                    $.ajax({
                        url: '{{ route("sip.calculate") }}',
                        method: 'POST',
                        data: Object.fromEntries(formData),
                        success: function(data) {
                            if (data.status === 'error') {
                                Object.keys(data.errors).forEach(key => {
                                    $(`.error-${key}`).text(data.errors[key][0]);
                                });
                                return;
                            }

                            // Display results
                            $('#results').removeClass('hidden');
                            $('#total_investment').text(numberFormat(data.result.total_investment));
                            $('#total_interest').text(numberFormat(data.result.total_interest));
                            $('#maturity_amount').text(numberFormat(data.result.maturity_amount));

                            @guest
                                // Store in localStorage for guest users
                                const history = JSON.parse(localStorage.getItem('sipHistory') || '[]');
                                history.unshift({
                                    ...data.result,
                                    created_at: new Date().toISOString()
                                });
                                localStorage.setItem('sipHistory', JSON.stringify(history.slice(0, 5)));
                            @endguest

                            // Reload history
                            loadHistory();
                        },
                        error: function(xhr) {
                            console.error('Error:', xhr);
                        }
                    });
                });

                function numberFormat(number) {
                    return new Intl.NumberFormat('en-IN').format(number);
                }

                // Load history on page load
                loadHistory();
            });
        </script>
    </body>
</html>
