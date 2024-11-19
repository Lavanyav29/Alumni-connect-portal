<?php
session_start();
require 'db.php';

// Fetch job postings from the database
$stmt = $conn->prepare("SELECT * FROM job_postings ORDER BY id DESC");
$stmt->execute();
$jobs = $stmt->get_result();

// Define the categories
$categories = [
    "Developing",
    "Testing",
    "Digital Marketing",
    "Editor",
    "Customer Support",
    "Project Management",
    "Design",
    "Data Science"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Listings</title>
    <link rel="stylesheet" href="./style.css">
    <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container {
    display: flex;
    padding: 20px;
    background-color: #f4f4f4; /* Light background */
}

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

.sidebar h3 {
    margin-bottom: 15px;
    font-size: 18px;
    color: #ffffff;
}

.sidebar a {
    display: block;
    padding: 10px 15px;
    margin: 8px 0;
    text-decoration: none;
    color: #ffffff;
    background-color: #005bb5;
    border-radius: 6px;
    transition: background-color 0.3s;
}

.sidebar a:hover {
    background-color: #0073e6;
}

/* Job Listings Area */
.job-listings {
    flex: 1;
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
}

/* Compact Job Card */
.job-card {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin: 10px;
    padding: 10px;
    width: calc(33.33% - 20px); /* Adjust to fit 3 cards in a row */
    transition: transform 0.2s;
    text-align: center;
    font-size: 14px;
}

.job-card:hover {
    transform: scale(1.02);
}

.poster-image {
    width: 60px; /* Smaller image width */
    height: 60px; /* Fixed height */
    border-radius: 4px;
    margin-bottom: 8px;
}

.job-details h3 {
    font-size: 16px;
    color: #004d99;
    margin-bottom: 8px;
}

.job-details p {
    margin: 4px 0;
    font-size: 13px;
    color: #333;
}

/* Button Styling */
.button {
    background-color: #004d99;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    margin: 5px 2px;
    font-size: 13px;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #003366;
}

    </style>
</head>
<body>
<header>
    <div class="header-container">
        <img src="https://www.pondiuni.edu.in/wp-content/uploads/2020/05/PU_Logo_Full.png" alt="College Logo">
    </div>
    <nav>
        <div class="college-title">
        <h2>PUDoCS Connect </h2>    
        </div>
      <a href="./student_index.php">Home</a>
        <a href="job_show.php">Jobs</a>
        <a href="internship_show.php">Internships</a>
        <a href="student_profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="container">
    <div class="sidebar">
        <h3>Categories</h3>
        <?php foreach ($categories as $category): ?>
            <a href="job_show.php?category=<?php echo urlencode($category); ?>">
                <?php echo htmlspecialchars($category); ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="job-listings">
        <h2>Job Listings</h2>
        <?php
        // If a category is selected, filter the jobs
        $selected_category = isset($_GET['category']) ? $_GET['category'] : '';
        if ($selected_category) {
            $stmt = $conn->prepare("SELECT * FROM job_postings WHERE category = ? ORDER BY id DESC");
            $stmt->bind_param("s", $selected_category);
        } else {
            $stmt = $conn->prepare("SELECT * FROM job_postings ORDER BY id DESC");
        }
        $stmt->execute();
        $jobs = $stmt->get_result();

        while ($job = $jobs->fetch_assoc()): ?>
            <div class="job-card">
                <img src="job_logo_upload/<?php echo htmlspecialchars($job['poster_image']); ?>" class="poster-image" alt="Job Poster">
                <div class="job-details">
                    <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                    <p><strong>Company:</strong> <?php echo htmlspecialchars($job['company_name']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($job['description']); ?></p>
                    <p><strong>Salary:</strong> <?php echo htmlspecialchars($job['salary']); ?></p>
                    <a href="student_apply_job.php?job_id=<?php echo $job['id']; ?>" class="button">Apply</a>
                    <a href="connect_alumni.php?posted_by=<?php echo urlencode($job['posted_by']); ?>" class="button">Connect Alumni</a>
                    </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
