<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'alumni') {
    header("Location: login.php");
    exit();
}

// Fetch job postings created by alumni here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Alumni Dashboard</title>
</head>
<body>
<header>
        <h1>Alumni Dashboard</h1>
        <nav>
            <a href="job_posting.php">Post Jobs</a>
            <a href="internship_posting.php">Post Internship</a>
            <a href="connection_requests.php">Connection Requests</a>
            <a href="alumni_profile.php">Profile</a>
            <a href="Dashboard.php">Logout</a>

        </nav>
    </header>
    <main>
        <h2>Your Job Postings</h2>
        <section id="job-postings">
            <h3>Post a Job</h3>
            <form action="post_job.php" method="post">
                <label for="job_title">Job Title:</label>
                <input type="text" id="job_title" name="job_title" required>
                <label for="job_description">Job Description:</label>
                <textarea id="job_description" name="job_description" required></textarea>
                <button type="submit">Post Job</button>
            </form>
            <h3>Your Posted Jobs</h3>
            <ul>
                <!-- Example of posted jobs -->
                <li>
                    <h4>Web Developer</h4>
                    <p>Description: Looking for a web developer with React.js experience.</p>
                    <button>View Applications</button>
                </li>
                <!-- More jobs can be dynamically loaded here -->
            </ul>
        </section>
    </main>
</body>
</html>
