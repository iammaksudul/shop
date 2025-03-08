<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php'); ?>
</head>
<body>

<!-- Navigation Menu -->
<nav>
    <a href="#profile">Home</a>
    <a href="#licenses">Licenses</a>
    <a href="#repos">GitHub Repos</a>
    <a href="#experience">Experience</a>
    <a href="#skills">Skills</a>
    <a href="#contact">Contact</a>
</nav>

<!-- Main Content -->
<div class="container" id="profile">
    <h1>👨‍💻 Kh Maksudul Alam</h1>
    <div class="profile">
        <img src="https://avatars.githubusercontent.com/iammaksudul" alt="Maksudul Alam Profile">
        <p>📍 Dhaka, Bangladesh</p>
        <p>BSc in Computer Science</p>
        <p>System Administrator | WordPress & WHMCS Expert | cPanel Certified Sysadmin | Cybersecurity & Networking Specialist | IT Solutions Provider | Tech Writer | DevOps Learner | AWS Learner | Bash Expert</p>
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

<h2 id="skills">🛠️ My Skills</h2>
<div class="skills-section">
    <ul class="skills-list">
        <li><strong>Linux Administration</strong> <div class="progress-bar"><span class="Linux"></span></div></li>
        <li><strong>WordPress</strong> <div class="progress-bar"><span class="WordPress"></span></div></li>
        <li><strong>Networking</strong> <div class="progress-bar"><span class="Networking"></span></div></li>
        <li><strong>WHMCS</strong> <div class="progress-bar"><span class="WHMCS"></span></div></li>
        <li><strong>DevOps</strong> <div class="progress-bar"><span class="DevOps"></span></div></li>
        <li><strong>AWS</strong> <div class="progress-bar"><span class="AWS"></span></div></li>
    </ul>
</div>

<h2>🔗 Connect with Me</h2>
<div class="social-links">
    <a href="https://www.linkedin.com/in/khmaksudulalam/" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
    <a href="https://maksudulalam.com" target="_blank"><i class="fas fa-globe"></i> My Website</a>
    <a href="https://facebook.com/kh.Maksudulalam" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
    <a href="https://instagram.com/kh.maksudulalam" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
    <a href="https://www.amazon.ca/-/fr/Kh-Maksudul-Alam-ebook/dp/B0DVHPVZ4J" target="_blank"><i class="fas fa-book"></i> Kindle Book</a>
</div>

<script>
    // Function to fetch GitHub repositories (replace 'your-username' with your actual GitHub username)
    function fetchGitHubRepos() {
        fetch('https://api.github.com/users/iammaksudul/repos')  // Replace 'your-username' with your GitHub username
            .then(response => response.json())
            .then(data => {
                console.log(data);  // Handle the fetched GitHub repositories
                displayRepos(data);  // Call function to display repos
            })
            .catch(error => {
                console.error('Error fetching GitHub repos:', error);
                document.getElementById("githubRepos").innerHTML = "<p>Failed to load projects. Please try again later.</p>";
            });
    }

    // Function to display repositories on your website
    function displayRepos(repos) {
        const repoContainer = document.getElementById("githubRepos");  // Make sure there's a div with id="githubRepos"
        repoContainer.innerHTML = "";  // Clear the "Loading projects..." message

        if (repos.length === 0) {
            repoContainer.innerHTML = "<p>No repositories found.</p>";
        } else {
            repos.forEach(repo => {
                const repoElement = document.createElement("div");
                repoElement.classList.add("repo");
                repoElement.innerHTML = `
                    <h3><a href="${repo.html_url}" target="_blank">${repo.name}</a></h3>
                    <p>${repo.description || "No description available."}</p>
                `;
                repoContainer.appendChild(repoElement);  // Append the repo element to the container
            });
        }
    }

    // Toggle Dark/Light Mode
    function toggleTheme() {
        document.body.classList.toggle("dark-mode");
        document.querySelector(".theme-toggle").innerHTML = document.body.classList.contains("dark-mode") ? "☀️" : "🌙";
        localStorage.setItem("theme", document.body.classList.contains("dark-mode") ? "dark" : "light");
    }

    // Apply saved theme from localStorage
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark-mode");
        document.querySelector(".theme-toggle").innerHTML = "☀️";
    }

    // Call fetchGitHubRepos() to load the repositories when the page loads
    document.addEventListener("DOMContentLoaded", function () {
        fetchGitHubRepos();
    });
</script>


</body>
</html>
