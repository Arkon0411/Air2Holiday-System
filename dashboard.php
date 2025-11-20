<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    // Store current URL for redirect after login
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("Location: index.php");
    exit();
}



// Get user data (you'll need to add this to functions.php)
require_once __DIR__ . '/includes/functions.php';
$user = getUserById($_SESSION['user_id']);

// Site counts and user planned trips (Air2Holiday integrations)
$counts = getSiteCounts();
$my_planned_trips = getUserPlannedTrips($user['id']);
$recent_logs = getRecentTravelLogs(5);

// Get trips from database
$trips = [];
try {
    $stmt = $pdo->query("SELECT * FROM trips ORDER BY created_at DESC");
    $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Failed to fetch trips: " . $e->getMessage());
}

// Handle filtering/sorting
$activity_filter = $_GET['activity'] ?? '';
$sort_by = $_GET['sort'] ?? 'newest';
$search_query = $_GET['search'] ?? '';

try {
    $query = "SELECT * FROM trips WHERE 1=1";

    // Add activity filter if selected
    if ($activity_filter) {
        $query .= " AND activity_type = :activity";
    }

    // Add search filter if provided
    if ($search_query) {
        $query .= " AND title LIKE :search";
    }

    // Add sorting
    $order_by = $sort_by === 'price' ? 'price' : 
               ($sort_by === 'duration' ? 'duration_hours' : 'created_at DESC');
    $query .= " ORDER BY $order_by";

    $stmt = $pdo->prepare($query);

    // Bind parameters
    if ($activity_filter) {
        $stmt->bindValue(':activity', $activity_filter);
    }
    if ($search_query) {
        $stmt->bindValue(':search', '%' . $search_query . '%');
    }

    $stmt->execute();
    $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Failed to filter trips: " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?= htmlspecialchars($user['username']) ?> | Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ancizar+Serif:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>   
    <!-- Overlay for mobile menu -->
    <div class="overlay" id="overlay"></div>
    
    <div class="dashboard-container">

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand">
                <img src="assets/img/compass-logo-brown.png" alt="Compass Logo" class="brand-logo">
                <h2>Compass</h2>
            </div>
            
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="my-trips.php" class="nav-link">
                        <i class="fas fa-user"></i>
                        <span>My Trips</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="trip-planner.php" class="nav-link">
                    <i class="fa-solid fa-calendar-days"></i>
                        <span>Trip Planner</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="travel-log.php" class="nav-link">
                    <i class="fa-solid fa-clipboard"></i>
                        <span>Travel Log</span>
                    </a>
                </li>
            </ul>

            <div class="user-section">
                <a href="logout.php" class="logout-link">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
                </a>
                    <div class="user-profile" style="margin-top: 0.5rem;">
                        <div class="avatar">
                            <?= strtoupper(substr($user['username'], 0, 1)) ?>
                        </div>
                        <span><?= htmlspecialchars($user['username']) ?></span>
                    </div>
                    <footer class="dashboard-footer">
                        <p><a href="" class="footer-link" style="color: inherit;"> Contact Us</a></p>
                        <p style="font-size: 0.7rem;">&copy; <?= date('Y') ?> Compass. All rights reserved.</p>
                    </footer>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <!-- Mobile Menu Toggle -->
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h2>Dashboard</h2>    
            </div>  

            <!-- Greeting Flexbox -->
            <div class="greeting-container">
                <div class="greeting-card" style="background: url('assets/img/greeting-card-bg.png') no-repeat center center; background-size: cover;">
                    <img src="assets/img/compass-logo-brown.png" alt="Compass Logo" class="compass-logo" style="background: transparent;">
                    <p class="greeting-description" style="color: #6B4B3E;">
                    <span style="font-weight: bold;">Welcome to Compass.</span> Currently we have over 1500 extreme adventures for you to dread over. 
                        From surfing 40-foot waves in the middle of the ocean to fishing for piranha in the Amazon, we've got it all.
                    </p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="stats-container" style="display:flex; gap:1rem; margin-top:1rem;">
                <div class="stat-card" style="background:#fff; padding:1rem; border-radius:.5rem; flex:1; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                    <h3 style="margin:0;">Total Trips</h3>
                    <p style="font-size:1.5rem; margin:0; font-weight:bold;"><?= number_format($counts['trips']) ?></p>
                </div>
                <div class="stat-card" style="background:#fff; padding:1rem; border-radius:.5rem; flex:1; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                    <h3 style="margin:0;">Users</h3>
                    <p style="font-size:1.5rem; margin:0; font-weight:bold;"><?= number_format($counts['users']) ?></p>
                </div>
                <div class="stat-card" style="background:#fff; padding:1rem; border-radius:.5rem; flex:1; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                    <h3 style="margin:0;">Travel Logs</h3>
                    <p style="font-size:1.5rem; margin:0; font-weight:bold;"><?= number_format($counts['travel_logs']) ?></p>
                </div>
            </div>

            <!-- My Upcoming Trips and Recent Logs -->
            <div style="display:flex; gap:1rem; margin-top:1rem;">
                <section style="flex:1; background: rgba(255,255,255,0.9); padding:1rem; border-radius:0.5rem; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                    <h3>My Planned Trips (<?= count($my_planned_trips) ?>)</h3>
                    <?php if (empty($my_planned_trips)): ?>
                        <p>No planned trips yet. Visit <a href="trip-planner.php">Trip Planner</a> to add one.</p>
                    <?php else: ?>
                        <ul style="list-style:none; padding:0; margin:0;">
                            <?php foreach ($my_planned_trips as $mtp): ?>
                                <li style="display:flex; gap:.75rem; align-items:center; padding:.5rem 0; border-bottom:1px solid #eee;">
                                    <img src="<?= htmlspecialchars($mtp['image_url'] ?? 'assets/img/trip-placeholder.png') ?>" alt="" style="width:64px; height:44px; object-fit:cover; border-radius:.25rem;">
                                    <div>
                                        <strong><?= htmlspecialchars($mtp['title'] ?? 'Untitled') ?></strong>
                                        <div style="font-size:.85rem; color:#666;">Planned: <?= htmlspecialchars($mtp['created_at']) ?></div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </section>

                <aside style="width:360px; background: rgba(255,255,255,0.95); padding:1rem; border-radius:0.5rem; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                    <h3>Recent Travel Logs</h3>
                    <?php if (empty($recent_logs)): ?>
                        <p>No travel logs found.</p>
                    <?php else: ?>
                        <ul style="list-style:none; padding:0; margin:0;">
                            <?php foreach ($recent_logs as $log): ?>
                                <li style="padding:.5rem 0; border-bottom:1px solid #f0f0f0;">
                                    <div style="font-weight:600"><?= htmlspecialchars($log['title']) ?></div>
                                    <div style="font-size:.85rem; color:#666;">by <?= htmlspecialchars($log['username']) ?> · <?= date('M j, Y', strtotime($log['created_at'])) ?></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </aside>
            </div>

            <!-- Popular Destinations Section -->
<div class="popular-destinations-container" style="background: rgba(248, 248, 248, 0.8)">
    <h2 class="section-title" style="color: #333;">Popular Destinations</h2>
    <div class="popular-destinations-grid">
        <!-- Hardcoded Trip 1 -->
        <div class="popular-destination-card">
            <div class="card-image" style="background: url('assets/img/trip1.jpg') no-repeat center center; background-size: cover;"></div>
            <div class="card-content">
                <h3 class="trip-title">Japanese Onsen Retreat</h3>
                <p class="trip-activity" style=" background: rgba(139, 87, 42, 0.1); color: #8b572a; ">Camping</p>
                <p class="trip-meta">Experience traditional mountain camping with natural hot spring access. Sleep in comfortable tents near therapeutic mineral waters. Traditional japanese architecture amplifies the experience.</p>
                <button onclick="location.href='trip-planner.php?trip_id=9'"
                    class="btn btn-primary">
                        <i class="fas fa-calendar-check"></i> Plan This Trip
                </button>
            </div>
        </div>
        <!-- Hardcoded Trip 2 -->
        <div class="popular-destination-card">
            <div class="card-image" style="background: url('assets/img/trip2.jpg') no-repeat center center; background-size: cover;"></div>
            <div class="card-content">
                <h3 class="trip-title">Great Wall Trek</h3>
                <p class="trip-activity" style=" background: rgba(106, 168, 79, 0.1); color: #6aa84f; ">Hiking</p>
                <p class="trip-meta">Walk along ancient stone pathways with panoramic mountain views. This less-crowded section offers authentic Ming Dynasty architecture and watchtowers.</p>
                <button onclick="location.href='trip-planner.php?trip_id=7'"
                    class="btn btn-primary">
                        <i class="fas fa-calendar-check"></i> Plan This Trip
                </button>
            </div>
        </div>
        <!-- Hardcoded Trip 3 -->
        <div class="popular-destination-card">
            <div class="card-image" style="background: url('assets/img/trip3.jpg') no-repeat center center; background-size: cover;"></div>
            <div class="card-content">
                <h3 class="trip-title">Swiss Alps Ski Expedition</h3>
                <p class="trip-activity" style=" background: rgba(156, 39, 176, 0.1); color: #9c27b0; ">Sightseeing</p>
                <p class="trip-meta">Carve through pristine powder on the legendary slopes of Zermatt. The package includes lift tickets, equipment rental, and a mountain lunch with Matterhorn views.</p>
                <button onclick="location.href='trip-planner.php?trip_id=4'"
                    class="btn btn-primary">
                        <i class="fas fa-calendar-check"></i> Plan This Trip
                </button>
            </div>
        </div>
    </div>
</div>

            <!-- Filters -->
            <div class="filters" style="font-weight:bold; background-color: #C49E85; border-radius: 0.5rem; padding: 1rem; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <div class="filter-group-container" style="display: flex; gap: 1rem;">
                    <div class="filter-group">
                        <label for="activity" style="color:white">Activity:</label>
                        <select id="activity" onchange="filterTrips()">
                            <option value="">All Activities</option>
                            <option value="hiking" <?= $activity_filter === 'hiking' ? 'selected' : '' ?>>Hiking</option>
                            <option value="swimming" <?= $activity_filter === 'swimming' ? 'selected' : '' ?>>Swimming</option>
                            <option value="cycling" <?= $activity_filter === 'cycling' ? 'selected' : '' ?>>Cycling</option>
                            <option value="camping" <?= $activity_filter === 'camping' ? 'selected' : '' ?>>Camping</option>
                            <option value="sightseeing" <?= $activity_filter === 'sightseeing' ? 'selected' : '' ?>>Sightseeing</option>
                            <option value="skiing" <?= $activity_filter === 'skiing' ? 'selected' : '' ?>>Skiing</option>
                        </select>
                    </div>
                
                    <div class="filter-group">
                        <label for="sort" style="color:white">Sort by:</label>
                        <select id="sort" onchange="filterTrips()">
                            <option value="newest" <?= $sort_by === 'newest' ? 'selected' : '' ?>>Newest</option>
                            <option value="price" <?= $sort_by === 'price' ? 'selected' : '' ?>>Price</option>
                            <option value="duration" <?= $sort_by === 'duration' ? 'selected' : '' ?>>Duration</option>
                        </select>
                    </div>
                </div>
                <!-- Search Bar -->
                <form method="GET" action="dashboard.php">
                    <div class="filter-group search-bar">
                        <div class="search-input-container">
                            <input type="text" id="search" name="search" placeholder="Search trips..." value="<?= htmlspecialchars($search_query) ?>">
                            <button type="submit" id="searchButton" onclick="filterTrips()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Trips Grid -->
            <div class="trips-container" style="background: rgba(248, 248, 248, 0.8); padding: 1.5rem; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <?php foreach ($trips as $trip): ?>
                    <div class="trip-card" onclick="openTripModal(<?= htmlspecialchars(json_encode($trip), ENT_QUOTES, 'UTF-8') ?>)"
                     data-activity="<?= htmlspecialchars($trip['activity_type']) ?>">
                        <img src="<?= htmlspecialchars($trip['image_url']) ?>" alt="<?= htmlspecialchars($trip['title']) ?>" class="trip-image">
                        <div class="trip-info">
                            <span class="trip-activity <?= htmlspecialchars($trip['activity_type']) ?>">
                                <?= ucfirst(htmlspecialchars($trip['activity_type'])) ?>
                            </span>
                            <h3 class="trip-title"><?= htmlspecialchars($trip['title']) ?></h3>
                            <div class="trip-meta">
                                <span><?= htmlspecialchars($trip['duration_hours']) ?> hours</span>
                                <span class="trip-price">$<?= number_format($trip['price'], 2) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            </div>
            
            <!-- Trip Detail Modal -->
            <div id="tripModal" class="modal">
                <div class="modal-content">
                    <span class="close-modal" onclick="closeModal()">&times;</span>
                    <img id="modalImage" src="" alt="" class="modal-image">
                    <h2 id="modalTitle" class="modal-title"></h2>
                    <div class="modal-meta">
                        <span id="modalActivity" class="trip-activity"></span>
                        <span id="modalDuration"></span>
                        <span id="modalPrice" class="trip-price"></span>
                    </div>
                    <p id="modalDescription" class="modal-description"></p>
                    <!-- In your trip modal -->
                    <button onclick="location.href='trip-planner.php?trip_id=' + document.getElementById('modalTripId').value" 
                    class="btn btn-primary">
                        <i class="fas fa-calendar-check"></i> Plan This Trip
                    </button>
                    <!-- Add this hidden input to store the trip ID -->
                    <input type="hidden" id="modalTripId" value="">
                </div>
            </div>
            </main>
        </div>
    </div>

<script src="assets/js/dashboard.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Restore the scroll position when the page loads
    const savedScrollPosition = sessionStorage.getItem('scrollPosition');
    if (savedScrollPosition) {
        window.scrollTo(0, parseInt(savedScrollPosition, 10));
        sessionStorage.removeItem('scrollPosition'); // Clear the saved position
    }

    // Save the scroll position before the page reloads
    const searchForm = document.querySelector('form[action="dashboard.php"]');
    if (searchForm) {
        searchForm.addEventListener('submit', function () {
            sessionStorage.setItem('scrollPosition', window.scrollY);
        });
    }

    // Save the scroll position when dropdown filters are changed
    const activityDropdown = document.getElementById('activity');
        const sortDropdown = document.getElementById('sort');

        function saveScrollPositionAndReload() {
            sessionStorage.setItem('scrollPosition', window.scrollY);
            this.form.submit(); // Submit the form associated with the dropdown
        }

        if (activityDropdown) {
            activityDropdown.addEventListener('change', saveScrollPositionAndReload);
        }

        if (sortDropdown) {
            sortDropdown.addEventListener('change', saveScrollPositionAndReload);
        }
});
</script>
</body>
</html> 