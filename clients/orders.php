<?php
session_start();
include('header.php');
include('config.php');

// Check if client is logged in
if (!isset($_SESSION['client_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Fetch client's orders from the database
$stmt = $pdo->query('SELECT * FROM orders WHERE client_id = :client_id');
$stmt->execute(['client_id' => $_SESSION['client_id']]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
</head>
<body>

<div class="container">
    <h2>My Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Package</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['package_name']; ?></td>
                <td><?php echo $order['status']; ?></td>
                <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                <td>
                    <a href="view_order.php?id=<?php echo $order['id']; ?>">View</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
