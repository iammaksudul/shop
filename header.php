    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kh Maksudul Alam | Portfolio</title>
    <meta name="description" content="Portfolio of Kh Maksudul Alam - System Administrator, WordPress & WHMCS Expert, cPanel Certified Sysadmin, and IT Solutions Provider.">
    <meta name="keywords" content="Maksudul Alam, system administrator, WHMCS expert, cPanel, WordPress, cybersecurity, networking, IT solutions, DevOps, AWS, Bash">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #0d1117;
            color: #c9d1d9;
            transition: background-color 0.3s, color 0.3s;
            scroll-behavior: smooth;
        }

        /* Navigation Menu */
        nav {
            background-color: #161b22;
            padding: 12px 0;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
            animation: fadeInNav 1s ease-out;
        }

        nav a {
            color: #c9d1d9;
            text-decoration: none;
            padding: 12px 25px;
            margin: 0 15px;
            font-size: 18px;
            font-weight: 600;
            position: relative;
            display: inline-block;
            transition: color 0.3s, transform 0.3s;
        }

        nav a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 2px;
            background-color: #58a6ff;
            transition: width 0.3s ease-in-out;
        }

        nav a:hover {
            color: #58a6ff;
            transform: translateY(-3px);
        }

        nav a:hover::after {
            width: 100%;
        }

        /* Page container */
        .container {
            max-width: 1100px;
            margin: 80px auto;
            background: #21262d;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: 0.5s;
            animation: fadeIn 1s ease-out;
        }

        /* Typography */
        h1, h2 {
            color: #ffffff;
            font-size: 36px;
            margin-bottom: 20px;
            animation: fadeIn 1.5s ease-out;
        }

        h3 {
            font-size: 24px;
            color: #58a6ff;
        }

        /* Profile Image */
        .profile img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #58a6ff;
            transition: transform 0.3s ease-in-out;
        }

        .profile img:hover {
            transform: scale(1.1);
        }

        /* Profile Text */
        .profile p {
            font-size: 18px;
            color: #8b949e;
            margin-top: 15px;
        }

        /* Buttons */
        .btn, .resume-btn {
            display: inline-block;
            background: #58a6ff;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 8px;
            margin: 10px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn:hover, .resume-btn:hover {
            background-color: #1f6feb;
            transform: scale(1.05);
        }

        /* Repo Cards */
        .repo-card {
            background: #21262d;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: left;
            transition: 0.3s;
            animation: fadeIn 2s ease-out;
        }

        .repo-card:hover {
            background: #30363d;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .repo-card h3 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            color: #58a6ff;
        }

        .repo-card p {
            font-size: 14px;
            color: #8b949e;
        }

        .repo-card a {
            text-decoration: none;
            color: #58a6ff;
            font-weight: bold;
        }

        .repo-card a:hover {
            text-decoration: underline;
        }

        /* Skills Section */
        .skills-section {
            background-color: #21262d;
            padding: 40px;
            border-radius: 12px;
            margin-top: 40px;
            animation: fadeIn 2.5s ease-out;
        }

        .skills-section h3 {
            color: #58a6ff;
        }

        .skills-list {
            list-style-type: none;
            padding: 0;
        }

        .skills-list li {
            margin: 10px 0;
        }

        .progress-bar {
            background-color: #444;
            border-radius: 5px;
            height: 12px;
            margin: 5px 0;
        }

        .progress-bar span {
            display: block;
            height: 100%;
            border-radius: 5px;
        }

        .progress-bar span.Linux { background-color: #58a6ff; width: 85%; }
        .progress-bar span.WordPress { background-color: #58a6ff; width: 90%; }
        .progress-bar span.Networking { background-color: #58a6ff; width: 75%; }
        .progress-bar span.WHMCS { background-color: #58a6ff; width: 80%; }
        .progress-bar span.DevOps { background-color: #58a6ff; width: 70%; }
        .progress-bar span.AWS { background-color: #58a6ff; width: 65%; }

        /* Scroll to Top Button */
        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #58a6ff;
            color: white;
            padding: 10px 15px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            display: none;
            animation: fadeIn 2s ease-out;
        }

        /* Contact Form */
        form input, form textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background-color: #21262d;
            border: 1px solid #444;
            border-radius: 8px;
            color: #c9d1d9;
        }

        form button {
            background-color: #58a6ff;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #1f6feb;
        }

        /* Dark Mode */
        .dark-mode {
            background: #1f1f1f;
            color: #ffffff;
        }

        .dark-mode .container {
            background: #2d333b;
        }

        .dark-mode .repo-card {
            background: #2d333b;
        }

        /* Theme Toggle */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            cursor: pointer;
            background: #58a6ff;
            color: white;
            padding: 12px;
            border-radius: 50%;
            font-size: 18px;
            transition: 0.3s;
        }

        /* Social Links */
        .social-links a {
            margin: 10px;
            font-size: 20px;
            color: #58a6ff;
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: #1f6feb;
        }

        /* Resume Button */
        .resume-btn {
            display: block;
            background: #28a745;
            padding: 14px 20px;
            text-decoration: none;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            margin: 15px auto;
            width: 230px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .resume-btn:hover {
            background-color: #218838;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .repo-card {
                width: 100%;
                margin: 10px 0;
            }

            .social-links {
                display: flex;
                justify-content: center;
            }

            .social-links a {
                margin: 10px;
            }

            nav {
                padding: 10px 0;
            }

            nav a {
                font-size: 16px;
            }

            .profile img {
                width: 100px;
                height: 100px;
            }

            .resume-btn {
                width: 200px;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInNav {
            0% { opacity: 0; transform: translateY(-100px); }
            100% { opacity: 1; transform: translateY(0); }
        }

    </style>