<?php
session_start();
include('header.php');
include('config.php');

// Check if client is logged in
if (!isset($_SESSION['client_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Example data fetching (can be replaced by actual queries)
$orders_count = 10;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Welcome to Your Dashboard</h1>
    <div class="stats">
        <div class="card">
            <h3>Total Orders</h3>
            <p><?php echo $orders_count; ?></p>
        </div>
        <div class="card">
            <a href="orders.php">View Orders</a>
        </div>
        <div class="card">
            <a href="profile.php">View Profile</a>
        </div>
        <div class="card">
            <a href="support.php">Contact Support</a>
        </div>
    </div>
</div>

</body>
</html>
