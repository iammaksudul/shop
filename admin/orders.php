<?php
session_start();
include('header.php');
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Set the number of results per page
$results_per_page = 10;

// Get the total number of orders
$stmt_count = $pdo->query('SELECT COUNT(*) FROM orders');
$total_orders = $stmt_count->fetchColumn();

// Calculate the total number of pages
$total_pages = ceil($total_orders / $results_per_page);

// Get the current page number from the URL, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = ($current_page > $total_pages) ? $total_pages : $current_page;
$current_page = ($current_page < 1) ? 1 : $current_page;

// Calculate the starting row for the query
$start_row = ($current_page - 1) * $results_per_page;

// Fetch orders from the database with LIMIT and OFFSET for pagination
$stmt = $pdo->prepare('SELECT * FROM orders LIMIT :start_row, :results_per_page');
$stmt->bindValue(':start_row', $start_row, PDO::PARAM_INT);
$stmt->bindValue(':results_per_page', $results_per_page, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll();

// Handle delete order
if (isset($_GET['delete_id'])) {
    $order_id = $_GET['delete_id'];
    $stmt_delete = $pdo->prepare('DELETE FROM orders WHERE id = :id');
    $stmt_delete->execute(['id' => $order_id]);
    header('Location: orders.php'); // Redirect after deletion
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="style.css"> <!-- Use your custom CSS -->
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 50px auto;
            padding: 30px;
            background-color: #444;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #f39c12; /* Orange color */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        table th {
            background-color: #555;
            color: #fff;
        }

        table td {
            background-color: #444;
        }

        table tr:hover {
            background-color: #555;
        }

        a {
            color: #f39c12;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #e67e22;
        }

        .btn-delete {
            color: #fff;
            background-color: red;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .btn-delete:hover {
            background-color: darkred;
        }

        /* Pagination styling */
        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            color: #f39c12;
            padding: 10px;
            text-decoration: none;
            margin: 0 5px;
            border-radius: 6px;
        }

        .pagination a:hover {
            background-color: #e67e22;
        }

    </style>
</head>
<body>

<!-- Admin Dashboard Container -->
<div class="container">
    <h2>Manage Orders</h2>

    <!-- Orders Table -->
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Package</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                <td><?php echo htmlspecialchars($order['package_name']); ?></td>
                <td><?php echo htmlspecialchars($order['status']); ?></td>
                <td>
                    <a href="view_order.php?id=<?php echo $order['id']; ?>">View</a>
                    <a href="orders.php?delete_id=<?php echo $order['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination Section -->
    <div class="pagination">
        <!-- Previous Page Link -->
        <?php if ($current_page > 1): ?>
            <a href="orders.php?page=<?php echo $current_page - 1; ?>">« Previous</a>
        <?php endif; ?>

        <!-- Page Links -->
        <?php for ($page = 1; $page <= $total_pages; $page++): ?>
            <a href="orders.php?page=<?php echo $page; ?>" <?php if ($page == $current_page) echo 'style="background-color: #e67e22;"'; ?>><?php echo $page; ?></a>
        <?php endfor; ?>

        <!-- Next Page Link -->
        <?php if ($current_page < $total_pages): ?>
            <a href="orders.php?page=<?php echo $current_page + 1; ?>">Next »</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
