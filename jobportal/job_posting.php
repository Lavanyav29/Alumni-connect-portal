<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $title = $_POST['title'];
    $company_name = $_POST['company_name'];
    $description = $_POST['description'];
    $application_deadline = $_POST['application_deadline'];
    $job_type = $_POST['job_type'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $poster_image = $_FILES['poster_image']['name'];
    $target_dir = "job_logo_upload/";
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

        // Insert job data including the new category field
        $stmt = $conn->prepare("INSERT INTO job_postings (title, company_name, description, admin_user_name, application_deadline, job_type, category, location, salary, poster_image, posted_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $title, $company_name, $description, $admin_user_name, $application_deadline, $job_type, $category, $location, $salary, $poster_image, $admin_user_name);

        if ($stmt->execute()) {
            echo "Job posted successfully!";
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
    <title>Post Job</title>
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
            <a href="alumni_index.php">Home</a>
            <a href="job_posting.php">Post Jobs</a>
            <a href="internship_posting.php">Post Internship</a>
            <a href="alumni_profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <form action="job_posting.php" method="POST" enctype="multipart/form-data">
        <h2>Post Job</h2>
        <!-- Other input fields omitted for brevity -->
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="company_name">Company Name:</label>
        <input type="text" id="company_name" name="company_name" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="application_deadline">Application Deadline:</label>
        <input type="date" id="application_deadline" name="application_deadline" required>
        
        <label for="job_type">Job Type:</label>
        <select id="job_type" name="job_type" required>
            <option value="" disabled selected>Select Job Type</option>
            <option value="Full-time">Full-time</option>
            <option value="Part-time">Part-time</option>
            <option value="Contract">Contract</option>
            <option value="Internship">Internship</option>
        </select>
        
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>
        
        <label for="salary">Salary:</label>
        <input type="text" id="salary" name="salary" placeholder="Optional">
        
        <label for="poster_image">Poster Image:</label>
        <input type="file" id="poster_image" name="poster_image" required>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="" disabled selected>Select Category</option>
            <option value="Developing">Developing</option>
            <option value="Testing">Testing</option>
            <option value="Digital Marketing">Digital Marketing</option>
            <option value="Editor">Editor</option>
            <option value="Customer Support">Customer Support</option>
            <option value="Project Management">Project Management</option>
            <option value="Design">Design</option>
            <option value="Data Science">Data Science</option>
        </select>
        
        <button type="submit">Post Job</button>
    </form>
</body>
</html>



