<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $to = "dm@maksudulalam.com"; // Replace with your email
    $subject = "Contact Form Submission: " . $name;
    $body = "You have received a new message from your portfolio contact form.\n\n".
            "Name: $name\n".
            "Email: $email\n\n".
            "Message:\n$message";

    // Additional headers to prevent email from going to spam
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type:text/plain;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@maksudulalam.com" . "\r\n"; // Your domain email here
    $headers .= "Reply-To: $email" . "\r\n";

    if (mail($to, $subject, $body, $headers)) {
        // Redirect to thank you page
        header("Location: thank-you.php");
        exit();
    } else {
        echo "Failed to send message.";
    }
}
?>
