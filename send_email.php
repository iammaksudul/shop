<?php
// Function to send email with user login details
function sendEmail($email, $password) {
    $subject = 'Your Account Details';
    $message = "Hello,

Thank you for your order. Your account has been created. Here are your login details:

Email: $email
Password: $password

You can log in to your account to manage your orders.

Best regards,
Your Company Name";

    // PHP's mail function (replace with your mail server settings or use a service like PHPMailer for better functionality)
    $headers = 'From: no-reply@yourdomain.com' . "\r\n" .
               'Reply-To: support@yourdomain.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Use PHP's mail function to send the email
    mail($email, $subject, $message, $headers);
}
?>
