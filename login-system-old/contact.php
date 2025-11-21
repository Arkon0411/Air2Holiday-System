<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once __DIR__ . '/includes/functions.php';
$user = getUserById($_SESSION['user_id']);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_log'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image_path = null;

    if (!empty($title) && !empty($content)) {
        // Handle file upload if present
        if (isset($_FILES['log_image']) && $_FILES['log_image']['error'] === UPLOAD_ERR_OK) {
            $image_path = handleFileUpload($_FILES['log_image']);
        }

        // Create the log
        if (createTravelLog($pdo, $_SESSION['user_id'], $title, $content, $image_path)) {
            $_SESSION['show_success_modal'] = true;
            header("Location: travel-log.php");
            exit();
        } else {
            $error = "Failed to create travel log. Please try again.";
        }
    } else {
        $error = "Title and content are required.";
    }
}

// Get all travel logs
$travel_logs = getAllTravelLogs($pdo);
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
                <h2>Contact Page</h2>
            </div>
            <div class="greeting-container">
                <div class="greeting-card" style="background: url('assets/img/greeting-card-bg.png') no-repeat center center; background-size: cover;">
                    <img src="assets/img/compass-logo-brown.png" alt="Compass Logo" class="compass-logo" style="background: transparent;">
                    <p class="greeting-description" style="color: #6B4B3E;">
                    <span style="font-weight: bold;">Contact Number :</span> 09949664732
                    </p>
                    <p class="greeting-description" style="color: #6B4B3E;">
                    <span style="font-weight: bold;">E - Mail :</span> compass@gmail.com
                    </p>
                    <footer style="
    color: #a68b80;
    text-align: center;
    padding: .5rem;
    margin-top: 20px;
    font-size: 0.9rem;
    border-radius: 0.5rem;
    position: relative; /* Adjust to fixed if needed */
    bottom: 0;
    width: 100%;">
                            <p><a href="" class="footer-link" style="color: inherit;"> Contact Us</a></p>
                            <p style="font-size: 0.7rem;">&copy; <?= date('Y') ?> Compass. All rights reserved.</p>
                    </footer>
                </div>
            </div>   
        </main>
    </div>

    <!-- Create Log Modal -->
    <div id="createLogModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h2>Create Travel Log</h2>
            <form action="travel-log.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title*</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content*</label>
                    <textarea id="content" name="content" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="log_image">Upload Image (Optional)</label>
                    <input type="file" id="log_image" name="log_image" accept="image/*">
                </div>
                <button type="submit" name="create_log" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Log
                </button>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal" style="display: none;">
        <div class="modal-content" style="max-width: 400px; text-align: center;">
            <div style="padding: 2rem;">
                <i class="fas fa-check-circle" style="font-size: 3rem; color: var(--success); margin-bottom: 1rem;"></i>
                <h3>Success!</h3>
                <p>Your travel log has been created successfully.</p>
            </div>
        </div>
    </div>



<script src="assets/js/dashboard.js"></script>
<script>
        // Modal functions
        function openCreateModal() {
            document.getElementById('createLogModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('createLogModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        };

        // Close modal with Escape key
        document.onkeydown = function(event) {
            if (event.key === "Escape") {
                closeModal();
            }
        };

        // Show success modal if needed and auto-close after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_SESSION['show_success_modal']) && $_SESSION['show_success_modal']): ?>
            const successModal = document.getElementById('successModal');
            successModal.style.display = 'block';
            
            // Auto-close after 5 seconds
            setTimeout(() => {
                successModal.style.display = 'none';
            }, 5000);
            
            <?php unset($_SESSION['show_success_modal']); ?>
        <?php endif; ?>
        });
    </script>
</body>
</html>