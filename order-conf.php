<?php
session_start();
include('header.php');
include('config.php');

// Fetch order details for admin
$sql = "SELECT * FROM orders WHERE customer_id = :customer_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['customer_id' => $_SESSION['customer_id']]);
$order = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Add CSS for admin order confirmation */
    </style>
</head>
<body>

    <!-- Navigation Menu -->
    <nav>
        <a href="https://www.maksudulalam.com/#profile">Home</a>
        <a href="https://www.maksudulalam.com/#licenses">Licenses</a>
        <a href="https://www.maksudulalam.com/#repos">GitHub Repos</a>
        <a href="https://www.maksudulalam.com/#experience">Experience</a>
        <a href="https://www.maksudulalam.com/#skills">Skills</a>
        <a href="https://www.maksudulalam.com/#contact">Contact</a>
    </nav>

    <div class="container">
        <h1>Order Confirmation</h1>
        <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
        <p><strong>Package:</strong> <?php echo $order['package']; ?></p>
        <p><strong>Customer:</strong> <?php echo $order['name']; ?></p>
    </div>

</body>
</html>
