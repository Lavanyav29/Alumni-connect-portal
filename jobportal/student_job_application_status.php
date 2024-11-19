<?php
session_start();
require 'db.php'; // Include your database connection file

// Check if job ID is passed
if (!isset($_GET['job_id'])) {
    echo "Job not found.";
    exit;
}

$job_id = $_GET['job_id'];
$student_id = $_SESSION['user_id'];

// Fetch the application status for the specific job
$stmt = $conn->prepare("SELECT application_status FROM job_applications WHERE job_id = ? AND student_id = ?");
$stmt->bind_param("ii", $job_id, $student_id);
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
    <?php if ($application_status === 'approved'): ?>
        <p>You have been approved! We will contact you soon.</p>
    <?php else: ?>
        <p>Your application is still under review. Please wait for approval.</p>
    <?php endif; ?>
</div>

</body>
</html>
