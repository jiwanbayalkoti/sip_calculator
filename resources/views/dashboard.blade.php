<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('SIP Calculator') }}
            </h2>
           
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Calculator Form -->
                        <div class="calculator-form">
                            <form id="sipForm" class="space-y-4">
                                <div>
                                    <x-input-label for="monthly_investment" :value="__('Monthly Investment (₹)')" />
                                    <x-text-input id="monthly_investment" type="number" name="monthly_investment" class="block mt-1 w-full" required />
                                    <span class="text-red-500 text-sm error-monthly_investment"></span>
                                </div>

                                <div>
                                    <x-input-label for="annual_return_rate" :value="__('Expected Annual Return Rate (%)')" />
                                    <x-text-input id="annual_return_rate" type="number" step="0.01" name="annual_return_rate" class="block mt-1 w-full" required />
                                    <span class="text-red-500 text-sm error-annual_return_rate"></span>
                                </div>

                                <div>
                                    <x-input-label for="investment_duration" :value="__('Investment Duration (Years)')" />
                                    <x-text-input id="investment_duration" type="number" name="investment_duration" class="block mt-1 w-full" required />
                                    <span class="text-red-500 text-sm error-investment_duration"></span>
                                </div>

                                <x-primary-button type="submit">
                                    {{ __('Calculate') }}
                                </x-primary-button>
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
                                
                                <!-- Add canvas for the graph -->
                                <div class="mt-4 h-64">
                                    <canvas id="sipChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- History Section -->
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Recent Calculations</h3>
                        </div>
                        <div id="history" class="space-y-4">
                            @forelse($history as $index => $calculation)
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-150" 
                                         onclick="toggleGraph({{ $index }})">
                                        <div>
                                            <span class="block text-sm">Monthly Investment</span>
                                            <span class="font-semibold">₹{{ number_format($calculation->monthly_investment, 2) }}</span>
                                        </div>
                                        <div>
                                            <span class="block text-sm">Return Rate</span>
                                            <span class="font-semibold">{{ $calculation->annual_return_rate }}%</span>
                                        </div>
                                        <div>
                                            <span class="block text-sm">Duration</span>
                                            <span class="font-semibold">{{ $calculation->investment_duration }} years</span>
                                        </div>
                                        <div>
                                            <span class="block text-sm">Total Investment</span>
                                            <span class="font-semibold">₹{{ number_format($calculation->total_investment, 2) }}</span>
                                        </div>
                                        <div>
                                            <span class="block text-sm">Total Interest</span>
                                            <span class="font-semibold">₹{{ number_format($calculation->total_interest, 2) }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="block text-sm">Maturity Amount</span>
                                                <span class="font-semibold">₹{{ number_format($calculation->maturity_amount, 2) }}</span>
                                            </div>
                                            @auth
                                                <svg id="chevron{{ $index }}" class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            @endauth
                                        </div>
                                    </div>
                                    @auth
                                        <div id="graphContainer{{ $index }}" class="mt-4 h-48 hidden transition-all duration-300 ease-in-out">
                                            <canvas id="historyChart{{ $index }}"></canvas>
                                        </div>
                                    @endauth
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">No calculations yet</p>
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
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += new Intl.NumberFormat('en-IN', {
                                            style: 'currency',
                                            currency: 'INR'
                                        }).format(context.parsed.y);
                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                                },
                                ticks: {
                                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#000'
                                }
                            },
                            y: {
                                grid: {
                                    color: document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                                },
                                ticks: {
                                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#000',
                                    callback: function(value) {
                                        return new Intl.NumberFormat('en-IN', {
                                            style: 'currency',
                                            currency: 'INR',
                                            maximumSignificantDigits: 3
                                        }).format(value);
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
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += new Intl.NumberFormat('en-IN', {
                                            style: 'currency',
                                            currency: 'INR'
                                        }).format(context.parsed.y);
                                        return label;
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
                                        return new Intl.NumberFormat('en-IN', {
                                            style: 'currency',
                                            currency: 'INR',
                                            maximumSignificantDigits: 3,
                                            notation: 'compact'
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

            // Load history from localStorage for guest users
            @guest
                const history = JSON.parse(localStorage.getItem('sipHistory') || '[]');
                displayHistory(history);
            @endguest

            function displayHistory(calculations) {
                if (!Array.isArray(calculations) || calculations.length === 0) {
                    $('#history').html('<p class="text-gray-500 dark:text-gray-400">No calculations yet</p>');
                    return;
                }

                const historyHtml = calculations.map((item, index) => {
                    const baseHtml = `
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-150" 
                                 onclick="toggleGraph(${index})">
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
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="block text-sm">Maturity Amount</span>
                                        <span class="font-semibold">₹${numberFormat(item.maturity_amount)}</span>
                                    </div>
                                    @auth
                                        <svg id="chevron${index}" class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    @endauth
                                </div>
                            </div>`;

                    @auth
                        return baseHtml + `
                            <div id="graphContainer${index}" class="mt-4 h-48 hidden transition-all duration-300 ease-in-out">
                                <canvas id="historyChart${index}"></canvas>
                            </div>
                        </div>`;
                    @else
                        return baseHtml + '</div>';
                    @endauth
                }).join('');
                
                $('#history').html(historyHtml);

                // Create charts for new history items
                @auth
                    calculations.forEach((item, index) => {
                        createHistoryChart(`historyChart${index}`, item);
                    });
                @endauth
            }

            $('#sipForm').on('submit', function(e) {
                e.preventDefault();
                
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

                        // Create or update the chart
                        createSipChart(data.result);

                        @guest
                            const history = JSON.parse(localStorage.getItem('sipHistory') || '[]');
                            history.unshift(data.result);
                            localStorage.setItem('sipHistory', JSON.stringify(history.slice(0, 5)));
                            displayHistory(history);
                        @else
                            $.get('{{ route("sip.history") }}', function(response) {
                                if (response.status === 'success') {
                                    displayHistory(response.history);
                                }
                            });
                        @endguest
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                    }
                });
            });

            function numberFormat(number) {
                return new Intl.NumberFormat('en-IN').format(number);
            }

            // Function to toggle graph visibility
            window.toggleGraph = function(index) {
                const container = $(`#graphContainer${index}`);
                const chevron = $(`#chevron${index}`);
                
                container.toggleClass('hidden');
                chevron.toggleClass('rotate-180');

                // Initialize chart if not already done
                if (!initializedCharts.has(index) && !container.hasClass('hidden')) {
                    @if(Auth::check())
                        const calculation = @json($history);
                        createHistoryChart(`historyChart${index}`, {
                            monthly_investment: calculation[index].monthly_investment,
                            annual_return_rate: calculation[index].annual_return_rate,
                            investment_duration: calculation[index].investment_duration
                        });
                        initializedCharts.add(index);
                    @endif
                }
            };
        });
    </script>
    @endpush
</x-app-layout>
