<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('SIP Calculator') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
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

                                <!-- Chart Section -->
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Investment Growth Chart</h4>
                                    <div class="h-48">
                                        <canvas id="sipChart"></canvas>
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
                    </div>
                    <div class="p-6">
                        <div id="history" class="space-y-4">
                            @forelse($history as $index => $calculation)
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
                                                    <p class="text-xs text-gray-400 dark:text-gray-500">{{ $calculation->created_at->format('M d, Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-lg font-bold text-purple-600 dark:text-purple-400">₹{{ number_format($calculation->maturity_amount, 2) }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Maturity Amount</p>
                                            </div>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div class="bg-gray-50 dark:bg-gray-600 rounded-lg p-3">
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Monthly Investment</p>
                                                <p class="text-lg font-semibold text-gray-900 dark:text-white">₹{{ number_format($calculation->monthly_investment, 2) }}</p>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-gray-600 rounded-lg p-3">
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Return Rate</p>
                                                <p class="text-lg font-semibold text-green-600 dark:text-green-400">{{ $calculation->annual_return_rate }}%</p>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-gray-600 rounded-lg p-3">
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Duration</p>
                                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $calculation->investment_duration }} years</p>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Total Investment</p>
                                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">₹{{ number_format($calculation->total_investment, 2) }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Interest Earned</p>
                                                    <p class="text-sm font-semibold text-green-600 dark:text-green-400">₹{{ number_format($calculation->total_interest, 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-8">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-gray-500 dark:text-gray-400">No calculations yet</p>
                                        <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Start by calculating your first SIP</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Chart.js in the head section -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @push('scripts')
    <script>
        $(document).ready(function() {
            let sipChart = null;
            let historyCharts = {};
            let initializedCharts = new Set();

            // Initialize localStorage history if not exists
            if (!localStorage.getItem('sipHistory')) {
                localStorage.setItem('sipHistory', JSON.stringify([]));
            }

            function createSipChart(data) {
                const ctx = document.getElementById('sipChart').getContext('2d');
                
                // Destroy existing chart if it exists
                if (sipChart) {
                    sipChart.destroy();
                }

                const years = Array.from({length: data.investment_duration}, (_, i) => 2025 + i);
                const monthlyInvestment = data.monthly_investment;
                const annualRate = data.annual_return_rate / 100;
                const monthlyRate = annualRate / 12;

                const investmentData = years.map((_, index) => {
                    const months = (index + 1) * 12;
                    return Math.round(monthlyInvestment * months);
                });

                const wealthData = years.map((_, index) => {
                    const months = (index + 1) * 12;
                    return Math.round(monthlyInvestment * ((Math.pow(1 + monthlyRate, months) - 1) / monthlyRate) * (1 + monthlyRate));
                });

                sipChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: years,
                        datasets: [
                            {
                                label: 'Worth of Investment',
                                data: wealthData,
                                borderColor: 'rgb(29, 78, 216)',
                                backgroundColor: 'rgba(29, 78, 216, 0.1)',
                                tension: 0.4
                            },
                            {
                                label: 'Amount Invested',
                                data: investmentData,
                                borderColor: 'rgb(34, 197, 94)',
                                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                                tension: 0.4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#000'
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ₹' + new Intl.NumberFormat('en-IN').format(context.parsed.y);
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Year',
                                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#000'
                                },
                                ticks: {
                                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#000'
                                }
                            },
                            y: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Amount (₹)',
                                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#000'
                                },
                                ticks: {
                                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#000',
                                    callback: function(value) {
                                        return '₹' + new Intl.NumberFormat('en-IN').format(value);
                                    }
                                }
                            }
                        }
                    }
                });
            }

            function createHistoryChart(elementId, data) {
                const ctx = document.getElementById(elementId).getContext('2d');
                
                // Destroy existing chart if it exists
                if (historyCharts[elementId]) {
                    historyCharts[elementId].destroy();
                }

                const years = Array.from({length: data.investment_duration}, (_, i) => 2025 + i);
                const monthlyInvestment = data.monthly_investment;
                const annualRate = data.annual_return_rate / 100;
                const monthlyRate = annualRate / 12;

                const investmentData = years.map((_, index) => {
                    const months = (index + 1) * 12;
                    return Math.round(monthlyInvestment * months);
                });

                const wealthData = years.map((_, index) => {
                    const months = (index + 1) * 12;
                    return Math.round(monthlyInvestment * ((Math.pow(1 + monthlyRate, months) - 1) / monthlyRate) * (1 + monthlyRate));
                });

                historyCharts[elementId] = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: years,
                        datasets: [
                            {
                                label: 'Worth of Investment',
                                data: wealthData,
                                borderColor: 'rgb(29, 78, 216)',
                                backgroundColor: 'rgba(29, 78, 216, 0.1)',
                                tension: 0.4
                            },
                            {
                                label: 'Amount Invested',
                                data: investmentData,
                                borderColor: 'rgb(34, 197, 94)',
                                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                                tension: 0.4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ₹' + new Intl.NumberFormat('en-IN').format(context.parsed.y);
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#000',
                                    font: {
                                        size: 10
                                    }
                                }
                            },
                            y: {
                                grid: {
                                    color: document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                                },
                                ticks: {
                                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#000',
                                    callback: function(value) {
                                        return '₹' + new Intl.NumberFormat('en-IN', {
                                            notation: 'compact',
                                            maximumSignificantDigits: 3
                                        }).format(value);
                                    },
                                    font: {
                                        size: 10
                                    }
                                }
                            }
                        }
                    }
                });
            }

            function updateHistory() {
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
                if (!Array.isArray(history) || history.length === 0) {
                    $('#history').html(`
                        <div class="text-center py-8">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-8">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">No calculations yet</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Start by calculating your first SIP</p>
                            </div>
                        </div>
                    `);
                    return;
                }

                const historyHtml = history.map((item, index) => `
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
                                        <p class="text-xs text-gray-400 dark:text-gray-500">${new Date(item.created_at || item.calculated_at).toLocaleDateString()}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-purple-600 dark:text-purple-400">₹${numberFormat(item.maturity_amount)}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Maturity Amount</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150" 
                                 onclick="toggleGraph(${index})">
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

                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <svg id="chevron${index}" class="w-4 h-4 text-gray-500 dark:text-gray-400 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Click to view chart</span>
                                </div>
                            </div>

                            <div id="graphContainer${index}" class="mt-4 h-48 hidden transition-all duration-300 ease-in-out">
                                <canvas id="historyChart${index}"></canvas>
                            </div>
                        </div>
                    </div>
                `).join('');
                
                $('#history').html(historyHtml);
            }

            // Function to toggle graph visibility
            window.toggleGraph = function(index) {
                const container = $(`#graphContainer${index}`);
                const chevron = $(`#chevron${index}`);
                
                container.toggleClass('hidden');
                chevron.toggleClass('rotate-180');

                // Initialize chart if not already done
                if (!initializedCharts.has(index) && !container.hasClass('hidden')) {
                    @auth
                        // For authenticated users, get data from server
                        $.get('{{ route("sip.history") }}', function(response) {
                            if (response.status === 'success' && response.history[index]) {
                                createHistoryChart(`historyChart${index}`, response.history[index]);
                                initializedCharts.add(index);
                            }
                        });
                    @else
                        // For guests, get data from localStorage
                        const history = JSON.parse(localStorage.getItem('sipHistory') || '[]');
                        if (history[index]) {
                            createHistoryChart(`historyChart${index}`, history[index]);
                            initializedCharts.add(index);
                        }
                    @endauth
                }
            };

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

                        // Create chart
                        createSipChart(data.result);

                        @guest
                            // Store in localStorage for guest users
                            const history = JSON.parse(localStorage.getItem('sipHistory') || '[]');
                            history.unshift({
                                ...data.result,
                                created_at: new Date().toISOString()
                            });
                            localStorage.setItem('sipHistory', JSON.stringify(history.slice(0, 5)));
                        @endguest

                        // Update history display without page refresh
                        updateHistory();

                        // Scroll to results
                        $('#results')[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                    }
                });
            });

            function numberFormat(number) {
                return new Intl.NumberFormat('en-IN').format(number);
            }

            // Load initial history
            updateHistory();
        });
    </script>
    @endpush
</x-app-layout>
