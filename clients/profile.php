<?php
session_start();
include('header.php');
include('config.php');

// Check if client is logged in
if (!isset($_SESSION['client_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Fetch client's profile details
$stmt = $pdo->prepare('SELECT * FROM clients WHERE id = :client_id');
$stmt->execute(['client_id' => $_SESSION['client_id']]);
$client = $stmt->fetch();

// Update profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $pdo->prepare('UPDATE clients SET name = :name, email = :email, phone = :phone WHERE id = :client_id');
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'client_id' => $_SESSION['client_id']
    ]);

    $_SESSION['success_message'] = "Profile updated successfully!";
    header('Location: profile.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>

<div class="container">
    <h2>Edit Profile</h2>
    <form action="profile.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $client['name']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $client['email']; ?>" required>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo $client['phone']; ?>" required>

        <button type="submit" class="order-btn">Update Profile</button>
    </form>
</div>

</body>
</html>
