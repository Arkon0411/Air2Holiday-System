<x-layouts.app.sidebar title="{{ auth()->user()->isAirline() ? 'Airline Panel - Dashboard' : 'Admin Panel - Dashboard' }}">
    <flux:main class="p-6 space-y-6">
        @if(auth()->user()->isAirline())
            {{-- Airline Dashboard --}}
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-50 mb-2">{{ $airline->name }} Dashboard</h1>
                <p class="text-gray-600 dark:text-gray-400">Revenue insights and flight management</p>
            </div>

            {{-- Key Statistics --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Revenue</p>
                            <h3 class="text-2xl font-bold mt-1">₱{{ number_format($stats['total_revenue'], 2) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">This Month Revenue</p>
                            <h3 class="text-2xl font-bold mt-1">₱{{ number_format($stats['revenue_this_month'], 2) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Total Bookings</p>
                            <h3 class="text-2xl font-bold mt-1">{{ number_format($stats['total_bookings']) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm font-medium">Total Flights</p>
                            <h3 class="text-2xl font-bold mt-1">{{ number_format($stats['total_flights']) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-pink-500 to-pink-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-pink-100 text-sm font-medium">Active Flights Today</p>
                            <h3 class="text-2xl font-bold mt-1">{{ number_format($stats['active_flights_today']) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-100 text-sm font-medium">Bookings This Month</p>
                            <h3 class="text-2xl font-bold mt-1">{{ number_format($stats['bookings_this_month']) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Charts Row --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" wire:ignore>
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-50">Revenue Trends (Last 7 Days)</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Daily revenue from confirmed bookings</p>
                    </div>
                    <div>
                        <canvas id="revenueTrendsChart" height="250"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-50">Booking Trends (Last 7 Days)</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Daily booking counts</p>
                    </div>
                    <div>
                        <canvas id="airlineBookingTrendsChart" height="250"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-50">Class Distribution</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Economy vs Business bookings</p>
                    </div>
                    <div>
                        <canvas id="classDistributionChart" height="250"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-50">Top Routes by Revenue</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Most profitable routes</p>
                    </div>
                    <div>
                        <canvas id="airlinePopularRoutesChart" height="250"></canvas>
                    </div>
                </div>
            </div>

        @else
            {{-- Admin Dashboard --}}
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-50 mb-2">Admin Dashboard</h1>
                <p class="text-gray-600 dark:text-gray-400">System overview and database statistics</p>
            </div>

            {{-- Key Statistics --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Users</p>
                            <h3 class="text-2xl font-bold mt-1">{{ number_format($stats['total_users']) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Total Bookings</p>
                            <h3 class="text-2xl font-bold mt-1">{{ number_format($stats['total_bookings']) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Total Flights</p>
                            <h3 class="text-2xl font-bold mt-1">{{ number_format($stats['total_flights']) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm font-medium">Active Today</p>
                            <h3 class="text-2xl font-bold mt-1">{{ number_format($stats['active_flights_today']) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-pink-500 to-pink-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-pink-100 text-sm font-medium">Total Airlines</p>
                            <h3 class="text-2xl font-bold mt-1">{{ number_format($stats['total_airlines']) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-100 text-sm font-medium">Total Airports</p>
                            <h3 class="text-2xl font-bold mt-1">{{ number_format($stats['total_airports']) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-teal-500 to-teal-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-teal-100 text-sm font-medium">Total Revenue</p>
                            <h3 class="text-2xl font-bold mt-1">₱{{ number_format($stats['total_revenue'], 2) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-teal-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-cyan-500 to-cyan-600 text-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-cyan-100 text-sm font-medium">Bookings This Month</p>
                            <h3 class="text-2xl font-bold mt-1">{{ number_format($stats['bookings_this_month']) }}</h3>
                        </div>
                        <svg class="w-12 h-12 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Charts Row --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" wire:ignore>
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-50">Booking Trends (Last 7 Days)</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Daily booking activity</p>
                    </div>
                    <div>
                        <canvas id="adminBookingTrendsChart" height="250"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-50">Revenue by Airline</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Top 5 revenue-generating airlines</p>
                    </div>
                    <div>
                        <canvas id="revenueByAirlineChart" height="250"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-50">Booking Status Distribution</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Confirmed, Pending, and Cancelled bookings</p>
                    </div>
                    <div>
                        <canvas id="bookingStatusChart" height="250"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-50">Popular Routes</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Most booked flight routes</p>
                    </div>
                    <div>
                        <canvas id="adminPopularRoutesChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        @endif

        {{-- Today's Flights Management Panel --}}
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-50">Today's Flights Management</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Manage flight status and monitor operations for {{ now()->format('F d, Y') }}</p>
            </div>

            @if($todaysFlights->isEmpty())
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <p class="text-gray-600 dark:text-gray-400">No flights scheduled for today</p>
                </div>
            @else
                {{-- Desktop Table View --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Flight</th>
                                @unless(auth()->user()->isAirline())
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Airline</th>
                                @endunless
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Route</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Departure</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Arrival</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Bookings</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($todaysFlights as $flight)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-50">{{ $flight->flight_number }}</div>
                                    </td>
                                    @unless(auth()->user()->isAirline())
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($flight->airline->logo)
                                                    <img src="{{ asset($flight->airline->logo) }}" alt="{{ $flight->airline->name }}" class="size-8 rounded-full mr-2 object-cover">
                                                @endif
                                                <div class="text-sm text-gray-900 dark:text-gray-50">{{ $flight->airline->name }}</div>
                                            </div>
                                        </td>
                                    @endunless
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 dark:text-gray-50">
                                            {{ $flight->departureAirport->iata_code }} → {{ $flight->arrivalAirport->iata_code }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $flight->departureAirport->location }} to {{ $flight->arrivalAirport->location }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-50">{{ \Carbon\Carbon::parse($flight->scheduled_departure)->format('h:i A') }}</div>
                                        @if($flight->actual_departure)
                                            <div class="text-xs text-gray-500 dark:text-gray-400">Actual: {{ \Carbon\Carbon::parse($flight->actual_departure)->format('h:i A') }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-50">{{ \Carbon\Carbon::parse($flight->scheduled_arrival)->format('h:i A') }}</div>
                                        @if($flight->actual_arrival)
                                            <div class="text-xs text-gray-500 dark:text-gray-400">Actual: {{ \Carbon\Carbon::parse($flight->actual_arrival)->format('h:i A') }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'scheduled' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                'boarding' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                                'departed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                                'arrived' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
                                                'delayed' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
                                                'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                            ];
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$flight->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($flight->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-50">
                                        {{ $flight->bookings->count() }} bookings
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <flux:modal.trigger name="updateStatusModal-{{ $flight->id }}">
                                            <button class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Update Status
                                            </button>
                                        </flux:modal.trigger>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Card View --}}
                <div class="md:hidden space-y-4">
                    @foreach($todaysFlights as $flight)
                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm">
                            {{-- Flight Header --}}
                            <div class="flex items-center justify-between mb-3 pb-3 border-b border-gray-200 dark:border-gray-700">
                                <div>
                                    <div class="text-lg font-bold text-gray-900 dark:text-gray-50">{{ $flight->flight_number }}</div>
                                    @unless(auth()->user()->isAirline())
                                        <div class="flex items-center mt-1">
                                            @if($flight->airline->logo)
                                                <img src="{{ asset($flight->airline->logo) }}" alt="{{ $flight->airline->name }}" class="size-5 rounded-full mr-1.5 object-cover">
                                            @endif
                                            <span class="text-xs text-gray-600 dark:text-gray-400">{{ $flight->airline->name }}</span>
                                        </div>
                                    @endunless
                                </div>
                                @php
                                    $statusColors = [
                                        'scheduled' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                        'boarding' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                        'departed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                        'arrived' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
                                        'delayed' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
                                        'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$flight->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($flight->status) }}
                                </span>
                            </div>

                            {{-- Route Information --}}
                            <div class="mb-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">From</div>
                                        <div class="text-sm font-semibold text-gray-900 dark:text-gray-50">{{ $flight->departureAirport->iata_code }}</div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">{{ $flight->departureAirport->location }}</div>
                                    </div>
                                    <div class="px-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 text-right">
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">To</div>
                                        <div class="text-sm font-semibold text-gray-900 dark:text-gray-50">{{ $flight->arrivalAirport->iata_code }}</div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">{{ $flight->arrivalAirport->location }}</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Times --}}
                            <div class="grid grid-cols-2 gap-3 mb-3 pb-3 border-b border-gray-200 dark:border-gray-700">
                                <div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Departure</div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-50">{{ \Carbon\Carbon::parse($flight->scheduled_departure)->format('h:i A') }}</div>
                                    @if($flight->actual_departure)
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Actual: {{ \Carbon\Carbon::parse($flight->actual_departure)->format('h:i A') }}</div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Arrival</div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-50">{{ \Carbon\Carbon::parse($flight->scheduled_arrival)->format('h:i A') }}</div>
                                    @if($flight->actual_arrival)
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Actual: {{ \Carbon\Carbon::parse($flight->actual_arrival)->format('h:i A') }}</div>
                                    @endif
                                </div>
                            </div>

                            {{-- Footer with bookings and action --}}
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    {{ $flight->bookings->count() }} bookings
                                </div>
                                <flux:modal.trigger name="updateStatusModal-{{ $flight->id }}">
                                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Update
                                    </button>
                                </flux:modal.trigger>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Status Update Modals --}}
        @foreach($todaysFlights as $flight)
            <flux:modal name="updateStatusModal-{{ $flight->id }}" class="md:w-96">
                <form action="{{ route('adminpanel.flights.update', $flight) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    {{-- Hidden fields to satisfy validation --}}
                    <input type="hidden" name="flight_number" value="{{ $flight->flight_number }}">
                    <input type="hidden" name="scheduled_departure" value="{{ $flight->scheduled_departure }}">
                    <input type="hidden" name="scheduled_arrival" value="{{ $flight->scheduled_arrival }}">
                    <input type="hidden" name="airline_id" value="{{ $flight->airline_id }}">
                    <input type="hidden" name="departure_airport_id" value="{{ $flight->departure_airport_id }}">
                    <input type="hidden" name="arrival_airport_id" value="{{ $flight->arrival_airport_id }}">
                    <input type="hidden" name="base_price" value="{{ $flight->base_price }}">
                    <input type="hidden" name="business_price" value="{{ $flight->business_price }}">
                    <input type="hidden" name="redirect_to" value="dashboard">
                    
                    <div>
                        <flux:heading size="lg">Update Flight Status</flux:heading>
                        <flux:subheading>{{ $flight->flight_number }} - {{ $flight->departureAirport->iata_code }} → {{ $flight->arrivalAirport->iata_code }}</flux:subheading>
                    </div>

                    <flux:separator />

                    <flux:field>
                        <flux:label>Flight Status</flux:label>
                        <select name="status" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                            <option value="scheduled" {{ $flight->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="boarding" {{ $flight->status == 'boarding' ? 'selected' : '' }}>Boarding</option>
                            <option value="departed" {{ $flight->status == 'departed' ? 'selected' : '' }}>Departed</option>
                            <option value="delayed" {{ $flight->status == 'delayed' ? 'selected' : '' }}>Delayed</option>
                            <option value="cancelled" {{ $flight->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </flux:field>

                    <div class="flex gap-2 justify-end">
                        <flux:modal.close>
                            <flux:button variant="ghost">Cancel</flux:button>
                        </flux:modal.close>
                        <flux:button type="submit" variant="primary">Update Status</flux:button>
                    </div>
                </form>
            </flux:modal>
        @endforeach

    </flux:main>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        (function() {
            // Prevent script from running multiple times
            if (window.dashboardChartsInitialized) {
                return;
            }
            window.dashboardChartsInitialized = true;

            // Store chart instances globally to destroy them on re-render
            window.dashboardCharts = window.dashboardCharts || {};

            function initializeCharts() {
                // Ensure Chart.js is loaded
                if (typeof Chart === 'undefined') {
                    console.error('Chart.js library not loaded!');
                    return;
                }
                
                // Destroy our tracked charts before creating new ones
                Object.keys(window.dashboardCharts).forEach(key => {
                    if (window.dashboardCharts[key]) {
                        try {
                            window.dashboardCharts[key].destroy();
                        } catch(e) {
                            console.log('Chart already destroyed:', key);
                        }
                    }
                });
                window.dashboardCharts = {};

            // Chart.js configuration
            const chartColors = {
                primary: 'rgb(59, 130, 246)',
                success: 'rgb(34, 197, 94)',
                warning: 'rgb(251, 146, 60)',
                danger: 'rgb(239, 68, 68)',
                purple: 'rgb(168, 85, 247)',
                pink: 'rgb(236, 72, 153)',
                indigo: 'rgb(99, 102, 241)',
                teal: 'rgb(20, 184, 166)',
            };

            @if(auth()->user()->isAirline())
            // Revenue Trends Chart (Airline)
            const airlineRevenueTrendsCtx = document.getElementById('revenueTrendsChart').getContext('2d');
            window.dashboardCharts.revenueTrends = new Chart(airlineRevenueTrendsCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($revenueTrends->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))) !!},
                    datasets: [{
                        label: 'Revenue (₱)',
                        data: {!! json_encode($revenueTrends->pluck('revenue')) !!},
                        borderColor: chartColors.success,
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₱' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });

            // Booking Trends Chart (Airline)
            const airlineBookingTrendsCtx = document.getElementById('airlineBookingTrendsChart').getContext('2d');
            window.dashboardCharts.airlineBookingTrends = new Chart(airlineBookingTrendsCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($bookingTrends->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))) !!},
                    datasets: [{
                        label: 'Bookings',
                        data: {!! json_encode($bookingTrends->pluck('count')) !!},
                        backgroundColor: chartColors.primary
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            // Class Distribution Chart (Airline)
            const classDistributionCtx = document.getElementById('classDistributionChart').getContext('2d');
            window.dashboardCharts.classDistribution = new Chart(classDistributionCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($classDistribution->pluck('class')->map(fn($c) => ucfirst($c))) !!},
                    datasets: [{
                        data: {!! json_encode($classDistribution->pluck('count')) !!},
                        backgroundColor: [chartColors.primary, chartColors.purple]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Popular Routes Chart (Airline)
            const airlinePopularRoutesCtx = document.getElementById('airlinePopularRoutesChart').getContext('2d');
            window.dashboardCharts.airlinePopularRoutes = new Chart(airlinePopularRoutesCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($popularRoutes->map(fn($r) => $r->departure . ' → ' . $r->arrival)) !!},
                    datasets: [{
                        label: 'Revenue (₱)',
                        data: {!! json_encode($popularRoutes->pluck('revenue')) !!},
                        backgroundColor: chartColors.teal
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₱' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });

        @else
            // Booking Trends Chart (Admin)
            const adminBookingTrendsCtx = document.getElementById('adminBookingTrendsChart').getContext('2d');
            window.dashboardCharts.adminBookingTrends = new Chart(adminBookingTrendsCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($bookingTrends->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))) !!},
                    datasets: [{
                        label: 'Bookings',
                        data: {!! json_encode($bookingTrends->pluck('count')) !!},
                        borderColor: chartColors.primary,
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            // Revenue by Airline Chart (Admin)
            const revenueByAirlineCtx = document.getElementById('revenueByAirlineChart').getContext('2d');
            window.dashboardCharts.revenueByAirline = new Chart(revenueByAirlineCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($revenueByAirline->pluck('name')) !!},
                    datasets: [{
                        label: 'Revenue (₱)',
                        data: {!! json_encode($revenueByAirline->pluck('revenue')) !!},
                        backgroundColor: [
                            chartColors.primary,
                            chartColors.success,
                            chartColors.warning,
                            chartColors.purple,
                            chartColors.pink
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₱' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });

            // Booking Status Distribution Chart (Admin)
            const bookingStatusCtx = document.getElementById('bookingStatusChart').getContext('2d');
            window.dashboardCharts.bookingStatus = new Chart(bookingStatusCtx, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($bookingStatusDistribution->pluck('status')->map(fn($s) => ucfirst($s))) !!},
                    datasets: [{
                        data: {!! json_encode($bookingStatusDistribution->pluck('count')) !!},
                        backgroundColor: [chartColors.success, chartColors.warning, chartColors.danger]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Popular Routes Chart (Admin)
            const adminPopularRoutesCtx = document.getElementById('adminPopularRoutesChart').getContext('2d');
            window.dashboardCharts.adminPopularRoutes = new Chart(adminPopularRoutesCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($popularRoutes->map(fn($r) => $r->departure . ' → ' . $r->arrival)) !!},
                    datasets: [{
                        label: 'Bookings',
                        data: {!! json_encode($popularRoutes->pluck('booking_count')) !!},
                        backgroundColor: chartColors.indigo
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: { beginAtZero: true }
                    }
                }
            });
        @endif
            }

            // Initialize charts on page load
            document.addEventListener('DOMContentLoaded', initializeCharts);
            
            // Re-initialize charts after Livewire navigation
            document.addEventListener('livewire:navigated', initializeCharts);
        })(); // End IIFE
    </script>
    @endpush
</x-layouts.app.sidebar>
