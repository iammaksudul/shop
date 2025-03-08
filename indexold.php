<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kh Maksudul Alam | Portfolio</title>
    <meta name="description" content="Portfolio of Kh Maksudul Alam - System Administrator, WordPress & WHMCS Expert, cPanel Certified Sysadmin, and IT Solutions Provider.">
    <meta name="keywords" content="Maksudul Alam, system administrator, WHMCS expert, cPanel, WordPress, cybersecurity, networking, IT solutions">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <style>
       body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #0d1117; /* GitHub Dark Background */
            color: #c9d1d9; /* Light text color for dark mode */
            transition: background-color 0.3s, color 0.3s;
        }

        /* Navigation Menu */
        nav {
            background-color: #161b22; /* GitHub Dark Navbar */
            padding: 12px 0;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        nav a {
            color: #c9d1d9; /* Light text for nav links */
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
            background-color: #58a6ff; /* GitHub Blue Hover effect */
            transition: width 0.3s ease-in-out;
        }

        nav a:hover {
            color: #58a6ff; /* GitHub Blue Hover effect */
            transform: translateY(-3px);
        }

        nav a:hover::after {
            width: 100%;
        }

        /* Page container */
        .container {
            max-width: 1000px;
            margin: 80px auto;
            background: #21262d; /* Dark container background */
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: 0.5s;
        }

        /* Typography */
        h1, h2 {
            color: #ffffff; /* White headings */
            font-size: 36px;
            margin-bottom: 20px;
        }

        /* Profile Image */
        .profile img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #58a6ff; /* GitHub Blue Border */
            transition: transform 0.3s ease-in-out;
        }

        .profile img:hover {
            transform: scale(1.1);
        }

        /* Profile Text */
        .profile p {
            font-size: 18px;
            color: #8b949e; /* Light gray text */
            margin-top: 15px;
        }

        /* Buttons */
        .btn, .resume-btn {
            display: inline-block;
            background: #58a6ff; /* GitHub Blue */
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 8px;
            margin: 10px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn:hover, .resume-btn:hover {
            background-color: #1f6feb; /* Darker GitHub Blue */
            transform: scale(1.05);
        }

        /* Repo Cards */
        .repo-card {
            background: #21262d; /* Dark Background */
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: left;
            transition: 0.3s;
        }

        .repo-card:hover {
            background: #30363d; /* Slightly lighter background on hover */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .repo-card h3 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            color: #58a6ff; /* GitHub Blue */
        }

        .repo-card p {
            font-size: 14px;
            color: #8b949e; /* Light gray text */
        }

        .repo-card a {
            text-decoration: none;
            color: #58a6ff;
            font-weight: bold;
        }

        .repo-card a:hover {
            text-decoration: underline;
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
            color: #58a6ff; /* GitHub Blue */
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: #1f6feb; /* Darker blue on hover */
        }

        /* Resume Button */
        .resume-btn {
            display: block;
            background: #28a745; /* Green for Resume */
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
    </style>
</head>
<body>

<!-- Navigation Menu -->
<nav>
    <a href="#profile">Home</a>
    <a href="#licenses">Licenses</a>
    <a href="#repos">GitHub Repos</a>
    <a href="#experience">Experience</a>
    <a href="#contact">Contact</a>
</nav>

<!-- Main Content -->
<div class="container" id="profile">
    <h1>👨‍💻 Kh Maksudul Alam</h1>
    <div class="profile">
        <img src="https://avatars.githubusercontent.com/iammaksudul" alt="Maksudul Alam Profile">
        <p>📍 Dhaka, Bangladesh</p>
        <p>System Administrator | WordPress & WHMCS Expert | cPanel Certified Sysadmin | Cybersecurity & Networking Specialist | IT Solutions Provider | Tech Writer</p>
        <a href="https://github.com/iammaksudul" class="btn" target="_blank"><i class="fab fa-github"></i> View My GitHub</a>
        <a href="mailto:dm@maksudulalam.com" class="btn"><i class="fas fa-envelope"></i> Contact Me</a>
        <a href="download/Maksudul_Alam_Resume.pdf" class="resume-btn" target="_blank"><i class="fas fa-file"></i> Download My Resume</a>
    </div>

    <h2 id="licenses">📜 Licenses & Certifications</h2>
    <div class="repo-card"><i class="fas fa-certificate"></i> WHM Administration Certification (CWA) - <strong>Issued Apr 2024 · Expires Apr 2025</strong></div>
    <div class="repo-card"><i class="fas fa-shield-alt"></i> cPanel & WHM System Administrator I Certification (CWSA-1) - <strong>Issued Apr 2022 · Expired Apr 2023</strong></div>
    <div class="repo-card"><i class="fas fa-server"></i> cPanel WHM Administrator Certification - <strong>Issued Apr 2022 · Expired Apr 2023</strong></div>
    <div class="repo-card"><i class="fas fa-cloud"></i> LiteSpeed Certification (CPLSC) - <strong>Issued Dec 2020 · Expired Dec 2021</strong></div>
    <div class="repo-card"><i class="fas fa-laptop-code"></i> cPanel Professional Certification (CPP) - <strong>Issued Oct 2020</strong></div>

 <h2 id="experience">💼 Experience</h2>
    <div class="repo-card"><i class="fas fa-building"></i> <strong>Server Administrator - Let's Encode (Full-time)</strong><br>Jan 2018 - Present (7 yrs 1 mo)</div>
    <div class="repo-card"><i class="fas fa-laptop"></i> <strong>Server Administrator - Webhostware (Part-time)</strong><br>Jan 2023 - Jan 2024 (1 yr 1 mo)</div>

    <h2 id="repos">📂 My GitHub Repositories</h2>
    <div class="github-repos" id="githubRepos">
        <p>Loading projects...</p>
    </div>

    <h2>🔗 Connect with Me</h2>
    <div class="social-links">
        <a href="https://www.linkedin.com/in/khmaksudulalam/" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
        <a href="https://maksudulalam.com" target="_blank"><i class="fas fa-globe"></i> My Website</a>
        <a href="https://facebook.com/kh.Maksudulalam" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
        <a href="https://instagram.com/kh.maksudulalam" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
    </div>
</div>

<!-- Dark Mode Toggle -->
<div class="theme-toggle" onclick="toggleTheme()">🌙</div>

<script>
    async function fetchGitHubRepos() {
        const username = "iammaksudul";
        const repoContainer = document.getElementById("githubRepos");

        try {
            const response = await fetch(`https://api.github.com/users/${username}/repos`);
            const repos = await response.json();

            repoContainer.innerHTML = "";
            repos.forEach(repo => {
                repoContainer.innerHTML += `
                    <div class="repo-card">
                        <h3><a href="${repo.html_url}" target="_blank">${repo.name}</a></h3>
                        <p>${repo.description ? repo.description : "No description provided."}</p>
                    </div>`;
            });
        } catch (error) {
            repoContainer.innerHTML = "<p>Failed to load repositories.</p>";
        }
    }
    fetchGitHubRepos();

    function toggleTheme() {
        document.body.classList.toggle("dark-mode");
        document.querySelector(".theme-toggle").innerHTML = document.body.classList.contains("dark-mode") ? "☀️" : "🌙";
        localStorage.setItem("theme", document.body.classList.contains("dark-mode") ? "dark" : "light");
    }
</script>

</body>
</html>
