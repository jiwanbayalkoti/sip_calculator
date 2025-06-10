<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('SIP Calculator') }}
        </h2>
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
                            <div class="space-y-3">
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
                    @auth
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">Recent Calculations</h3>
                            <div id="history" class="space-y-4">
                                @foreach($history as $calculation)
                                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
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
                                            <div>
                                                <span class="block text-sm">Maturity Amount</span>
                                                <span class="font-semibold">₹{{ number_format($calculation->maturity_amount, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="mt-8">
                            <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded-lg">
                                <p>Sign in to save your calculations and view history.</p>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize localStorage history if not exists
            if (!localStorage.getItem('sipHistory')) {
                localStorage.setItem('sipHistory', JSON.stringify([]));
            }

            const form = document.getElementById('sipForm');
            const results = document.getElementById('results');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Clear previous errors
                document.querySelectorAll('.text-red-500').forEach(el => el.textContent = '');

                const formData = new FormData(form);
                
                fetch('{{ route("sip.calculate") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'error') {
                        Object.keys(data.errors).forEach(key => {
                            document.querySelector(`.error-${key}`).textContent = data.errors[key][0];
                        });
                        return;
                    }

                    // Display results
                    results.classList.remove('hidden');
                    document.getElementById('total_investment').textContent = numberFormat(data.result.total_investment);
                    document.getElementById('total_interest').textContent = numberFormat(data.result.total_interest);
                    document.getElementById('maturity_amount').textContent = numberFormat(data.result.maturity_amount);

                    // Store in localStorage for guest users
                    if (!{{ Auth::check() ? 'true' : 'false' }}) {
                        const history = JSON.parse(localStorage.getItem('sipHistory'));
                        history.unshift({
                            ...data.result,
                            created_at: new Date().toISOString()
                        });
                        localStorage.setItem('sipHistory', JSON.stringify(history.slice(0, 5)));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });

            function numberFormat(number) {
                return new Intl.NumberFormat('en-IN').format(number);
            }
        });
    </script>
    @endpush
</x-app-layout> 