<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
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
                                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ config('app.name', 'Laravel') }}</h1>
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

            <!-- Main Content -->
            <main class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Calculator Form -->
                                <div class="calculator-form">
                                    <form id="sipForm" class="space-y-4">
                                        <div>
                                            <label for="monthly_investment" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                                Monthly Investment (₹)
                                            </label>
                                            <input type="number" id="monthly_investment" name="monthly_investment" 
                                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                            <span class="text-red-500 text-sm error-monthly_investment"></span>
                                        </div>

                                        <div>
                                            <label for="annual_return_rate" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                                Expected Annual Return Rate (%)
                                            </label>
                                            <input type="number" step="0.01" id="annual_return_rate" name="annual_return_rate" 
                                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                            <span class="text-red-500 text-sm error-annual_return_rate"></span>
                                        </div>

                                        <div>
                                            <label for="investment_duration" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                                Investment Duration (Years)
                                            </label>
                                            <input type="number" id="investment_duration" name="investment_duration" 
                                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                            <span class="text-red-500 text-sm error-investment_duration"></span>
                                        </div>

                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            Calculate
                                        </button>
                                    </form>
                                </div>

                                <!-- Results Display -->
                                <div id="results" class="results-display hidden">
                                    <h3 class="text-lg font-semibold mb-4">Results</h3>
                                    <div class="space-y-3 bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <span>Total Investment:</span>
                                            <span class="font-semibold">₹<span id="total_investment">0</span></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Total Interest:</span>
                                            <span class="font-semibold">₹<span id="total_interest">0</span></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Maturity Amount:</span>
                                            <span class="font-semibold">₹<span id="maturity_amount">0</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- History Section -->
                            <div class="mt-8">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold">Recent Calculations</h3>
                                    @guest
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Login</a>
                                            to save your calculations permanently
                                        </span>
                                    @endguest
                                </div>
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
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                <div>
                                    <span class="block text-sm">Monthly Investment</span>
                                    <span class="font-semibold">₹${numberFormat(item.monthly_investment)}</span>
                                </div>
                                <div>
                                    <span class="block text-sm">Return Rate</span>
                                    <span class="font-semibold">${item.annual_return_rate}%</span>
                                </div>
                                <div>
                                    <span class="block text-sm">Duration</span>
                                    <span class="font-semibold">${item.investment_duration} years</span>
                                </div>
                                <div>
                                    <span class="block text-sm">Total Investment</span>
                                    <span class="font-semibold">₹${numberFormat(item.total_investment)}</span>
                                </div>
                                <div>
                                    <span class="block text-sm">Total Interest</span>
                                    <span class="font-semibold">₹${numberFormat(item.total_interest)}</span>
                                </div>
                                <div>
                                    <span class="block text-sm">Maturity Amount</span>
                                    <span class="font-semibold">₹${numberFormat(item.maturity_amount)}</span>
                                </div>
                            </div>
                        </div>
                    `).join('');
                    $('#history').html(historyHtml || '<p class="text-gray-500 dark:text-gray-400">No calculations yet</p>');
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
