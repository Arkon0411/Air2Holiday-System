<x-layouts.app.sidebar title="Flights">
    <flux:main x-data="flightManager()">
        <!-- Header -->
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-50 text-center sm:text-left w-full sm:w-auto">Flights</h1>
                <flux:modal.trigger name="createFlightModal">
                    <flux:button variant="primary" icon="plus-circle" class="w-full sm:w-auto">Create</flux:button>
                </flux:modal.trigger>
            </div>

            <!-- Search Bar -->
            <div class="w-full" x-data="{ searchQuery: '' }">
                <input 
                    type="text" 
                    x-model="searchQuery"
                    @input="document.querySelectorAll('tbody tr').forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchQuery.toLowerCase()) ? '' : 'none';
                    })"
                    placeholder="Search by flight number, airline, or airports..."
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50 dark:placeholder-gray-400" />
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto rounded-lg border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-100 text-sm font-semibold text-gray-900 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-50">
                        <th class="px-4 py-3 sm:px-6 sm:py-4">Flight Number</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden lg:table-cell">Airline</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden md:table-cell">Route</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden xl:table-cell">Departure</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden sm:table-cell">Price</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-right"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($flights as $flight)
                        <tr class="bg-zinc-50 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-900 dark:text-gray-50">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ $flight->flight_number }}</span>
                                    <div class="flex flex-col lg:hidden mt-1 space-y-1">
                                        <span class="text-xs text-gray-500">{{ $flight->airline ? $flight->airline->name : 'N/A' }}</span>
                                        <span class="text-xs text-gray-500">{{ $flight->departureAirport ? $flight->departureAirport->iata_code : 'N/A' }} → {{ $flight->arrivalAirport ? $flight->arrivalAirport->iata_code : 'N/A' }}</span>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden lg:table-cell">
                                {{ $flight->airline ? $flight->airline->name : 'N/A' }}
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden md:table-cell">
                                <span class="inline-flex items-center gap-1">
                                    <span class="font-medium">{{ $flight->departureAirport ? $flight->departureAirport->iata_code : 'N/A' }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                    <span class="font-medium">{{ $flight->arrivalAirport ? $flight->arrivalAirport->iata_code : 'N/A' }}</span>
                                </span>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden xl:table-cell">
                                {{ $flight->scheduled_departure ? \Carbon\Carbon::parse($flight->scheduled_departure)->format('M d, Y H:i') : 'N/A' }}
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden sm:table-cell">
                                <div class="flex flex-col gap-1">
                                    <span class="text-xs">Economy: ₱{{ number_format($flight->base_price, 2) }}</span>
                                    @if($flight->business_price)
                                        <span class="text-xs">Business:     ₱{{ number_format($flight->business_price, 2) }}</span>
                                    @endif
                                </div>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <flux:modal.trigger name="editFlightModal">
                                        <flux:button size="sm" @click="setEditingFlight({{ $flight->id }})" icon="pencil-square" />
                                    </flux:modal.trigger>
                                    <form action="{{ route('adminpanel.flights.destroy', $flight) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this flight?')">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button size="sm" type="submit" variant="danger" icon="archive-box-x-mark" />
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Create Flight Modal -->
        <flux:modal name="createFlightModal" class="max-w-3xl">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Create New Flight</flux:heading>
                </div>
                
                <form action="{{ route('adminpanel.flights.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        @if(auth()->user() && auth()->user()->usertype !== 'airline')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Airline</label>
                            <select name="airline_id" required class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                                <option value="">-- Select Airline --</option>
                                @php
                                    $airlines = \App\Models\Airline::all();
                                @endphp
                                @foreach($airlines as $airline)
                                    <option value="{{ $airline->id }}">{{ $airline->name }} ({{ $airline->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Departure Airport</label>
                            <select name="departure_airport_id" required class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                                <option value="">-- Select Airport --</option>
                                @php
                                    $airports = \App\Models\Airport::all();
                                @endphp
                                @foreach($airports as $airport)
                                    <option value="{{ $airport->id }}">{{ $airport->name }} ({{ $airport->iata_code }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Arrival Airport</label>
                            <select name="arrival_airport_id" required class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                                <option value="">-- Select Airport --</option>
                                @foreach($airports as $airport)
                                    <option value="{{ $airport->id }}">{{ $airport->name }} ({{ $airport->iata_code }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Departure Date and Time -->
                        <x-date-picker label="Departure Date" name="departure_date" required />
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Departure Time</label>
                            <select name="departure_time" required class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                                <option value="">-- Select time --</option>
                                @for($h = 0; $h < 24; $h++)
                                    @for($m = 0; $m < 60; $m += 30)
                                        <option value="{{ sprintf('%02d:%02d', $h, $m) }}">{{ sprintf('%02d:%02d', $h, $m) }}</option>
                                    @endfor
                                @endfor
                            </select>
                        </div>
                        
                        <!-- Arrival Date and Time -->
                        <x-date-picker label="Arrival Date" name="arrival_date" required />
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Arrival Time</label>
                            <select name="arrival_time" required class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                                <option value="">-- Select time --</option>
                                @for($h = 0; $h < 24; $h++)
                                    @for($m = 0; $m < 60; $m += 30)
                                        <option value="{{ sprintf('%02d:%02d', $h, $m) }}">{{ sprintf('%02d:%02d', $h, $m) }}</option>
                                    @endfor
                                @endfor
                            </select>
                        </div>
                        
                        <flux:input label="Economy Price" name="base_price" type="number" step="0.01" required />
                        <flux:input label="Business Price" name="business_price" type="number" step="0.01" placeholder="Optional" />
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                            <select name="status" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                                <option value="scheduled">Scheduled</option>
                                <option value="delayed">Delayed</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                        <flux:button type="submit" variant="primary" class="w-full sm:w-auto order-1 sm:order-2">Create Flight</flux:button>
                    </div>
                </form>
            </div>
        </flux:modal>

        <!-- Edit Flight Modal -->
        <flux:modal name="editFlightModal" class="max-w-3xl">
            <template x-if="editingFlightId">
                <div class="space-y-6">
                    <div>
                        <flux:heading size="lg">Edit Flight</flux:heading>
                    </div>
                    
                    <form :action="`/adminpanel/flights/${editingFlightId}`" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                            @if(auth()->user() && auth()->user()->usertype !== 'airline')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Airline</label>
                                <select name="airline_id" x-model="editingFlight.airline_id" required class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                                    <option value="">-- Select Airline --</option>
                                    @php
                                        $airlines = \App\Models\Airline::all();
                                    @endphp
                                    @foreach($airlines as $airline)
                                        <option value="{{ $airline->id }}">{{ $airline->name }} ({{ $airline->code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Departure Airport</label>
                                <select name="departure_airport_id" x-model="editingFlight.departure_airport_id" required class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                                    <option value="">-- Select Airport --</option>
                                    @php
                                        $airports = \App\Models\Airport::all();
                                    @endphp
                                    @foreach($airports as $airport)
                                        <option value="{{ $airport->id }}">{{ $airport->name }} ({{ $airport->iata_code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Arrival Airport</label>
                                <select name="arrival_airport_id" x-model="editingFlight.arrival_airport_id" required class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                                    <option value="">-- Select Airport --</option>
                                    @foreach($airports as $airport)
                                        <option value="{{ $airport->id }}">{{ $airport->name }} ({{ $airport->iata_code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <flux:input label="Departure Date & Time" name="scheduled_departure" type="datetime-local" x-model="editingFlight.scheduled_departure_formatted" />
                            <flux:input label="Arrival Date & Time" name="scheduled_arrival" type="datetime-local" x-model="editingFlight.scheduled_arrival_formatted" />
                            
                            <flux:input label="Economy Price" name="base_price" type="number" step="0.01" x-model="editingFlight.base_price" required />
                            <flux:input label="Business Price" name="business_price" type="number" step="0.01" x-model="editingFlight.business_price" />
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                                <select name="status" x-model="editingFlight.status" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                                    <option value="scheduled">Scheduled</option>
                                    <option value="delayed">Delayed</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                            <flux:button type="submit" variant="primary" class="w-full sm:w-auto order-1 sm:order-2">Update Flight</flux:button>
                        </div>
                    </form>
                </div>
            </template>
        </flux:modal>

        <script src="{{ asset('js/date-picker.js') }}"></script>
        <script>
            function flightManager() {
                return {
                    editingFlightId: null,
                    editingFlight: {
                        flight_number: '',
                        airline_id: '',
                        departure_airport_id: '',
                        arrival_airport_id: '',
                        scheduled_departure: '',
                        scheduled_arrival: '',
                        scheduled_departure_formatted: '',
                        scheduled_arrival_formatted: '',
                        base_price: '',
                        business_price: '',
                        status: 'scheduled'
                    },
                    
                    async setEditingFlight(flightId) {
                        this.editingFlightId = flightId;
                        try {
                            const response = await fetch(`/adminpanel/flights/${flightId}/edit`);
                            const flightData = await response.json();
                            this.editingFlight = flightData;
                            
                            // Format dates for datetime-local input
                            if (flightData.scheduled_departure) {
                                this.editingFlight.scheduled_departure_formatted = new Date(flightData.scheduled_departure).toISOString().slice(0, 16);
                            }
                            if (flightData.scheduled_arrival) {
                                this.editingFlight.scheduled_arrival_formatted = new Date(flightData.scheduled_arrival).toISOString().slice(0, 16);
                            }
                        } catch (error) {
                            console.error('Error loading flight data:', error);
                            alert('Error loading flight data');
                        }
                    }
                };
            }

            document.addEventListener('alpine:init', () => {
                Alpine.data('flightManager', flightManager);
            });
            
            // Combine date and time fields before submission
            document.addEventListener('submit', (e) => {
                if (e.target.querySelector('[name="departure_date"]')) {
                    const depDate = e.target.querySelector('[name="departure_date"]').value;
                    const depTime = e.target.querySelector('[name="departure_time"]').value;
                    if (depDate && depTime) {
                        const combined = `${depDate} ${depTime}:00`;
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'scheduled_departure';
                        input.value = combined;
                        e.target.appendChild(input);
                    }
                    
                    const arrDate = e.target.querySelector('[name="arrival_date"]').value;
                    const arrTime = e.target.querySelector('[name="arrival_time"]').value;
                    if (arrDate && arrTime) {
                        const combined = `${arrDate} ${arrTime}:00`;
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'scheduled_arrival';
                        input.value = combined;
                        e.target.appendChild(input);
                    }
                }
            });
        </script>
    </flux:main>
</x-layouts.app.sidebar>
