<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
include('config.php');

// Check if already logged in
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);  // Trim username to remove extra spaces
    $password = trim($_POST['password']);  // Trim password to remove extra spaces

    // Fetch the user with the provided username
    $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $admin = $stmt->fetch();

    // Debugging output
    echo "Entered Username: " . htmlspecialchars($username) . "<br>";

    if ($admin) {
        // Check the length of entered password and stored password hash
        echo "Entered Password Length: " . strlen($password) . "<br>";
        echo "Stored Password Hash Length: " . strlen($admin['password']) . "<br>";

        // Debugging - Display entered password and stored hash
        echo "Entered Password: " . htmlspecialchars($password) . "<br>";
        echo "Stored Password Hash: " . $admin['password'] . "<br>";

        // If the user exists, verify the password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            header('Location: index.php');
            exit;
        } else {
            $error_message = "Invalid credentials - Password mismatch";  // Show this message if password doesn't match
        }
    } else {
        $error_message = "Invalid credentials - Username not found";  // Show this message if username doesn't exist
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
            width: 400px;
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

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .order-btn {
            background-color: #f39c12;
            color: white;
            padding: 12px 18px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            border-radius: 6px;
            width: 100%;
            transition: background-color 0.3s ease-in-out;
        }

        .order-btn:hover {
            background-color: #e67e22;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Login</h2>

    <?php if (isset($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="order-btn">Login</button>
    </form>
</div>

</body>
</html>
