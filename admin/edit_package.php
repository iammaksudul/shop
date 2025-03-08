<?php
session_start();
include('header.php');
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Check if package ID is provided
if (!isset($_GET['id'])) {
    die("Package ID is required to edit the package.");
}

$package_id = $_GET['id'];

// Fetch the package details from the database
$stmt = $pdo->prepare('SELECT * FROM packages WHERE id = :id');
$stmt->execute(['id' => $package_id]);
$package = $stmt->fetch();

if (!$package) {
    die("Package not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];  // Add description field

    if (empty($name) || empty($price) || empty($description)) {
        $error_message = "Package name, price, and description are required!";
    } else {
        // Update the package details in the database
        $stmt_update = $pdo->prepare('UPDATE packages SET name = :name, price = :price, description = :description WHERE id = :id');
        $stmt_update->execute(['name' => $name, 'price' => $price, 'description' => $description, 'id' => $package_id]);

        // Success message
        $success_message = "Package updated successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Package</title>
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
            width: 600px;
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

        form {
            margin-top: 20px;
        }

        input[type="text"], input[type="number"], textarea, input[type="submit"] {
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #f39c12;
            color: white;
            cursor: pointer;
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
    <h2>Edit Package: <?php echo htmlspecialchars($package['name']); ?></h2>

    <!-- Success or Error Messages -->
    <?php if (isset($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <?php if (isset($success_message)): ?>
        <div class="success"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <!-- Edit Package Form -->
    <form method="POST">
        <label for="name">Package Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($package['name']); ?>" required>

        <label for="price">Package Price:</label>
        <input type="number" name="price" value="<?php echo htmlspecialchars($package['price']); ?>" required>

        <label for="description">Package Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($package['description']); ?></textarea>

        <input type="submit" value="Update Package">
    </form>
</div>

</body>
</html>
