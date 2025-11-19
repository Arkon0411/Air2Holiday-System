
document.addEventListener('DOMContentLoaded', function () {
    const activityFilter = document.getElementById('activity');
    const sortFilter = document.getElementById('sort');
    const header = document.querySelector('.header');

    // Listen for scroll events
    window.addEventListener('scroll', function () {
        if (window.scrollY > 0) {
            header.classList.add('scrolled'); // Add scrolled class when scrolling down
        } else {
            header.classList.remove('scrolled'); // Remove scrolled class when back at the top
        }
    });

    // Function to handle filtering and sorting
    function filterTrips() {
        const activity = activityFilter ? activityFilter.value : '';
        const sort = sortFilter ? sortFilter.value : '';

        // Build the query string
        const params = new URLSearchParams();
        if (activity) params.append('activity', activity);
        if (sort) params.append('sort', sort);

        // Redirect to the same page with the query parameters
        window.location.href = `dashboard.php?${params.toString()}`;
    }

    // Attach event listeners to the dropdowns
    if (activityFilter) {
        activityFilter.addEventListener('change', filterTrips);
    }
    if (sortFilter) {
        sortFilter.addEventListener('change', filterTrips);
    }
});
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('overlay');

    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });

    document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    });

    function highlightCountry() {
        // Get the selected country
        const selectedCountry = document.getElementById('country').value;
    
        // Reset all countries to default color
        const countries = document.querySelectorAll('#world-map path');
        countries.forEach(country => {
            country.style.fill = 'black'; // Default color
        });
    
        // Highlight the selected country
        if (selectedCountry) {
            const countryElement = document.getElementById(selectedCountry);
            if (countryElement) {
                countryElement.style.fill = '#f8961e'; // Highlight color
            }
        }
    }

    
    // Modal functions
    function openTripModal(trip) {
        console.log('Opening modal for trip:', trip); // Debugging line
        
        const modal = document.getElementById('tripModal');
        document.getElementById('modalImage').src = trip.image_url;
        document.getElementById('modalImage').alt = trip.title;
        document.getElementById('modalTitle').textContent = trip.title;
        document.getElementById('modalTripId').value = trip.id;
        
        const activitySpan = document.getElementById('modalActivity');
        activitySpan.textContent = trip.activity_type.charAt(0).toUpperCase() + trip.activity_type.slice(1);
        activitySpan.className = 'trip-activity ' + trip.activity_type;
        
        document.getElementById('modalDuration').textContent = trip.duration_hours + ' hours';
        const price = parseFloat(trip.price);
        document.getElementById('modalPrice').textContent = '$' + price.toFixed(2);
        document.getElementById('modalDescription').textContent = trip.description;
        
        modal.style.display = 'block';
        console.log('Modal should be visible now'); // Debugging line
    }
    
    function closeModal() {
        document.getElementById('tripModal').style.display = 'none';
    }
    
    // Close modal when clicking outside or escape key
    window.onclick = function(event) {
        const modal = document.getElementById('tripModal');
        if (event.target === modal) {
            closeModal();
        }
    };
    
    document.onkeydown = function(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    };