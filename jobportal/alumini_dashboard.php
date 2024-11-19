<?php
session_start();
// Assuming you have a database connection file
include 'db.php';

$alumni_id = $_SESSION['user_id'];

// Fetch posted jobs and internships
$posted_jobs = $conn->query("SELECT * FROM job_postings WHERE alumni_id = $alumni_id");
if (!$posted_jobs) {
    die("Error fetching posted jobs: " . $conn->error);
}

$posted_internships = $conn->query("SELECT * FROM internship_postings WHERE posted_by = (SELECT name FROM alumni_user WHERE id = $alumni_id)");
if (!$posted_internships) {
    die("Error fetching posted internships: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Dashboard</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        /* Sidebar Styling */
        .sidebar {
            width: 220px;
            padding: 20px;
            background-color: #004d99;
            border-radius: 8px;
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
        }
        .sidebar h3 { margin-bottom: 15px; font-size: 18px; color: #ffffff; }
        .sidebar a {
            display: block; padding: 10px 15px; margin: 8px 0;
            text-decoration: none; color: #ffffff; background-color: #005bb5;
            border-radius: 6px; transition: background-color 0.3s;
        }
        .sidebar a:hover { background-color: #0073e6; }

        /* Job Listings Area */
        .job-listings { flex: 1; display: flex; flex-wrap: wrap; justify-content: flex-start; }
        .job-card {
            background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); margin: 10px; padding: 10px;
            width: calc(33.33% - 20px); transition: transform 0.2s; text-align: center; font-size: 14px;
        }
        .job-card:hover { transform: scale(1.02); }
        .poster-image { width: 60px; height: 60px; border-radius: 4px; margin-bottom: 8px; }
        .job-details h3 { font-size: 16px; color: #004d99; margin-bottom: 8px; }
        .job-details p { margin: 4px 0; font-size: 13px; color: #333; }

        /* Button Styling */
        .button {
            background-color: #004d99; color: white; border: none; padding: 5px 10px;
            border-radius: 5px; text-decoration: none; display: inline-block; margin: 5px 2px; font-size: 13px;
            transition: background-color 0.3s;
        }
        .button:hover { background-color: #003366; }

        /* Main Container */
        .container { display: flex; }
        .main-content { flex: 1; }
        .main-section { display: none; margin-left: 20px; }
    </style>
    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.main-section');
            sections.forEach(section => section.style.display = 'none');
            document.getElementById(sectionId).style.display = 'block';
        }
        function deletePosting(type, id) {
            if (confirm("Are you sure you want to delete this posting?")) {
                window.location.href = `delete.php?type=${type}&id=${id}`;
            }
        }
    </script>
</head>
<body>

<header>
        <div class="header-container">
            <img src="https://www.pondiuni.edu.in/wp-content/uploads/2020/05/PU_Logo_Full.png" alt="College Logo">
        </div>
        <nav>
            <div class="college-title">
                <h2>Alumni Connect</h2>    
            </div>
            <a href="alumni_index.php">Home</a>
            <a href="./alumini_dashboard.php">Dashboard</a>
            <a href="job_posting.php">Post Jobs</a>
            <a href="internship_posting.php">Post Internship</a>
            <a href="posted_jobs.php">Posted Jobs</a> <!-- New "Posted Jobs" link -->
            <a href="alumni_profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
<div class="container">
    <div class="sidebar">
        <h3>Alumni Dashboard</h3>
        <a href="./posted_jobs.php" >Posted Jobs</a>
        <a href="./posted_internships.php" >Posted Internships</a>
        <a href="./job_application.php">Application for job</a>
        <a href="./internship_application.php">Application for internship</a>

    </div>
</div>
</body>
</html>
