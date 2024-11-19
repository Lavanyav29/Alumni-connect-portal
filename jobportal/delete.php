<?php
session_start();
require 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if type and ID are provided in the URL
if (!isset($_GET['type']) || !isset($_GET['id'])) {
    die("Invalid request.");
}

$type = $_GET['type'];
$id = (int)$_GET['id'];

// Determine the table to delete from based on type
if ($type === 'job') {
    $table = 'job_postings';

    // Delete all associated rows in job_applications first
    $delete_applications_stmt = $conn->prepare("DELETE FROM job_applications WHERE job_id = ?");
    $delete_applications_stmt->bind_param("i", $id);
    $delete_applications_stmt->execute();

} elseif ($type === 'internship') {
    $table = 'internship_postings';

    // Delete all associated rows in internship_applications first (if applicable)
    $delete_applications_stmt = $conn->prepare("DELETE FROM internship_applications WHERE internship_id = ?");
    $delete_applications_stmt->bind_param("i", $id);
    $delete_applications_stmt->execute();
} else {
    die("Invalid type specified.");
}

// Prepare the delete query for the main job/internship posting
$delete_stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
$delete_stmt->bind_param("i", $id);

// Execute and check for successful deletion
if ($delete_stmt->execute()) {
    echo "<script>alert('Record deleted successfully.'); window.location.href='posted_jobs.php';</script>";
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
