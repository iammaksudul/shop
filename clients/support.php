<?php
session_start();
include('header.php');

// Check if client is logged in
if (!isset($_SESSION['client_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Submit support request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert the support request into the database (adjust to your needs)
    // Assuming there's a "support_requests" table
    include('config.php');
    $stmt = $pdo->prepare('INSERT INTO support_requests (client_id, subject, message) VALUES (:client_id, :subject, :message)');
    $stmt->execute([
        'client_id' => $_SESSION['client_id'],
        'subject' => $subject,
        'message' => $message
    ]);

    $_SESSION['success_message'] = "Your support request has been submitted.";
    header('Location: support.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support</title>
</head>
<body>

<div class="container">
    <h2>Contact Support</h2>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="success"><?php echo $_SESSION['success_message']; ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <form action="support.php" method="POST">
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit" class="order-btn">Submit Request</button>
    </form>
</div>

</body>
</html>
