<?php
session_start();
include('header.php');
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Fetch packages from the database
$stmt = $pdo->query('SELECT * FROM packages');
$packages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages</title>
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
            width: 80%;
            margin: 50px auto;
            padding: 30px;
            background-color: #444;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #f39c12;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #f39c12;
            color: white;
        }

        .card {
            display: inline-block;
            width: 30%;
            background-color: #444;
            margin: 10px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card a {
            text-decoration: none;
            color: #f39c12;
            display: block;
            margin-top: 10px;
        }

        .card a:hover {
            color: #e67e22;
        }

        .add-package-btn {
            background-color: #f39c12;
            color: white;
            padding: 12px 18px;
            text-decoration: none;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 20px;
            transition: background-color 0.3s ease-in-out;
        }

        .add-package-btn:hover {
            background-color: #e67e22;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            .card {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<!-- Admin Dashboard Container -->
<div class="container">
    <h2>Manage Packages</h2>

    <!-- Add New Package Button -->
    <a href="add_package.php" class="add-package-btn">Add New Package</a>

    <!-- Packages Table -->
    <table>
        <thead>
            <tr>
                <th>Package ID</th>
                <th>Package Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($packages as $package): ?>
                <tr>
                    <td><?php echo $package['id']; ?></td>
                    <td><?php echo $package['name']; ?></td>
                    <td><?php echo $package['price']; ?></td>
                    <td><?php echo $package['description']; ?></td>
                    <td>
                        <a href="edit_package.php?id=<?php echo $package['id']; ?>">Edit</a>
                        |
                        <a href="delete_package.php?id=<?php echo $package['id']; ?>" onclick="return confirm('Are you sure you want to delete this package?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
