/**
 * Date Picker Alpine.js Component
 * Reusable date picker with calendar dropdown
 */
function datePicker(fieldName) {
    return {
        showCalendar: false,
        currentDate: new Date(),
        selectedDate: '',
        hiddenDate: '',
        monthLabel: '',
        calendarDays: '',
        
        init() {
            this.renderCalendar();
        },
        
        toggleCalendar() {
            this.showCalendar = !this.showCalendar;
        },
        
        renderCalendar() {
            const year = this.currentDate.getFullYear();
            const month = this.currentDate.getMonth();
            
            const monthNames = [
                "January","February","March","April","May","June",
                "July","August","September","October","November","December"
            ];
            this.monthLabel = `${monthNames[month]} ${year}`;
            
            const firstDay = new Date(year, month, 1);
            const startingDay = firstDay.getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            
            let html = '';
            
            // Empty slots before start
            for (let i = 0; i < startingDay; i++) {
                html += '<div></div>';
            }
            
            // Days
            const today = new Date();
            for (let d = 1; d <= daysInMonth; d++) {
                const isToday = d === today.getDate() && 
                               month === today.getMonth() && 
                               year === today.getFullYear();
                const btnClass = isToday 
                    ? 'p-2 rounded-md bg-gray-500 text-white font-semibold hover:bg-gray-600' 
                    : 'p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700';
                html += `<button type="button" @click="selectDate(${d})" class="${btnClass}">${d}</button>`;
            }
            
            this.calendarDays = html;
        },
        
        selectDate(day) {
            const year = this.currentDate.getFullYear();
            const month = this.currentDate.getMonth();
            const selected = new Date(year, month, day);
            this.selectedDate = selected.toLocaleDateString('en-GB');
            this.hiddenDate = selected.toISOString().split('T')[0];
            this.showCalendar = false;
        },
        
        selectToday() {
            const today = new Date();
            this.selectedDate = today.toLocaleDateString('en-GB');
            this.hiddenDate = today.toISOString().split('T')[0];
            this.currentDate = today;
            this.renderCalendar();
            this.showCalendar = false;
        },
        
        prevMonth() {
            this.currentDate.setMonth(this.currentDate.getMonth() - 1);
            this.renderCalendar();
        },
        
        nextMonth() {
            this.currentDate.setMonth(this.currentDate.getMonth() + 1);
            this.renderCalendar();
        }
    };
}

// Register with Alpine
document.addEventListener('alpine:init', () => {
    Alpine.data('datePicker', datePicker);
});
