<?php
session_start();
require 'db.php';

// Check if job ID is passed
if (!isset($_GET['job_id'])) {
    echo "Job not found.";
    exit;
}

$job_id = $_GET['job_id'];

// Fetch applications for the selected job
$stmt = $conn->prepare("SELECT student_name, cover_letter, resume FROM job_applications WHERE job_posting_id = ?");
$stmt->bind_param("i", $job_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Applications</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

<header>
    <h1>Applications for Job ID: <?php echo htmlspecialchars($job_id); ?></h1>
</header>

<table>
    <tr>
        <th>Name</th>
        <th>ID</th>
        <th>Cover Letter</th>
        <th>Resume</th>
        <th>Actions</th>
    </tr>
    <?php while ($application = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($application['student_name']); ?></td>
        <td><?php echo htmlspecialchars($application['student_id']); ?></td>
        <td><?php echo nl2br(htmlspecialchars($application['cover_letter'])); ?></td>
        <td>
            <a href="resumes/<?php echo htmlspecialchars($application['resume']); ?>" download>Download</a>
        </td>
        <td>
            <button type="button" onclick="acceptApplication(<?php echo $application['id']; ?>)">Accept</button>
            <button type="button" onclick="deleteApplication(<?php echo $application['id']; ?>)">Delete</button>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<script>
    function acceptApplication(applicationId) {
        // Logic to accept the application
        alert('Accepted application ID: ' + applicationId);
        // You can make an AJAX call or a form submission here to update the status in your database
    }

    function deleteApplication(applicationId) {
        // Logic to delete the application
        alert('Deleted application ID: ' + applicationId);
        // You can make an AJAX call or a form submission here to delete the application from your database
    }
</script>

</body>
</html>
