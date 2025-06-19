<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lumpsum Calculator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Calculator Form -->
                        <div class="lg:col-span-2">
                            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl overflow-hidden">
                                <!-- Form Header -->
                                <div class="px-8 py-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-white/20 rounded-lg p-2">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h2 class="text-2xl font-bold text-white">Lumpsum Calculator</h2>
                                            <p class="text-blue-100">Calculate returns on one-time investments</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Content -->
                                <div class="bg-white p-8">
                                    <form id="lumpsumForm" class="space-y-6">
                                        <!-- Lumpsum Amount -->
                                        <div class="relative">
                                            <label for="lumpsum_amount" class="block text-sm font-semibold text-gray-700 mb-2">
                                                Lumpsum Investment Amount
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 text-lg font-medium">₹</span>
                                                </div>
                                                <input type="number" 
                                                       id="lumpsum_amount" 
                                                       name="lumpsum_amount" 
                                                       placeholder="1,00,000"
                                                       class="block w-full pl-8 pr-4 py-4 text-lg border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200" 
                                                       required>
                                            </div>
                                            <span class="text-red-500 text-sm error-lumpsum_amount mt-1"></span>
                                            <p class="text-sm text-gray-500 mt-1">Enter the one-time amount you want to invest</p>
                                        </div>

                                        <!-- Annual Return Rate -->
                                        <div class="relative">
                                            <label for="annual_return_rate" class="block text-sm font-semibold text-gray-700 mb-2">
                                                Expected Annual Return Rate
                                            </label>
                                            <div class="relative">
                                                <input type="number" 
                                                       step="0.01" 
                                                       id="annual_return_rate" 
                                                       name="annual_return_rate" 
                                                       placeholder="12.00"
                                                       class="block w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200" 
                                                       required>
                                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 text-lg font-medium">%</span>
                                                </div>
                                            </div>
                                            <span class="text-red-500 text-sm error-annual_return_rate mt-1"></span>
                                            <p class="text-sm text-gray-500 mt-1">Expected annual return on your investment</p>
                                        </div>

                                        <!-- Investment Duration -->
                                        <div class="relative">
                                            <label for="investment_duration" class="block text-sm font-semibold text-gray-700 mb-2">
                                                Investment Duration
                                            </label>
                                            <div class="relative">
                                                <input type="number" 
                                                       id="investment_duration" 
                                                       name="investment_duration" 
                                                       placeholder="10"
                                                       class="block w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200" 
                                                       required>
                                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 text-lg font-medium">years</span>
                                                </div>
                                            </div>
                                            <span class="text-red-500 text-sm error-investment_duration mt-1"></span>
                                            <p class="text-sm text-gray-500 mt-1">How long you plan to keep your investment</p>
                                        </div>

                                        <!-- Calculate Button -->
                                        <button type="submit" 
                                                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-xl text-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow-lg hover:shadow-xl">
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
                                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
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
                                        <!-- Lumpsum Amount -->
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-gray-600">Lumpsum Investment</p>
                                                    <p class="text-2xl font-bold text-gray-900">₹<span id="lumpsum_amount_result">0</span></p>
                                                </div>
                                                <div class="bg-blue-100 rounded-lg p-2">
                                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Total Interest -->
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-gray-600">Total Interest Earned</p>
                                                    <p class="text-2xl font-bold text-green-600">₹<span id="total_interest">0</span></p>
                                                </div>
                                                <div class="bg-green-100 rounded-lg p-2">
                                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Maturity Amount -->
                                        <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-xl p-4 border-2 border-purple-200">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-purple-600 font-medium">Maturity Amount</p>
                                                    <p class="text-3xl font-bold text-purple-700">₹<span id="maturity_amount">0</span></p>
                                                </div>
                                                <div class="bg-purple-100 rounded-lg p-2">
                                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Investment Tips -->
                                        <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                                            <div class="flex items-start space-x-3">
                                                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-blue-800">Investment Tip</p>
                                                    <p class="text-sm text-blue-700 mt-1">Lumpsum investments work best when you have a large amount to invest and can afford to wait for long-term growth.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- History Section -->
                    @if(count($calculations) > 0)
                    <div class="mt-12">
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
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
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($calculations as $calculation)
                                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="text-sm text-gray-500">{{ $calculation->created_at->format('M d, Y') }}</div>
                                            <div class="text-lg font-bold text-purple-600">₹{{ number_format($calculation->maturity_amount, 2) }}</div>
                                        </div>
                                        <div class="space-y-2">
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-600">Investment:</span>
                                                <span class="font-medium">₹{{ number_format($calculation->lumpsum_amount, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-600">Return Rate:</span>
                                                <span class="font-medium text-green-600">{{ $calculation->annual_return_rate }}%</span>
                                            </div>
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-600">Duration:</span>
                                                <span class="font-medium">{{ $calculation->investment_duration }} years</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#lumpsumForm').on('submit', function(e) {
                e.preventDefault();
                
                // Clear previous errors
                $('.text-red-500').text('');

                const formData = new FormData(this);
                
                $.ajax({
                    url: '{{ route("lumpsum-calculator.calculate") }}',
                    method: 'POST',
                    data: Object.fromEntries(formData),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            // Display results
                            $('#results').removeClass('hidden');
                            $('#lumpsum_amount_result').text(data.result.lumpsum_amount);
                            $('#total_interest').text(data.result.total_interest);
                            $('#maturity_amount').text(data.result.maturity_amount);

                            // Scroll to results
                            $('html, body').animate({
                                scrollTop: $('#results').offset().top - 100
                            }, 500);

                            // Reload page to show updated history
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(key => {
                                $(`.error-${key}`).text(errors[key][0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
</x-app-layout> 