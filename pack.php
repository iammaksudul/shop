<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

include('config.php');

// Fetch packages from the database
$sql = "SELECT * FROM packages";
$stmt = $pdo->query($sql);
$packages = $stmt->fetchAll();

// Set caching headers to prevent multiple database calls
header('Cache-Control: max-age=3600'); // Cache for 1 hour
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your Package</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333; /* Black background */
            color: #fff; /* White text */
            margin: 0;
            padding: 0;
        }

        /* Sticky Navigation Menu */
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
            color: #f39c12;
        }

        .container {
            display: flex;
            justify-content: space-between;
            gap: 50px;
            flex-wrap: wrap;
            margin: 50px auto;
            max-width: 1200px;
            padding: 0 15px;
        }

        .package {
            background-color: #444; /* Dark background for package cards */
            padding: 30px;
            width: 300px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
            margin-bottom: 30px;
            flex-grow: 1;
        }

        .package:hover {
            transform: scale(1.05);
        }

        .package h2 {
            color: #f39c12; /* Bright color for the package name */
            font-size: 2em;
            margin-bottom: 15px;
        }

        .price {
            font-size: 26px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .features {
            list-style-type: none;
            padding-left: 0;
            text-align: left;
            margin-bottom: 20px;
        }

        .features li {
            font-size: 14px;
            color: #bbb; /* Lighter text color for features */
            margin-bottom: 8px;
        }

        .features li i {
            color: #28a745; /* Green checkmarks */
            margin-right: 8px;
        }

        .order-btn {
            background-color: #f39c12; /* Orange button color */
            color: white;
            padding: 12px 18px;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            border-radius: 6px;
            width: 100%;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out;
        }

        .order-btn:hover {
            background-color: #e67e22; /* Slightly darker orange on hover */
        }

        /* Why Choose Us Section */
        .section {
            background-color: #444; /* Dark background for sections */
            padding: 40px;
            margin: 50px auto;
            width: 80%;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .section h2 {
            color: #f39c12; /* Highlighting section titles in orange */
            font-size: 26px;
            margin-bottom: 15px;
        }

        .section p {
            font-size: 16px;
            color:#bbb; /* Lighter text color for features */
            line-height: 1.6;
        }

        .section ul {
            list-style: none;
            padding: 0;
        }

        .section ul li {
            margin-bottom: 10px;
            font-size: 16px;
            color:#bbb; /* Lighter text color for features */
        }

        .section ul li i {
            color: #f39c12;
            margin-right: 8px;
        }

        /* Testimonial Section */
        .testimonial-slider {
            width: 100%;
            margin-top: 30px;
            padding: 20px;
            text-align: center;
        }

        .testimonial-card {
            display: none;
            margin: 10px;
            padding: 20px;
            background-color: #444; /* Dark background for package cards */
            color: #bbb; /* Lighter text color for features */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .testimonial-card.active {
            display: block;
        }

        .testimonial-author {
            font-weight: bold;
            font-size: 16px;
            color: #fff; /* White text for author name */
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

    <!-- Package Selection -->
    <div class="container">
        <?php foreach ($packages as $package): ?>
            <div class="package">
                <h2><?php echo htmlspecialchars($package['name']); ?></h2>
                <p class="price">$<?php echo number_format($package['price'], 2); ?></p>
                <p><?php echo htmlspecialchars($package['description']); ?></p>
                <ul class="features">
                    <?php foreach (explode(',', $package['features']) as $feature): ?>
                        <li><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars(trim($feature)); ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="order.php?package_id=<?php echo $package['id']; ?>" class="order-btn"><i class="fas fa-shopping-cart"></i> Order Now</a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Why Choose Us Section -->
    <div class="section">
        <h2><i class="fas fa-star"></i> Why Choose Us?</h2>
        <p>Our web development team provides innovative, high-quality web solutions that are both responsive and secure. With years of experience and expertise in building cutting-edge websites, we guarantee satisfaction. Here’s why:</p>
        <ul>
            <li><i class="fas fa-check-circle"></i> Proven track record with over 200 successful projects.</li>
            <li><i class="fas fa-check-circle"></i> Dedicated support and maintenance after project completion.</li>
            <li><i class="fas fa-check-circle"></i> Fast turnaround time with no compromise on quality.</li>
        </ul>
    </div>

    <!-- What You Get Section -->
    <div class="section">
        <h2><i class="fas fa-cogs"></i> What You Will Get</h2>
        <p>When you select our package, you're not just getting a website. You're getting a comprehensive solution:</p>
        <ul>
            <li><i class="fas fa-check-circle"></i> Professional and modern design tailored to your brand.</li>
            <li><i class="fas fa-check-circle"></i> SEO optimized to enhance visibility.</li>
            <li><i class="fas fa-check-circle"></i> Full mobile responsiveness to ensure your website looks great on all devices.</li>
            <li><i class="fas fa-check-circle"></i> Secure SSL certification to protect user data.</li>
        </ul>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonial-slider">
        <div class="testimonial-card active">
            <p>"Excellent service, our website looks fantastic!"</p>
            <div class="testimonial-author">- John Doe</div>
        </div>
        <div class="testimonial-card">
            <p>"Highly professional team, delivered on time and exceeded expectations."</p>
            <div class="testimonial-author">- Sarah Wilson</div>
        </div>
        <div class="testimonial-card">
            <p>"My business is thriving thanks to the web solution they provided!"</p>
            <div class="testimonial-author">- Mark Smith</div>
        </div>
        <div class="testimonial-card">
            <p>"Affordable and top-quality service. Highly recommended!"</p>
            <div class="testimonial-author">- Emily Davis</div>
        </div>
        <div class="testimonial-card">
            <p>"The best web development experience I've had. Will be coming back for future projects!"</p>
            <div class="testimonial-author">- Michael Johnson</div>
        </div>
        <div class="testimonial-card">
            <p>"They brought our vision to life. Couldn't be happier with the results!"</p>
            <div class="testimonial-author">- Laura Brown</div>
        </div>
        <div class="testimonial-card">
            <p>"Top-notch customer service and excellent design!"</p>
            <div class="testimonial-author">- Chris Adams</div>
        </div>
    </div>

    <script>
        let slideIndex = 0;
        function showSlides() {
            let slides = document.querySelectorAll('.testimonial-card');
            slides.forEach((slide) => slide.classList.remove('active'));
            slides[slideIndex].classList.add('active');
            slideIndex = (slideIndex + 1) % slides.length;
            setTimeout(showSlides, 5000);
        }
        showSlides();
    </script>

</body>
</html>
