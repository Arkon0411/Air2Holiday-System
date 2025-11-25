@props(['label', 'name', 'required' => false])

<div x-data="datePicker('{{ $name }}')">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <div class="relative">
        <div @click="toggleCalendar" class="flex items-center border rounded-md py-2 px-3 border-gray-300 bg-white cursor-pointer dark:border-gray-600 dark:bg-gray-800">
            <input x-model="selectedDate" type="text" readonly placeholder="DD/MM/YYYY" class="w-full bg-transparent outline-none text-gray-900 dark:text-gray-50 text-sm select-none cursor-pointer" />
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 9h18M4.5 7.5v12.75A2.25 2.25 0 006.75 22.5h10.5a2.25 2.25 0 002.25-2.25V7.5" />
            </svg>
        </div>
        
        <!-- Calendar Dropdown -->
        <div x-show="showCalendar" @click.away="showCalendar = false" x-cloak class="absolute border border-gray-300 z-50 mt-1 bg-white shadow-lg rounded-md w-full p-5 dark:bg-gray-800 dark:border-gray-600">
            <div class="flex justify-between items-center mb-4">
                <button @click="prevMonth" type="button" class="p-1 border border-gray-300 rounded-md hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <div class="text-center font-semibold text-gray-800 dark:text-gray-200 text-base" x-text="monthLabel"></div>
                <button @click="nextMonth" type="button" class="p-1 border border-gray-300 rounded-md hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-7 text-center text-sm font-medium mb-2">
                <div>Su</div><div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div>
            </div>
            <div class="grid grid-cols-7 text-center text-sm gap-1" x-html="calendarDays"></div>
            <div class="flex justify-end mt-2">
                <button @click="selectToday" type="button" class="bg-gray-700 px-2 py-1 text-white rounded-sm text-xs hover:bg-gray-800">Today</button>
            </div>
        </div>
    </div>
    <input type="hidden" name="{{ $name }}" x-model="hiddenDate" {{ $required ? 'required' : '' }} />
</div>
