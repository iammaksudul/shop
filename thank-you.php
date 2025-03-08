<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You | Portfolio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0d1117;
            color: #c9d1d9;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .thank-you-container {
            background-color: #21262d;
            margin: 100px auto;
            padding: 40px;
            border-radius: 12px;
            max-width: 600px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1.5s ease-out;
        }

        h1 {
            color: #58a6ff;
            font-size: 36px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #8b949e;
        }

        .back-btn {
            background-color: #58a6ff;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 20px;
            display: inline-block;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color: #1f6feb;
        }

        /* Animation for the thank you container */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="thank-you-container">
        <h1>Thank You!</h1>
        <p>Your message has been sent successfully. I'll get back to you as soon as possible.</p>
        <a href="index.php" class="back-btn">Go Back to Portfolio</a>
    </div>

</body>
</html>
