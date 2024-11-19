<?php
session_start();
require 'db.php'; // Include your database connection file

// Check if internship ID is passed
if (!isset($_GET['internship_id'])) {
    echo "Internship not found.";
    exit;
}

$internship_id = $_GET['internship_id'];
$student_id = $_SESSION['user_id'];

// Fetch the application status for the specific internship
$stmt = $conn->prepare("SELECT application_status FROM internship_applications WHERE internship_id = ? AND student_id = ?");
$stmt->bind_param("ii", $internship_id, $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No application found.";
    exit;
}

$application = $result->fetch_assoc();
$application_status = $application['application_status'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Status</title>
    <style>
        .message-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
    <link rel="stylesheet" href="./style.css">

</head>
<body>
    
<header>
    <div class="header-container">
        <img src="https://www.pondiuni.edu.in/wp-content/uploads/2020/05/PU_Logo_Full.png" alt="College Logo">
    </div>
    <nav>
        <div class="college-title">
        <h2>Alumni Connect </h2>    
        </div>
      <a href="./student_index.php">Home</a>
        <a href="job_show.php">Jobs</a>
        <a href="internship_show.php">Internships</a>
        <a href="student_profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="message-box">
    <?php 
    if (is_null($application_status)) {
        echo "<p>Your application is still under review. Please wait for approval.</p>";
    } elseif ($application_status === 'approved') {
        echo "<p class='success'>You have been approved! We will contact you soon.</p>";
    } elseif ($application_status === 'denied') {
        echo "<p class='error'>Your application has been denied.</p>";
    } else {
        echo "<p>Your application status is: " . htmlspecialchars($application_status) . "</p>";
    }
    ?>
</div>

</body>
</html>
