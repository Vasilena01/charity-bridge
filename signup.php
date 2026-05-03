<?php
require_once 'includes/config.php';

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$errors = [];
$success = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF token validation
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errors[] = 'Invalid request. Please try again.';
    } else {
        // Sanitize and validate inputs
        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';
        $first_name = trim($_POST['first_name'] ?? '');
        $last_name = trim($_POST['last_name'] ?? '');
        $role = $_POST['role'] ?? '';

        // Validation
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid email is required.';
        }
        if (strlen($password) < PASSWORD_MIN_LENGTH) {
            $errors[] = 'Password must be at least ' . PASSWORD_MIN_LENGTH . ' characters.';
        }
        if ($password !== $password_confirm) {
            $errors[] = 'Passwords do not match.';
        }
        if (empty($first_name) || strlen($first_name) > 100) {
            $errors[] = 'First name is required (max 100 characters).';
        }
        if (empty($last_name) || strlen($last_name) > 100) {
            $errors[] = 'Last name is required (max 100 characters).';
        }
        if (!in_array($role, ['volunteer', 'organizer', 'company'])) {
            $errors[] = 'Please select a valid role.';
        }

        // Check if email already exists
        if (empty($errors)) {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->fetch()) {
                $errors[] = 'Email address is already registered.';
            }
        }

        // Insert user if no errors
        if (empty($errors)) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare(
                "INSERT INTO users (email, password_hash, first_name, last_name, role)
                 VALUES (:email, :password_hash, :first_name, :last_name, :role)"
            );
            $result = $stmt->execute([
                'email' => $email,
                'password_hash' => $password_hash,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'role' => $role
            ]);

            if ($result) {
                $success = 'Registration successful! You can now <a href="login.php">log in</a>.';
            } else {
                $errors[] = 'Registration failed. Please try again.';
            }
        }
    }
}

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - <?= SITE_NAME ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Sign Up for <?= SITE_NAME ?></h1>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success">
                <p><?= $success ?></p>
            </div>
        <?php else: ?>
            <form method="POST" action="signup.php">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required maxlength="100"
                           value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required maxlength="100"
                           value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required
                           minlength="<?= PASSWORD_MIN_LENGTH ?>">
                    <small>Minimum <?= PASSWORD_MIN_LENGTH ?> characters</small>
                </div>

                <div class="form-group">
                    <label for="password_confirm">Confirm Password:</label>
                    <input type="password" id="password_confirm" name="password_confirm" required>
                </div>

                <div class="form-group">
                    <label for="role">I am a:</label>
                    <select id="role" name="role" required>
                        <option value="">-- Select Role --</option>
                        <option value="volunteer" <?= ($_POST['role'] ?? '') === 'volunteer' ? 'selected' : '' ?>>
                            Volunteer/Donor
                        </option>
                        <option value="organizer" <?= ($_POST['role'] ?? '') === 'organizer' ? 'selected' : '' ?>>
                            Campaign Organizer
                        </option>
                        <option value="company" <?= ($_POST['role'] ?? '') === 'company' ? 'selected' : '' ?>>
                            Company Representative
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>

            <p class="text-center">
                Already have an account? <a href="login.php">Log in</a>
            </p>
        <?php endif; ?>
    </div>
</body>
</html>
