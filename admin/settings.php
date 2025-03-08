<?php
session_start();
include('header.php');
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Fetch current settings from the database
$stmt = $pdo->query('SELECT * FROM settings LIMIT 1');
$settings = $stmt->fetch();

// Check if settings exist, otherwise, create default settings
if (!$settings) {
    $stmt = $pdo->prepare("INSERT INTO settings (payment_gateway, email_from_name, email_from_address) VALUES ('PayPal', 'Admin', 'admin@example.com')");
    $stmt->execute();
    header('Location: settings.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update settings in the database
    $payment_gateway = $_POST['payment_gateway'];
    $paypal_client_id = $_POST['paypal_client_id'];
    $paypal_secret = $_POST['paypal_secret'];
    $stripe_publishable_key = $_POST['stripe_publishable_key'];
    $stripe_secret_key = $_POST['stripe_secret_key'];
    $smtp_host = $_POST['smtp_host'];
    $smtp_port = $_POST['smtp_port'];
    $smtp_username = $_POST['smtp_username'];
    $smtp_password = $_POST['smtp_password'];
    $email_from_name = $_POST['email_from_name'];
    $email_from_address = $_POST['email_from_address'];

    // Update Settings
    $stmt = $pdo->prepare("UPDATE settings SET payment_gateway = ?, paypal_client_id = ?, paypal_secret = ?, stripe_publishable_key = ?, stripe_secret_key = ?, smtp_host = ?, smtp_port = ?, smtp_username = ?, smtp_password = ?, email_from_name = ?, email_from_address = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
    $stmt->execute([$payment_gateway, $paypal_client_id, $paypal_secret, $stripe_publishable_key, $stripe_secret_key, $smtp_host, $smtp_port, $smtp_username, $smtp_password, $email_from_name, $email_from_address, $settings['id']]);

    $success_message = "Settings updated successfully!";
}

// Change Password Logic
if (isset($_POST['change_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the admin's current password from the database
    $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = :username');
    $stmt->execute(['username' => $_SESSION['admin_username']]);
    $admin = $stmt->fetch();

    // Check if old password matches
    if ($admin && password_verify($old_password, $admin['password'])) {
        // Check if new password matches confirm password
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            
            // Update the password in the database
            $stmt = $pdo->prepare("UPDATE admins SET password = :password WHERE username = :username");
            $stmt->execute(['password' => $hashed_password, 'username' => $_SESSION['admin_username']]);

            $password_success_message = "Password updated successfully!";
        } else {
            $password_error_message = "New password and confirm password do not match.";
        }
    } else {
        $password_error_message = "Old password is incorrect.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link rel="stylesheet" href="style.css">
    <style>
                body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        

        /* Main Content Area */
        .main-content {
            margin: 50px auto;
            width: 80%;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #f39c12;
        }

        /* Tabs Styling */
        .tabs {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            background-color: #444;
            padding: 10px;
            border-radius: 8px;
        }

        .tabs a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            background-color: #333;
        }

        .tabs a:hover {
            background-color: #f39c12;
        }

        .tabs a.active {
            background-color: #f39c12;
        }

        /* Form Styling */
        .container {
            width: 80%;
            margin: 50px auto;
            padding: 30px;
            background-color: #444;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #f39c12;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .order-btn {
            background-color: #f39c12;
            color: white;
            padding: 12px 18px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            border-radius: 6px;
            width: 100%;
            transition: background-color 0.3s ease-in-out;
        }

        .order-btn:hover {
            background-color: #e67e22;
        }

        .success, .error {
            color: green;
            font-size: 14px;
            text-align: center;
        }

        .error {
            color: red;
        }

        .password-section {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<!-- Sidebar
<div class="sidebar">
    <a href="settings.php" class="active"><i class="fas fa-cogs"></i> Settings</a>
    <a href="change_password.php"><i class="fas fa-key"></i> Change Password</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div> -->

<!-- Main Content Area -->
<div class="main-content">
    <h2>Admin Settings</h2>

    <!-- Tabs -->
    <div class="tabs">
        <a href="#payment" class="tab-link active">Payment Settings</a>
        <a href="#smtp" class="tab-link">SMTP Settings</a>
        <a href="#email" class="tab-link">Email Settings</a>
    </div>

    <!-- Settings Forms -->
    <div class="container" id="payment">
        <form action="settings.php" method="POST">
            <label for="payment_gateway">Payment Gateway:</label>
            <select id="payment_gateway" name="payment_gateway">
                <option value="PayPal" <?php echo $settings['payment_gateway'] == 'PayPal' ? 'selected' : ''; ?>>PayPal</option>
                <option value="Stripe" <?php echo $settings['payment_gateway'] == 'Stripe' ? 'selected' : ''; ?>>Stripe</option>
                <option value="Bank Transfer" <?php echo $settings['payment_gateway'] == 'Bank Transfer' ? 'selected' : ''; ?>>Bank Transfer</option>
                <option value="Other" <?php echo $settings['payment_gateway'] == 'Other' ? 'selected' : ''; ?>>Other</option>
            </select>

            <label for="paypal_client_id">PayPal Client ID:</label>
            <input type="text" id="paypal_client_id" name="paypal_client_id" value="<?php echo $settings['paypal_client_id']; ?>">

            <label for="paypal_secret">PayPal Secret:</label>
            <input type="text" id="paypal_secret" name="paypal_secret" value="<?php echo $settings['paypal_secret']; ?>">

            <label for="stripe_publishable_key">Stripe Publishable Key:</label>
            <input type="text" id="stripe_publishable_key" name="stripe_publishable_key" value="<?php echo $settings['stripe_publishable_key']; ?>">

            <label for="stripe_secret_key">Stripe Secret Key:</label>
            <input type="text" id="stripe_secret_key" name="stripe_secret_key" value="<?php echo $settings['stripe_secret_key']; ?>">

            <button type="submit" class="order-btn">Save Settings</button>
        </form>
    </div>

    <!-- SMTP Settings -->
    <div class="container" id="smtp" style="display: none;">
        <form action="settings.php" method="POST">
            <label for="smtp_host">SMTP Host:</label>
            <input type="text" id="smtp_host" name="smtp_host" value="<?php echo $settings['smtp_host']; ?>">

            <label for="smtp_port">SMTP Port:</label>
            <input type="text" id="smtp_port" name="smtp_port" value="<?php echo $settings['smtp_port']; ?>">

            <label for="smtp_username">SMTP Username:</label>
            <input type="text" id="smtp_username" name="smtp_username" value="<?php echo $settings['smtp_username']; ?>">

            <label for="smtp_password">SMTP Password:</label>
            <input type="text" id="smtp_password" name="smtp_password" value="<?php echo $settings['smtp_password']; ?>">

            <button type="submit" class="order-btn">Save Settings</button>
        </form>
    </div>

    <!-- Email Settings -->
    <div class="container" id="email" style="display: none;">
        <form action="settings.php" method="POST">
            <label for="email_from_name">Email From Name:</label>
            <input type="text" id="email_from_name" name="email_from_name" value="<?php echo $settings['email_from_name']; ?>">

            <label for="email_from_address">Email From Address:</label>
            <input type="email" id="email_from_address" name="email_from_address" value="<?php echo $settings['email_from_address']; ?>">

            <button type="submit" class="order-btn">Save Settings</button>
        </form>
    </div>

    <!-- Change Password Form -->
    <div class="password-section">
        <h3>Change Password</h3>

        <?php if (isset($password_success_message)): ?>
            <div class="success"><?php echo $password_success_message; ?></div>
        <?php elseif (isset($password_error_message)): ?>
            <div class="error"><?php echo $password_error_message; ?></div>
        <?php endif; ?>

        <form action="settings.php" method="POST">
            <label for="old_password">Old Password:</label>
            <input type="password" id="old_password" name="old_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit" class="order-btn" name="change_password">Change Password</button>
        </form>
    </div>
</div>

<!-- JavaScript to Toggle Tabs -->
<script>
    const tabs = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.container');

    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(content => content.style.display = 'none');
            
            const targetTab = document.querySelector(tab.getAttribute('href'));
            tab.classList.add('active');
            targetTab.style.display = 'block';
        });
    });
</script>

</body>
</html>
