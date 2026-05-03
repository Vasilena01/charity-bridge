<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

// If logged in, redirect to dashboard
if (is_logged_in()) {
    redirect_by_role();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> - Support Charitable Campaigns</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <nav style="text-align: right;">
                <a href="login.php">Log In</a>
                <a href="signup.php" class="btn btn-primary" style="padding: 8px 16px;">Sign Up</a>
            </nav>
        </header>

        <div class="hero">
            <h1><?= SITE_NAME ?></h1>
            <p>Support charitable campaigns through donations, volunteering, and community action</p>
            <a href="signup.php" class="btn btn-primary">Get Started</a>
            <a href="login.php" class="btn btn-secondary">Log In</a>
        </div>

        <div class="features">
            <div class="feature-card">
                <h3>For Volunteers</h3>
                <p>Browse campaigns, donate virtual currency, sign up for volunteer opportunities, and track your impact across multiple causes.</p>
            </div>

            <div class="feature-card">
                <h3>For Organizers</h3>
                <p>Create and manage charitable campaigns with goal tracking, volunteer coordination, and goods/services offerings.</p>
            </div>

            <div class="feature-card">
                <h3>For Companies</h3>
                <p>Register your campaigns, make large contributions, and amplify your company's charitable impact.</p>
            </div>
        </div>

        <div class="card" style="text-align: center; margin-top: 40px;">
            <h2>How It Works</h2>
            <p style="margin: 20px 0;">CharityBridge connects people who want to help with campaigns that need support. Whether you're organizing a Christmas bazaar, running an online fundraiser, or coordinating volunteer efforts, we make it easy to track contributions of all types.</p>
            <a href="signup.php" class="btn btn-primary">Join Now</a>
        </div>
    </div>

    <footer style="text-align: center; padding: 40px 20px; color: #666;">
        <p>&copy; <?= date('Y') ?> <?= SITE_NAME ?>. All rights reserved.</p>
    </footer>
</body>
</html>
