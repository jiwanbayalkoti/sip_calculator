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

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Custom CSS -->
        <style>
            .bg-gradient-to-br {
                background: linear-gradient(to bottom right, var(--tw-gradient-stops));
            }
            .bg-gradient-to-r {
                background: linear-gradient(to right, var(--tw-gradient-stops));
            }
            .text-transparent {
                color: transparent;
            }
            .bg-clip-text {
                -webkit-background-clip: text;
                background-clip: text;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50">
            <!-- Navigation -->
            <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </div>
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">Register</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <div class="relative overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                    <div class="text-center">
                        <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                            Smart Investment
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-green-600">Planning</span>
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                            Comprehensive SIP calculators, mutual fund analysis, and investment tools to help you make informed financial decisions and achieve your wealth goals.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('sip-calculator') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg text-lg font-semibold transition duration-300">
                                Start Calculating
                            </a>
                            <a href="{{ route('investment-quiz') }}" class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-8 py-3 rounded-lg text-lg font-semibold transition duration-300">
                                Take Investment Quiz
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Investment Tools</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- SIP Calculator -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">SIP Calculator</h3>
                        <p class="text-gray-600 mb-4">Calculate future value of systematic investment plans with detailed breakdowns.</p>
                        <a href="{{ route('sip-calculator') }}" class="text-blue-600 hover:text-blue-700 font-medium">Try Now →</a>
                    </div>

                    <!-- Lumpsum Calculator -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Lumpsum Calculator</h3>
                        <p class="text-gray-600 mb-4">Calculate returns on one-time investments with compound interest analysis.</p>
                        <a href="{{ route('lumpsum-calculator') }}" class="text-green-600 hover:text-green-700 font-medium">Try Now →</a>
                    </div>

                    <!-- Goal-Based Calculator -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Goal-Based Calculator</h3>
                        <p class="text-gray-600 mb-4">Find the monthly SIP needed to reach your financial goals.</p>
                        <a href="{{ route('goal-based-calculator') }}" class="text-purple-600 hover:text-purple-700 font-medium">Try Now →</a>
                    </div>

                    <!-- Step-Up Calculator -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Step-Up Calculator</h3>
                        <p class="text-gray-600 mb-4">Calculate returns on increasing SIP investments over time.</p>
                        <a href="{{ route('step-up-calculator') }}" class="text-orange-600 hover:text-orange-700 font-medium">Try Now →</a>
                    </div>
                </div>
            </div>

            <!-- Mutual Funds Section -->
            <div class="bg-white py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Mutual Fund Analysis</h2>
                        <p class="text-xl text-gray-600">Compare and analyze top-performing mutual funds across different categories.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Fund Rankings</h3>
                            <p class="text-gray-600 mb-4">Discover top-performing funds based on returns, ratings, and performance metrics.</p>
                            <a href="{{ route('mutual-funds.ranking') }}" class="text-blue-600 hover:text-blue-700 font-medium">View Rankings →</a>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Compare Funds</h3>
                            <p class="text-gray-600 mb-4">Side-by-side comparison of expense ratios, returns, and fund details.</p>
                            <a href="{{ route('mutual-funds.compare') }}" class="text-green-600 hover:text-green-700 font-medium">Compare Now →</a>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Browse Funds</h3>
                            <p class="text-gray-600 mb-4">Explore thousands of mutual funds across equity, debt, and hybrid categories.</p>
                            <a href="{{ route('mutual-funds.index') }}" class="text-purple-600 hover:text-purple-700 font-medium">Browse Funds →</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog Section -->
            <div class="bg-gray-50 py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Investment Education</h2>
                        <p class="text-xl text-gray-600">Learn about SIPs, mutual funds, and personal finance through our educational content.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600"></div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">SIP Investment Guide</h3>
                                <p class="text-gray-600 mb-4">Complete guide to systematic investment plans and their benefits.</p>
                                <a href="{{ route('blog.index') }}" class="text-blue-600 hover:text-blue-700 font-medium">Read More →</a>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="h-48 bg-gradient-to-br from-green-400 to-green-600"></div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Mutual Fund Basics</h3>
                                <p class="text-gray-600 mb-4">Understanding different types of mutual funds and their characteristics.</p>
                                <a href="{{ route('blog.index') }}" class="text-green-600 hover:text-green-700 font-medium">Read More →</a>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="h-48 bg-gradient-to-br from-purple-400 to-purple-600"></div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Tax Planning</h3>
                                <p class="text-gray-600 mb-4">Tax implications of mutual fund investments and optimization strategies.</p>
                                <a href="{{ route('blog.index') }}" class="text-purple-600 hover:text-purple-700 font-medium">Read More →</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        <a href="{{ route('blog.index') }}" class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-lg text-lg font-semibold transition duration-300">
                            View All Articles
                        </a>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-blue-600 to-green-600 py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold text-white mb-4">Ready to Start Your Investment Journey?</h2>
                    <p class="text-xl text-blue-100 mb-8">Join thousands of investors who trust our tools for their financial planning.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg text-lg font-semibold transition duration-300">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg text-lg font-semibold transition duration-300">
                                Get Started Free
                            </a>
                            <a href="{{ route('login') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg text-lg font-semibold transition duration-300">
                                Sign In
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-gray-900 text-white py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div>
                            <x-application-logo class="block h-8 w-auto fill-current text-white mb-4" />
                            <p class="text-gray-400">Comprehensive investment tools and calculators for smart financial planning.</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Calculators</h3>
                            <ul class="space-y-2 text-gray-400">
                                <li><a href="{{ route('sip-calculator') }}" class="hover:text-white">SIP Calculator</a></li>
                                <li><a href="{{ route('lumpsum-calculator') }}" class="hover:text-white">Lumpsum Calculator</a></li>
                                <li><a href="{{ route('goal-based-calculator') }}" class="hover:text-white">Goal-Based Calculator</a></li>
                                <li><a href="{{ route('step-up-calculator') }}" class="hover:text-white">Step-Up Calculator</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Resources</h3>
                            <ul class="space-y-2 text-gray-400">
                                <li><a href="{{ route('blog.index') }}" class="hover:text-white">Blog</a></li>
                                <li><a href="{{ route('mutual-funds.index') }}" class="hover:text-white">Mutual Funds</a></li>
                                <li><a href="{{ route('glossary') }}" class="hover:text-white">Glossary</a></li>
                                <li><a href="{{ route('investment-quiz') }}" class="hover:text-white">Investment Quiz</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Legal</h3>
                            <ul class="space-y-2 text-gray-400">
                                <li><a href="{{ route('privacy-policy') }}" class="hover:text-white">Privacy Policy</a></li>
                                <li><a href="{{ route('terms-of-service') }}" class="hover:text-white">Terms of Service</a></li>
                                <li><a href="{{ route('contact') }}" class="hover:text-white">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
