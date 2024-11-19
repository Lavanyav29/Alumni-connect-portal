<?php
session_start();
require 'db.php';

// Ensure alumni is logged in
if (!isset($_SESSION['alumni_user_name'])) {
    echo "Please log in to view applications.";
    exit;
}

// Fetch job applications from job_applications table
$stmt = $conn->prepare("SELECT id, student_name, cover_letter, resume FROM job_applications");
$stmt->execute();
$applications = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Applications</title>
    <link rel="stylesheet" href="style.css">
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
            <a href="posted_jobs.php">Posted Jobs</a> <!-- New "Posted Jobs" link -->
            <a href="alumni_profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

<table>
    <tr>
        <th>Student Name</th>
        <th>Cover Letter</th>
        <th>Resume</th>
        <th>Actions</th>
    </tr>
    <?php while ($application = $applications->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($application['student_name']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($application['cover_letter'])); ?></td>
            <td><a href="resumes/<?php echo htmlspecialchars($application['resume']); ?>" download>Download Resume</a></td>
            <td>
                <form action="process_application.php" method="POST">
                    <input type="hidden" name="application_id" value="<?php echo $application['id']; ?>">
                    <button type="submit" name="action" value="hire">Hire</button>
                    <button type="submit" name="action" value="deny">Deny</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
