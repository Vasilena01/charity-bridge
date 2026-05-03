<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

// Require authentication
require_login();

// Get current user data
$user = get_current_user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?= SITE_NAME ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome, <?= htmlspecialchars($user['first_name']) ?>!</h1>
            <nav>
                <a href="profile.php">My Profile</a>
                <a href="logout.php">Log Out</a>
            </nav>
        </header>

        <main>
            <div class="dashboard-info">
                <h2>Your Dashboard</h2>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <p><strong>Role:</strong> <?= ucfirst(htmlspecialchars($user['role'])) ?></p>
            </div>

            <?php if ($user['role'] === 'volunteer'): ?>
                <div class="role-specific">
                    <h3>Volunteer Actions</h3>
                    <p>Campaign browsing and participation features coming in Phase 4 & 5.</p>
                </div>
            <?php elseif ($user['role'] === 'organizer'): ?>
                <div class="role-specific">
                    <h3>Organizer Actions</h3>
                    <p>Campaign creation features coming in Phase 2.</p>
                </div>
            <?php elseif ($user['role'] === 'company'): ?>
                <div class="role-specific">
                    <h3>Company Actions</h3>
                    <p>Company campaign registration features coming in Phase 7.</p>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
