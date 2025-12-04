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
        calendarMoved: false,
        minDate: null, // Minimum selectable date (tomorrow)
        
        init() {
            // Set minimum date to tomorrow
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            tomorrow.setHours(0, 0, 0, 0);
            this.minDate = tomorrow;
            
            this.renderCalendar();
            
            // Move calendar to body for proper z-index stacking
            this.$nextTick(() => {
                if (!this.calendarMoved && this.$refs.calendar) {
                    document.body.appendChild(this.$refs.calendar);
                    this.calendarMoved = true;
                }
            });
            
            // Update position on scroll and resize
            window.addEventListener('scroll', () => {
                if (this.showCalendar) {
                    this.positionCalendar();
                }
            });
            
            window.addEventListener('resize', () => {
                if (this.showCalendar) {
                    this.positionCalendar();
                }
            });
            
            // Close calendar when clicking outside
            document.addEventListener('click', (e) => {
                if (this.$refs.inputWrapper && this.$refs.calendar && 
                    !this.$refs.inputWrapper.contains(e.target) && 
                    !this.$refs.calendar.contains(e.target)) {
                    this.showCalendar = false;
                }
            });
        },
        
        toggleCalendar() {
            this.showCalendar = !this.showCalendar;
            if (this.showCalendar) {
                this.$nextTick(() => {
                    this.positionCalendar();
                });
            }
        },
        
        positionCalendar() {
            const wrapper = this.$refs.inputWrapper;
            const calendar = this.$refs.calendar;
            if (wrapper && calendar) {
                const rect = wrapper.getBoundingClientRect();
                calendar.style.position = 'fixed';
                calendar.style.top = (rect.bottom + 2) + 'px';
                calendar.style.left = rect.left + 'px';
                calendar.style.width = rect.width + 'px';
            }
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
            today.setHours(0, 0, 0, 0);
            
            for (let d = 1; d <= daysInMonth; d++) {
                const dateToCheck = new Date(year, month, d);
                dateToCheck.setHours(0, 0, 0, 0);
                
                const isToday = d === today.getDate() && 
                               month === today.getMonth() && 
                               year === today.getFullYear();
                               
                const isDisabled = dateToCheck < this.minDate;
                
                let btnClass = '';
                if (isDisabled) {
                    btnClass = 'p-2 rounded-md text-gray-300 dark:text-gray-600 cursor-not-allowed';
                } else if (isToday) {
                    btnClass = 'p-2 rounded-md bg-gray-500 text-white font-semibold hover:bg-gray-600';
                } else {
                    btnClass = 'p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700';
                }
                
                const onClick = isDisabled ? '' : `@click="selectDate(${d})"`;
                html += `<button type="button" ${onClick} ${isDisabled ? 'disabled' : ''} class="${btnClass}">${d}</button>`;
            }
            
            this.calendarDays = html;
        },
        
        selectDate(day) {
            const year = this.currentDate.getFullYear();
            const month = this.currentDate.getMonth();
            const selected = new Date(year, month, day);
            selected.setHours(0, 0, 0, 0);
            
            // Prevent selection of dates before minDate
            if (selected < this.minDate) {
                return;
            }
            
            // Format as YYYY-MM-DD for both display and hidden input
            const yyyy = selected.getFullYear();
            const mm = String(selected.getMonth() + 1).padStart(2, '0');
            const dd = String(selected.getDate()).padStart(2, '0');
            const formattedDate = `${yyyy}-${mm}-${dd}`;
            
            this.selectedDate = formattedDate;
            this.hiddenDate = formattedDate;
            this.showCalendar = false;
        },
        
        selectToday() {
            // Changed to select tomorrow instead of today (minimum allowed date)
            const tomorrow = new Date(this.minDate);
            
            // Format as YYYY-MM-DD for both display and hidden input
            const yyyy = tomorrow.getFullYear();
            const mm = String(tomorrow.getMonth() + 1).padStart(2, '0');
            const dd = String(tomorrow.getDate()).padStart(2, '0');
            const formattedDate = `${yyyy}-${mm}-${dd}`;
            
            this.selectedDate = formattedDate;
            this.hiddenDate = formattedDate;
            this.currentDate = new Date(tomorrow);
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
