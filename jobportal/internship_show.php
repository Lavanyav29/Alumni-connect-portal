<?php
session_start();
require 'db.php';

// Fetch internship postings from the database
$stmt = $conn->prepare("SELECT * FROM internship_postings ORDER BY id DESC");
$stmt->execute();
$internships = $stmt->get_result();

// Define the categories (you can adjust or add more categories as needed)
$categories = [
    "Software Development",
    "Web Development",
    "Data Science",
    "Cybersecurity",
    "Mobile App Development",
    "DevOps",
    "Machine Learning",
    "Game Development"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Internship Listings</title>
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

        /* Internship Listings Area */
        .internship-listings {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        /* Compact Internship Card */
        .internship-card {
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

        .internship-card:hover {
            transform: scale(1.02);
        }

        .poster-image {
            width: 60px; /* Smaller image width */
            height: 60px; /* Fixed height */
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .internship-details h3 {
            font-size: 16px;
            color: #004d99;
            margin-bottom: 8px;
        }

        .internship-details p {
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
            <a href="internship_show.php?category=<?php echo urlencode($category); ?>">
                <?php echo htmlspecialchars($category); ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="internship-listings">
        <h2>Internship Listings</h2>
        <?php
        // If a category is selected, filter the internships
        $selected_category = isset($_GET['category']) ? $_GET['category'] : '';
        if ($selected_category) {
            $stmt = $conn->prepare("SELECT * FROM internship_postings WHERE internship_category = ? ORDER BY id DESC");
            $stmt->bind_param("s", $selected_category);
        } else {
            $stmt = $conn->prepare("SELECT * FROM internship_postings ORDER BY id DESC");
        }
        $stmt->execute();
        $internships = $stmt->get_result();

        while ($internship = $internships->fetch_assoc()): ?>
            <div class="internship-card">
                <img src="internship_logo_upload/<?php echo htmlspecialchars($internship['poster_image']); ?>" class="poster-image" alt="Internship Poster">
                <div class="internship-details">
                    <h3><?php echo htmlspecialchars($internship['title']); ?></h3>
                    <p><strong>Company:</strong> <?php echo htmlspecialchars($internship['company_name']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($internship['description']); ?></p>
                    <p><strong>Application Deadline:</strong> <?php echo htmlspecialchars($internship['application_deadline']); ?></p>
                    <a href="student_apply_internship.php?internship_id=<?php echo $internship['id']; ?>" class="button">Apply</a>
                    <a href="connect_alumni.php?posted_by=<?php echo urlencode($internship['admin_user_name']); ?>" class="button">Connect Alumni</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
