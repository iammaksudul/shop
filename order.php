<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
include('config.php');

// Retrieve package details from GET parameters
$package_id = $_GET['package_id'];

// Fetch the selected package details
$sql = "SELECT * FROM packages WHERE id = :package_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['package_id' => $package_id]);
$package = $stmt->fetch();

// Check if the package exists
if (!$package) {
    die("Package not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate Terms & Conditions
    if (!isset($_POST['terms'])) {
        $error_message = "You must agree to the terms and conditions to place an order.";
    } else {
        // Store form data in session for later use
        $_SESSION['domain'] = $_POST['domain'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['whatsapp'] = $_POST['whatsapp']; // Store WhatsApp number
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['package_id'] = $package_id; // Ensure package_id is saved in session

        // Insert user into the `users` table if not already present
        $email = $_POST['email'];
        $stmt_check_user = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt_check_user->execute(['email' => $email]);
        $user = $stmt_check_user->fetch();

        if (!$user) {
            // Insert into users table if not found
            $stmt_insert_user = $pdo->prepare("INSERT INTO users (full_name, email, password, role) 
                VALUES (:full_name, :email, :password, 'client')");
            $stmt_insert_user->execute([
                'full_name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => password_hash("default_password", PASSWORD_DEFAULT) // Default password or you can generate one
            ]);
            // Get the user ID of the newly created user
            $user_id = $pdo->lastInsertId();
        } else {
            // If user exists, use the existing user_id
            $user_id = $user['id'];
        }

        // Check if the customer already exists before inserting
        $stmt_check_customer = $pdo->prepare("SELECT id FROM customers WHERE email = :email");
        $stmt_check_customer->execute(['email' => $_POST['email']]);
        $customer = $stmt_check_customer->fetch();

        if (!$customer) {
            // Insert customer data into `customers` table if not already present
            $stmt_insert_customer = $pdo->prepare("INSERT INTO customers (full_name, email, phone, whatsapp, address) 
                VALUES (:full_name, :email, :phone, :whatsapp, :address)");
            $stmt_insert_customer->execute([
                'full_name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'whatsapp' => $_POST['whatsapp'],
                'address' => $_POST['address']
            ]);
            // Get the newly inserted customer ID from `customers` table
            $customer_id = $pdo->lastInsertId();
        } else {
            // If customer exists, use the existing customer ID
            $customer_id = $customer['id'];
        }

        // Insert the order data into `orders` table using the customer_id
        $stmt_insert_order = $pdo->prepare("INSERT INTO orders (customer_id, domain_name, package_id, total_amount) 
            VALUES (:customer_id, :domain_name, :package_id, :total_amount)");
        $stmt_insert_order->execute([
            'customer_id' => $customer_id, // Use the existing or newly created customer_id
            'domain_name' => $_POST['domain'],
            'package_id' => $package_id,
            'total_amount' => $package['price']
        ]);

        // Redirect to invoice page
        header("Location: invoice.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Your Package</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #333; /* Black background */
            color: #fff; /* White text */
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #222; /* Darker background for navigation */
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

        /* Order Form Container */
        .container {
            width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #444; /* Dark background for the form */
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #f39c12; /* Highlighting the heading in orange */
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #f39c12; /* Orange label text */
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .order-btn {
            background-color: #f39c12; /* Orange button color */
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
            background-color: #e67e22; /* Slightly darker orange on hover */
        }

        /* Icon Styling */
        .icon-input {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .icon-input input {
            width: 90%;
        }

        .icon-input i {
            color: #f39c12;
            margin-right: 10px;
        }

        /* Terms & Conditions Styling */
        .terms {
            margin-top: 20px;
            color: #bbb;
            font-size: 14px;
        }

        .terms a {
            color: #f39c12;
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
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

    <!-- Order Form -->
    <div class="container">
        <h2>Order Your Package: <?php echo htmlspecialchars($package['name']); ?></h2>
        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="order.php?package_id=<?php echo $package['id']; ?>" method="POST">
            <label for="name">Full Name:</label>
            <div class="icon-input">
                <i class="fas fa-user"></i>
                <input type="text" id="name" name="name" required>
            </div>

            <label for="email">Email Address:</label>
            <div class="icon-input">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" required>
            </div>

            <label for="phone">Phone Number:</label>
            <div class="icon-input">
                <i class="fas fa-phone"></i>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <label for="whatsapp">WhatsApp Number:</label>
            <div class="icon-input">
                <i class="fab fa-whatsapp"></i>
                <input type="tel" id="whatsapp" name="whatsapp" required>
            </div>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>

            <label for="domain">Preferred Domain Name:</label>
            <input type="text" id="domain" name="domain" required>

            <!-- Terms and Conditions Checkbox -->
            <label>
                <input type="checkbox" name="terms" required>
                I agree to the <a href="terms-conditions.php" target="_blank">Terms and Conditions</a>
            </label>

            <button type="submit" class="order-btn"><i class="fas fa-check-circle"></i> Place Order</button>
        </form>
    </div>

</body>
</html>
