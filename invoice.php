<?php
ob_start(); // Start output buffering
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

include('config.php');

// Ensure package_id is set in the session
$package_id = $_SESSION['package_id'] ?? null;
$domain_name = $_SESSION['domain'] ?? null;

// Check if package_id exists in session before proceeding
if (!$package_id) {
    echo "Error: Package ID is missing.";
    exit;
}

// Fetch package details from the database
$sql = "SELECT * FROM packages WHERE id = :package_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['package_id' => $package_id]);
$package = $stmt->fetch();

// Check if the package exists
if (!$package) {
    echo "Error: Package not found.";
    exit;
}

// Set the correct price for the package
$price = $package['price'];

// Fetch the user details from session
$name = $_SESSION['name'] ?? null;
$email = $_SESSION['email'] ?? null;
$phone = $_SESSION['phone'] ?? null;
$whatsapp = $_SESSION['whatsapp'] ?? null;
$address = $_SESSION['address'] ?? null;

if (!$name || !$email || !$phone || !$whatsapp || !$address) {
    echo "Error: User details are missing.";
    exit;
}

// Check if the user already exists in the `users` table
$stmt_check_user = $pdo->prepare("SELECT id FROM users WHERE email = :email");
$stmt_check_user->execute(['email' => $email]);
$user = $stmt_check_user->fetch();

if (!$user) {
    // Insert into `users` table if not found
    $stmt_insert_user = $pdo->prepare("INSERT INTO users (full_name, email, password, role) 
        VALUES (:full_name, :email, :password, 'client')");
    $stmt_insert_user->execute([
        'full_name' => $name,
        'email' => $email,
        'password' => password_hash("default_password", PASSWORD_DEFAULT) // Default password or you can generate one
    ]);
    // Get the user ID of the newly created user
    $user_id = $pdo->lastInsertId();
} else {
    // If user exists, use the existing user_id
    $user_id = $user['id'];
}

// Check if the customer already exists in the `customers` table
$stmt_check_customer = $pdo->prepare("SELECT id FROM customers WHERE email = :email");
$stmt_check_customer->execute(['email' => $email]);
$customer = $stmt_check_customer->fetch();

if (!$customer) {
    // Insert customer data into `customers` table if not already present
    $stmt_insert_customer = $pdo->prepare("INSERT INTO customers (full_name, email, phone, whatsapp, address) 
        VALUES (:full_name, :email, :phone, :whatsapp, :address)");
    $stmt_insert_customer->execute([
        'full_name' => $name,
        'email' => $email,
        'phone' => $phone,
        'whatsapp' => $whatsapp,
        'address' => $address
    ]);
    // Get the newly inserted customer ID from `customers` table
    $customer_id = $pdo->lastInsertId();
} else {
    // If customer exists, use the existing customer ID
    $customer_id = $customer['id'];
}

// Insert the order data into `orders` table
$stmt_insert_order = $pdo->prepare("INSERT INTO orders (customer_id, domain_name, package_id, total_amount) 
    VALUES (:customer_id, :domain_name, :package_id, :total_amount)");
$stmt_insert_order->execute([
    'customer_id' => $customer_id, // Use the new or existing customer_id
    'domain_name' => $domain_name,
    'package_id' => $package_id,
    'total_amount' => $price
]);

ob_end_flush(); // Finish output buffering and send output

// Redirect to payment or confirmation page (for now, to the thank you page)
//header("Location: thanks-for-ordering.php");
//exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #222;
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
            color: #f39c12;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 30px;
            background-color: #444;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1, h3 {
            color: #f39c12;
            text-align: center;
        }

        p, ul {
            font-size: 18px;
            color: #bbb;
        }

        ul {
            padding-left: 20px;
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

        .download-print {
            text-align: center;
            margin-top: 20px;
        }

        .download-print a {
            background-color: #555;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease-in-out;
        }

        .download-print a:hover {
            background-color: #444;
        }

        /* Print specific styling */
        @media print {
            nav, .download-print {
                display: none;
            }
            body {
                background-color: white;
                color: black;
            }
            .container {
                width: 100%;
                margin: 0;
                padding: 10px;
            }
            .order-btn {
                display: none;
            }
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

    <!-- Invoice Content -->
    <div class="container">
        <h1>Invoice ID: <?php echo uniqid('INV-', true); ?></h1>

        <!-- Package Details -->
        <p><strong>Domain Name:</strong> <?php echo $_SESSION['domain']; ?>.com</p>
        <p><strong>Package:</strong> <?php echo $package['name']; ?></p>
        <p><strong>Price:</strong> $<?php echo number_format($price, 2); ?></p>

        <h3>Order Summary</h3>
        <ul>
            <li><strong>Package:</strong> <?php echo $package['name']; ?></li>
            <li><strong>Total Amount:</strong> $<?php echo number_format($price, 2); ?></li>
        </ul>

        <h3>Customer Details</h3>
        <ul>
            <li><strong>Name:</strong> <?php echo $_SESSION['name']; ?></li>
            <li><strong>Email:</strong> <?php echo $_SESSION['email']; ?></li>
            <li><strong>Phone:</strong> <?php echo $_SESSION['phone']; ?></li>
            <li><strong>Address:</strong> <?php echo $_SESSION['address']; ?></li>
            <li><strong>WhatsApp:</strong> <?php echo $_SESSION['whatsapp']; ?></li>
        </ul>

        <!-- Payment Button -->
        <form action="thanks-for-ordering.php" method="POST">
            <!-- PayPal API integration would be done here -->
            <button type="submit" class="order-btn"><i class="fab fa-paypal"></i> Pay Now</button>
        </form>

        <div class="download-print">
            <a href="javascript:window.print()">Print Invoice</a>
            <a href="download_invoice.php" class="download-btn">Download Invoice</a>
        </div>
    </div>

</body>
</html>
