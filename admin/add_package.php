<?php
session_start();
include('header.php');
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Initialize error and success messages
$error_message = '';
$success_message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    // Validate input fields
    if (empty($name) || empty($price) || empty($description)) {
        $error_message = "All fields (name, price, and description) are required!";
    } else {
        // Insert new package into the database
        $stmt = $pdo->prepare('INSERT INTO packages (name, price, description) VALUES (:name, :price, :description)');
        $stmt->execute(['name' => $name, 'price' => $price, 'description' => $description]);

        // Set success message
        $success_message = "Package added successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Package</title>
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
            text-align: center;
            color: #f39c12;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #f39c12;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        input[type="submit"] {
            background-color: #f39c12;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #e67e22;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
        }

        .success {
            color: green;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Admin Dashboard Container -->
<div class="container">
    <h2>Add New Package</h2>

    <!-- Display error or success message -->
    <?php if (!empty($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <?php if (!empty($success_message)): ?>
        <div class="success"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <!-- Add New Package Form -->
    <form method="POST">
        <label for="name">Package Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="price">Package Price:</label>
        <input type="number" name="price" id="price" required>

        <label for="description">Package Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea>

        <input type="submit" value="Add Package">
    </form>
</div>

</body>
</html>
