<?php
session_start();
include('header.php');
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Example data fetching (replace with actual queries)
$orders_count = 100;
$users_count = 50;
$products_count = 20;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Use your custom CSS -->
</head>
<body>

<!-- Navigation Menu
<nav>
    <a href="https://www.maksudulalam.com/#profile">Home</a>
    <a href="https://www.maksudulalam.com/#licenses">Licenses</a>
    <a href="https://www.maksudulalam.com/#repos">GitHub Repos</a>
    <a href="https://www.maksudulalam.com/#experience">Experience</a>
    <a href="https://www.maksudulalam.com/#skills">Skills</a>
    <a href="https://www.maksudulalam.com/#contact">Contact</a>
</nav>  -->

<div class="container">
    <h1>Welcome to Admin Dashboard</h1>

    <!-- Admin Stats Section -->
    <div class="stats">
        <div class="card">
            <h3>Total Orders</h3>
            <p><?php echo $orders_count; ?></p>
        </div>
        <div class="card">
            <h3>Total Users</h3>
            <p><?php echo $users_count; ?></p>
        </div>
        <div class="card">
            <h3>Total Products</h3>
            <p><?php echo $products_count; ?></p>
        </div>
    </div>

    <!-- Management Links Section -->
    <div class="management-links">
        <div class="card">
            <a href="orders.php">Manage Orders</a>
        </div>
        <div class="card">
            <a href="users.php">Manage Users</a>
        </div>
        <div class="card">
            <a href="packages.php">Manage Packages</a>
        </div>
        <div class="card">
            <a href="products.php">Manage Products</a>
        </div>
    </div>

    <!-- Order Statistics Section (can be replaced by dynamic data) -->
    <div class="charts">
        <h2>Order Statistics</h2>
        <canvas id="ordersChart"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js for graph -->
<script>
    // Example data for chart (replace with actual data from the database)
    const order_per_month = [25, 30, 40, 45, 60, 80, 120, 140, 150, 170, 180, 200];

    // Creating a chart to display order statistics per month
    const ctx = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ctx, {
        type: 'line', // Line chart
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Orders Per Month',
                data: order_per_month,
                borderColor: 'rgb(255, 159, 64)',
                tension: 0.1,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { // X-axis
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: { // Y-axis
                    title: {
                        display: true,
                        text: 'Number of Orders'
                    }
                }
            }
        }
    });
</script>

<style>
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

    h1 {
        color: #f39c12;
        text-align: center;
    }

    .stats, .management-links {
        display: flex;
        justify-content: space-around;
        margin-top: 30px;
    }

    .card {
        background-color: #555;
        padding: 20px;
        border-radius: 6px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        text-align: center;
        width: 200px;
    }

    .card h3 {
        color: #f39c12;
    }

    .card p {
        font-size: 1.5em;
        color: #fff;
    }

    .card a {
        display: block;
        background-color: #f39c12;
        padding: 10px;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        margin-top: 15px;
        text-align: center;
    }

    .card a:hover {
        background-color: #e67e22;
    }

    .charts {
        margin-top: 40px;
        text-align: center;
    }

    canvas {
        max-width: 100%;
        height: 400px;
        margin: 0 auto;
    }
</style>

</body>
<?php
include('footer.php');
?>
</html>
