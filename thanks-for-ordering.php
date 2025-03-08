<?php
session_start();
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #333; /* Black background to match other pages */
            color: #fff; /* White text for consistency */
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #222; /* Dark background for navigation */
            padding: 20px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav a {
            color: #fff;
            margin: 0 20px;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
        }

        nav a:hover {
            color: #f39c12; /* Orange color on hover */
        }

        /* Thank You Page Container */
        .container {
            width: 80%;
            margin: 50px auto;
            padding: 30px;
            background-color: #444; /* Dark background for the content */
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: #f39c12; /* Orange heading for visibility */
            font-size: 36px;
        }

        p {
            font-size: 18px;
            color: #bbb; /* Light text for paragraphs */
            line-height: 1.6;
        }

        .contact-link {
            color: #f39c12;
            text-decoration: underline;
        }

        .contact-link:hover {
            color: #e67e22; /* Slightly darker orange on hover */
        }
    </style>
</head>
<body>

    <!-- Navigation Menu -->
    <nav>
        <a href="https://www.maksudulalam.com/#profile">Home</a>
        <a href="https://www.maksudulalam.com/#licenses">Licenses</a>
        <a href="https://www.maksudulalam.com/#repos">GitHub Repos</a>
        <a href="https://www.maksudulalam.com/#experience">Experience</a>
        <a href="https://www.maksudulalam.com/#skills">Skills</a>
        <a href="https://www.maksudulalam.com/#contact">Contact</a>
    </nav>

    <div class="container">
        <h1>Thank You for Your Order!</h1>
        <p>Your order has been successfully placed. You will receive an email confirmation soon.</p>
        <p>If you have any questions, feel free to <a href="https://www.maksudulalam.com/#contact" class="contact-link">contact us</a>.</p>
    </div>

</body>
</html>
