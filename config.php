<?php
// Database Configuration
$host = 'localhost';         // Your MySQL Host (usually localhost)
$dbname = 'm1ksu4ul1l1m_webxs';   // Database name
$username = 'm1ksu4ul1l1m_webxs';          // Your MySQL username
$password = 'Y$m}*;O9RS8d';              // Your MySQL password

try {
    // Create a PDO connection to MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Your pre-hashed password
    $hashed_password = '$2y$10$UzBYU6yEAw7wRkQGG1f7nu9Q4FEIUy4jC9QJuvpnwAyHz8rF4K2aS'; // The hash you provided

    // Example query to insert into the admins table
    $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
    $stmt->execute([
        'username' => 'dm@maksudulalam.com',  // Example username
        'password' => $hashed_password        // The hashed password directly
    ]);

    echo "Admin added successfully with hashed password!";
} catch(PDOException $e) {
    // Handle error and display message if connection fails
    echo "Connection failed: " . $e->getMessage();
}
?>
