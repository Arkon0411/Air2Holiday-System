<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once __DIR__ . '/includes/functions.php';
$user = getUserById($_SESSION['user_id']);

// Get user's planned trips
$userTrips = [];
try {
    $stmt = $pdo->prepare("SELECT ut.*, t.title, t.activity_type, t.city, t.country, t.duration_hours, t.price, t.image_url
                          FROM usertrips ut
                          JOIN trips t ON ut.trip_id = t.id
                          WHERE ut.user_id = ?
                          ORDER BY ut.trip_date DESC");
    $stmt->execute([$_SESSION['user_id']]);
    $userTrips = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Failed to fetch user trips: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Trips | Compass</title>
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
                    <a href="dashboard.php" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active">
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
                <h2>My Planned Trips</h2>
            </div>
            
            <div class="my-trips-container">
                <?php if (empty($userTrips)): ?>
                    <div class="no-trips">
                        <i class="fas fa-compass"></i>
                        <h3>No trips planned yet</h3>
                        <p>Start by planning your first adventure from the Trip Planner!</p>
                        <a href="trip-planner.php" class="btn btn-primary">
                            Plan a Trip
                        </a>
                    </div>
                    <!--
                    <div class="no-trips" style="text-align: center; padding: 2rem; background: white; border-radius: 10px;">
                        <i class="fas fa-compass" style="font-size: 3rem; color: var(--secondary); margin-bottom: 1rem;"></i>
                        <h3>No trips planned yet</h3>
                        <p>Start by planning your first adventure from the Trip Planner!</p>
                        <a href="trip-planner.php" class="btn btn-primary" style="margin-top: 1rem;">
                            <i class="fas fa-plus"></i> Plan a Trip
                        </a>
                    </div>
                    -->
                <?php else: ?>
                    <div class="trip-list">
                        <?php foreach ($userTrips as $trip): ?>
                            <div class="user-trip-card">
                                <img src="<?= htmlspecialchars($trip['image_url']) ?>" alt="<?= htmlspecialchars($trip['title']) ?>" class="user-trip-image">
                                <div class="user-trip-info">
                                    <div class="user-trip-header">
                                        <h3 class="user-trip-title"><?= htmlspecialchars($trip['title']) ?></h3>
                                        <span class="user-trip-date">
                                            <i class="fas fa-calendar-day"></i>
                                            <?= date('M j, Y', strtotime($trip['trip_date'])) ?>
                                        </span>
                                    </div>
                                    
                                    <div class="user-trip-meta" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                                        <span class="trip-activity <?= htmlspecialchars($trip['activity_type']) ?>">
                                        <?= ucfirst(htmlspecialchars($trip['activity_type'])) ?>
                                        </span>
                                        <div class="trip-details" style="display: flex; gap: 1rem;">
                                            <span>
                                                <i class="fas fa-clock"></i>
                                                <?= htmlspecialchars($trip['duration_hours']) ?> hours
                                            </span>
                                            <span>
                                                <i class="fas fa-dollar-sign"></i>
                                                $<?= number_format($trip['price'], 2) ?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="user-trip-details">
                                        <p><strong>Participant:</strong> <?= htmlspecialchars($trip['participant_name']) ?></p>
                                        <p><strong>Contact:</strong> <?= htmlspecialchars($trip['contact_number']) ?></p>
                                        <p><strong>Location:</strong> <?= htmlspecialchars($trip['city']) ?>, <?= htmlspecialchars($trip['country']) ?></p>
                                    </div>

                                    <div class="user-trip-inquiries">
                                    <strong>Inquiries:</strong>
                                    
                                            <?php if ($trip['transportation'] == 1): ?>
                                            <span class="inquiry-tag transportation"> - Transportation - </span>
                                            <?php endif; ?>
                                            <?php if ($trip['weather'] == 1): ?>
                                                <span class="inquiry-tag weather"> - Weather - </span>
                                            <?php endif; ?>
                                            <?php if ($trip['political_info'] == 1): ?>
                                                <span class="inquiry-tag political-info"> - Political Info - </span>
                                            <?php endif; ?>
                                            <?php if ($trip['health'] == 1): ?>
                                                <span class="inquiry-tag health"> - Health - </span>
                                            <?php endif; ?>
                                            <?php if ($trip['gear'] == 1): ?>
                                                <span class="inquiry-tag gear"> - Gear - </span>
                                            <?php endif; ?>
                                            <?php if ($trip['activity_specific'] == 1): ?>
                                                <span class="inquiry-tag activity-specific"> - Activity Specific - </span>
                                            <?php endif; ?>
                                    
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

<script src="assets/js/dashboard.js"></script>
</body>
</html>