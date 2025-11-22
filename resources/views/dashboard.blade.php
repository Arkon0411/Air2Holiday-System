<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Air2Holiday - Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>

  <!-- MAIN CONTENT -->
  <div class="main-content">

    <!-- TOP HEADER WITH LOGO + NAV + SEARCH + PROFILE -->
    <header class="header">
      <div class="header-left">
        <div class="logo">Air2Holiday</div>
        
        <!-- Navigation  -->
        <nav class="top-nav">
          <a href="#" class="active" data-action="navigate" data-href="/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
          <a href="#" data-action="navigate" data-href="/flights.html"><i class="fas fa-plane"></i> Flights</a>
          <a href="#" data-action="navigate" data-href="/bookings.html"><i class="fas fa-calendar-check"></i> Bookings</a>
        </nav>
      </div>

      <div class="header-right">
        <div class="search-bar">
          <button id="searchBtn" class="search-icon" aria-label="Search"><i class="fas fa-search"></i></button>
          <input id="searchInput" type="text" placeholder="Search...">
        </div>

        <div class="profile" style="position:relative;">
          @php $user = Auth::user(); @endphp
          <img id="profileBtn" src="{{ $user && $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('img/girl.jpg') }}" alt="User" style="cursor:pointer;" />
          <div id="profileMenu" style="display:none;position:absolute;right:0;top:56px;background:#fff;border:1px solid #ddd;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.08);min-width:160px;z-index:50;">
            <a href="{{ route('profile.edit') }}" style="display:block;padding:10px 12px;color:#333;text-decoration:none;border-bottom:1px solid #eee;">Settings</a>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
              @csrf
              <button type="submit" style="display:block;width:100%;padding:10px 12px;border:0;background:none;text-align:left;">Log out</button>
            </form>
          </div>
        </div>
      </div>
    </header>

    <!-- DASHBOARD BODY -->
    <section class="dashboard">
      <div class="welcome">
        <h1>Hello, {{ Auth::user()->name ?? 'User' }}!</h1>
        <p>Welcome back</p>
      </div>

      <h2 class="section-title">Choose your destination</h2>

      <div class="destinations">
        <div class="card" data-destination="Monstadt">
          <img src="{{ asset('img/place1.jpg') }}" alt="place">
          <div class="card-info">
            <h3>Monstadt</h3>
            <p>Starting at <strong>100$</strong></p>
          </div>
        </div>
        <div class="card" data-destination="Sydney">
          <img src="{{ asset('img/place2.jpg') }}" alt="place">
          <div class="card-info">
            <h3>Sydney</h3>
            <p>Starting at <strong>100$</strong></p>
          </div>
        </div>
        <div class="card" data-destination="Manila">
          <img src="{{ asset('img/hell.jpg') }}" alt="place3">
          <div class="card-info">
            <h3>Manila</h3>
            <p>Starting at <strong>100$</strong></p>
          </div>
        </div>
      </div>

      <div class="tabs">
        <span class="active">Most Popular</span>
        <span>Special Offers</span>
        <span>Near Me</span>
        <a href="#" class="view-all">View All</a>
      </div>

      <div class="popular">
        <div class="place">
          <img src="{{ asset('img/tokyo.jpg') }}" alt="Tokyo">
          <div class="place-info">
            <h4>Tokyo</h4>
            <p>40$ / day</p>
          </div>
        </div>
        <div class="place">
          <img src="{{ asset('img/osaka.jpg') }}" alt="Osaka">
          <div class="place-info">
            <h4>Osaka</h4>
            <p>40$ / day</p>
          </div>
        </div>
        <div class="place">
          <img src="{{ asset('img/fontaine.jpg') }}" alt="Fontaine">
          <div class="place-info">
            <h4>Fontaine</h4>
            <p>Starting Apr 20</p>
          </div>
        </div>
      </div>

      <div class="bookings">
        <h3>Bookings <span class="count">2022</span></h3>
        <a href="#" class="view-all">View All</a>
      </div>
    </section>
  </div>

  <script src="{{ asset('js/dashboard.js') }}"></script>
  <script>
    // Listen for Livewire browser event when profile photo is updated
    window.addEventListener('profile-photo-updated', function(e) {
      try {
        var detail = e && e.detail ? e.detail : null;
        if (!detail || !detail.path) return;
        var img = document.getElementById('profileBtn');
        if (!img) return;
        // Use storage path to update image src
        img.src = '/storage/' + detail.path;
      } catch (err) {
        // fail silently
      }
    });
  </script>
</body>
</html>

