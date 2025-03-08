<?php
session_start();
include('header.php');
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Retrieve order ID from URL
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // Fetch the order details from the database
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = :id");
    $stmt->execute(['id' => $order_id]);
    $order = $stmt->fetch();

    // Check if the order exists
    if (!$order) {
        die("Order not found.");
    }

    // Fetch customer details
    $stmt_customer = $pdo->prepare("SELECT * FROM customers WHERE id = :id");
    $stmt_customer->execute(['id' => $order['customer_id']]);
    $customer = $stmt_customer->fetch();

    // Fetch package details
    $stmt_package = $pdo->prepare("SELECT * FROM packages WHERE id = :id");
    $stmt_package->execute(['id' => $order['package_id']]);
    $package = $stmt_package->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 70%;
            margin: 50px auto;
            padding: 30px;
            background-color: #444;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #f39c12;
        }

        .order-details, .customer-details, .package-details {
            margin: 20px 0;
        }

        .order-details table, .customer-details table, .package-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-details th, .customer-details th, .package-details th,
        .order-details td, .customer-details td, .package-details td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
        }

        .order-details th, .customer-details th, .package-details th {
            background-color: #555;
            color: #fff;
        }

        .order-details td, .customer-details td, .package-details td {
            background-color: #444;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 15px;
            background-color: #f39c12;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #e67e22;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>Order Details</h2>

    <!-- Order Details Section -->
    <div class="order-details">
        <h3>Order Information</h3>
        <table>
            <tr>
                <th>Order ID</th>
                <td><?php echo $order['id']; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo $order['status']; ?></td>
            </tr>
            <tr>
                <th>Order Date</th>
                <td><?php echo $order['order_date']; ?></td>
            </tr>
        </table>
    </div>

    <!-- Customer Details Section -->
    <div class="customer-details">
        <h3>Customer Information</h3>
        <table>
            <tr>
                <th>Customer Name</th>
                <td><?php echo $customer['full_name']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $customer['email']; ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?php echo $customer['phone']; ?></td>
            </tr>
            <tr>
                <th>WhatsApp</th>
                <td><?php echo $customer['whatsapp']; ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo $customer['address']; ?></td>
            </tr>
        </table>
    </div>

    <!-- Package Details Section -->
    <div class="package-details">
        <h3>Package Information</h3>
        <table>
            <tr>
                <th>Package Name</th>
                <td><?php echo $package['name']; ?></td>
            </tr>
            <tr>
                <th>Package Price</th>
                <td><?php echo $package['price']; ?> USD</td>
            </tr>
            <tr>
                <th>Description</th>
                <td><?php echo $package['description']; ?></td>
            </tr>
        </table>
    </div>

    <!-- Back Button -->
    <a href="orders.php" class="btn-back">Back to Orders</a>
</div>

</body>
</html>
