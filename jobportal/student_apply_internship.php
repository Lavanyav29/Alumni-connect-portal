<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must log in to apply for an internship.";
    exit;
}

// Check if internship ID is passed
if (!isset($_GET['internship_id'])) {
    echo "Internship not found.";
    exit;
}

$internship_id = $_GET['internship_id'];
$student_id = $_SESSION['user_id'];

// Fetch student name from `student_user` table based on `student_id`
$student_stmt = $conn->prepare("SELECT name FROM student_user WHERE id = ?");
$student_stmt->bind_param("i", $student_id);
$student_stmt->execute();
$student_result = $student_stmt->get_result();

if ($student_result->num_rows === 0) {
    echo "Student not found.";
    exit;
}

$student = $student_result->fetch_assoc();
$student_name = $student['name'];

// Fetch internship details, including the alumni who posted it
$stmt = $conn->prepare("SELECT title, company_name, description, posted_by FROM internship_postings WHERE id = ?");
$stmt->bind_param("i", $internship_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Internship not found.";
    exit;
}

$internship = $result->fetch_assoc();
$posted_by = $internship['posted_by'];
$internship_title = $internship['title'];

// Fetch alumni ID from `alumni_user` table based on `posted_by`
$alumni_stmt = $conn->prepare("SELECT id FROM alumni_user WHERE name = ?");
$alumni_stmt->bind_param("s", $posted_by);
$alumni_stmt->execute();
$alumni_result = $alumni_stmt->get_result();

if ($alumni_result->num_rows === 0) {
    echo "Alumni not found.";
    exit;
}

$alumni = $alumni_result->fetch_assoc();
$alumni_id = $alumni['id'];

// Check if the student has already applied for this internship
$stmt = $conn->prepare("SELECT * FROM internship_applications WHERE internship_id = ? AND student_id = ?");
$stmt->bind_param("ii", $internship_id, $student_id);
$stmt->execute();
$application_result = $stmt->get_result();
$has_applied = $application_result->num_rows > 0;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$has_applied) {
    $cover_letter = $_POST['cover_letter'];
    $resume = $_FILES['resume']['name'];
    $target_dir = "resumes/";
    $target_file = $target_dir . basename($resume);

    // Upload the resume
    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
        // Insert application into the internship_applications table, including student_name and alumni_id
        $stmt = $conn->prepare("INSERT INTO internship_applications (internship_id, internship_title, student_id, student_name, cover_letter, resume, posted_by, alumni_id, application_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("issssssi", $internship_id, $internship_title, $student_id, $student_name, $cover_letter, $resume, $posted_by, $alumni_id);
        
        if ($stmt->execute()) {
            echo "Application submitted successfully!";
            $has_applied = true; // Update the application status
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error uploading resume.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply for Internship</title>
    <link rel="stylesheet" href="./style.css">
    
    <style>
    .internship-details {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 20px auto;
    }
    .internship-details h3 {
        font-size: 1.5em;
        color: #333;
        margin-bottom: 10px;
    }
    .internship-details p {
        font-size: 1em;
        color: #555;
        line-height: 1.6;
        margin: 8px 0;
    }
    .internship-details strong {
        color: #333;
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
<h2>Apply for Internship</h2>

<div class="internship-details">
    <h3><?php echo htmlspecialchars($internship['title']); ?></h3>
    <p><strong>Company:</strong> <?php echo htmlspecialchars($internship['company_name']); ?></p>
    <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($internship['description'])); ?></p>
    <p><strong>Salary:</strong> <?php echo htmlspecialchars($internship['salary']); ?></p>
</div>

<?php if ($has_applied): ?>
    <p>Your application has already been submitted.</p>
    <a href="student_internship_application_status.php?internship_id=<?php echo $internship_id; ?>" class="btn">View Application Status</a>
<?php else: ?>
    <form action="student_apply_internship.php?internship_id=<?php echo $internship_id; ?>" method="POST" enctype="multipart/form-data">
        <label for="cover_letter">Cover Letter:</label>
        <textarea id="cover_letter" name="cover_letter" required></textarea>

        <label for="resume">Upload Resume:</label>
        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required>

        <button type="submit">Submit Application</button>
    </form>
<?php endif; ?>

</body>
</html>
