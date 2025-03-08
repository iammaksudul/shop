<?php
session_start();
include('config.php');
include('send_email.php');  // Include the email sending function

// Function to generate a random password
function generateRandomPassword($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

// Retrieve order details from session
$order_id = $_SESSION['order_id'];  // Assuming order ID is stored in session
$order_details = $_SESSION['order_details'];  // Assuming order details are stored in session

// Get customer details
$name = $_SESSION['name'];
$email = $_SESSION['email'];

// Generate random password for user
$password = generateRandomPassword();

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the new user into the database
$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'name' => $name,
    'email' => $email,
    'password' => $hashed_password
]);

// Send an email to the user with their login details
sendEmail($email, $password);

// Redirect to the invoice or order confirmation page
header('Location: invoice.php');
exit();
?>
