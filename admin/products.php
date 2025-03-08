<?php
session_start();
include('header.php');
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Fetch products from the database
$stmt = $pdo->query('SELECT * FROM products');
$products = $stmt->fetchAll();

// Handle delete product
if (isset($_GET['delete_id'])) {
    $product_id = $_GET['delete_id'];
    $stmt_delete = $pdo->prepare('DELETE FROM products WHERE id = :id');
    $stmt_delete->execute(['id' => $product_id]);
    header('Location: packages.php'); // Redirect after deletion
    exit;
}

// Handle add product form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt_add = $pdo->prepare("INSERT INTO products (name, description, price) VALUES (:name, :description, :price)");
    $stmt_add->execute(['name' => $name, 'description' => $description, 'price' => $price]);
    header('Location: packages.php'); // Redirect to refresh the page
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="style.css"> <!-- Your custom styles -->
    <style>
        /* Styling */
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
            color: #f39c12;
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

        /* Form Styling */
        .form-container {
            background-color: #444;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 50%;
            margin: 30px auto;
        }

        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .form-container button {
            background-color: #f39c12;
            color: white;
            padding: 12px 18px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 6px;
            transition: background-color 0.3s ease-in-out;
        }

        .form-container button:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Products</h2>

    <!-- Add Product Form -->
    <div class="form-container">
        <h3>Add New Product</h3>
        <form method="POST">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <button type="submit">Add Product</button>
        </form>
    </div>

    <!-- Products Table -->
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td><?php echo htmlspecialchars($product['description']); ?></td>
                <td><?php echo $product['price']; ?></td>
                <td>
                    <a href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a> |
                    <a href="packages.php?delete_id=<?php echo $product['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>
