<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $title = $_POST['title'];
    $company_name = $_POST['company_name'];
    $description = $_POST['description'];
    $application_deadline = $_POST['application_deadline'];
    $internship_duration = $_POST['internship_duration'];
    $interview_date = $_POST['interview_date'];
    $location = $_POST['location'];
    $internship_type = $_POST['internship_type'];
    $internship_category = $_POST['internship_category'];
    $poster_image = $_FILES['poster_image']['name'];
    $target_dir = "internship_logo_upload/";
    $target_file = $target_dir . basename($_FILES["poster_image"]["name"]);

    // Validate and upload image
    if (move_uploaded_file($_FILES["poster_image"]["tmp_name"], $target_file)) {
        $admin_user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT name FROM alumni_user WHERE id = ?");
        $stmt->bind_param("i", $admin_user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin_user = $result->fetch_assoc();
        $admin_user_name = $admin_user ? $admin_user['name'] : '';

        // Insert internship data into the database
        $stmt = $conn->prepare("INSERT INTO internship_postings (title, company_name, description, admin_user_name, application_deadline, internship_duration, interview_date, location, internship_type, internship_category, poster_image, posted_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssss", $title, $company_name, $description, $admin_user_name, $application_deadline, $internship_duration, $interview_date, $location, $internship_type, $internship_category, $poster_image, $admin_user_name);

        if ($stmt->execute()) {
            echo "Internship posted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error uploading poster image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Internship</title>
    <link rel="stylesheet" href="./style.css">
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
            <a href="./alumini_dashboard.php">Dashboard</a>
            <a href="alumini_index.php">Home</a>
            <a href="job_posting.php">Post Jobs</a>
            <a href="internship_posting.php">Post Internship</a>
            <a href="alumni_profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <form action="internship_posting.php" method="POST" enctype="multipart/form-data">
        <h2>Post Internship</h2>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="company_name">Company Name:</label>
        <input type="text" id="company_name" name="company_name" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="application_deadline">Application Deadline:</label>
        <input type="date" id="application_deadline" name="application_deadline" required>
        
        <label for="internship_duration">Internship Duration:</label>
        <input type="text" id="internship_duration" name="internship_duration" required placeholder="e.g., 3 months">

        <label for="interview_date">Interview Date:</label>
        <input type="date" id="interview_date" name="interview_date" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>
        
        <label for="internship_type">Internship Type:</label>
        <select id="internship_type" name="internship_type" required>
            <option value="" disabled selected>Select Internship Type</option>
            <option value="Full-time">Full-time</option>
            <option value="Part-time">Part-time</option>
            <option value="Work from Home">Work from Home</option>
        </select>
        
        <label for="internship_category">Internship Category:</label>
        <select id="internship_category" name="internship_category" required>
            <option value="" disabled selected>Select Category</option>
            <option value="Software Development">Software Development</option>
            <option value="Web Development">Web Development</option>
            <option value="Data Science">Data Science</option>
            <option value="Cybersecurity">Cybersecurity</option>
            <option value="Mobile App Development">Mobile App Development</option>
            <option value="DevOps">DevOps</option>
            <option value="Machine Learning">Machine Learning</option>
            <option value="Game Development">Game Development</option>
        </select>

        <label for="poster_image">Poster Image:</label>
        <input type="file" id="poster_image" name="poster_image" required>

        <button type="submit">Post Internship</button>
    </form>
</body>
</html>
