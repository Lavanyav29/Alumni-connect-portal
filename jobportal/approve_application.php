<?php
session_start();
require 'db.php'; // Make sure to include your database connection file

// Check if job application ID is passed
if (!isset($_GET['id'])) {
    echo "Application not found.";
    exit;
}

$application_id = $_GET['id'];

// Update the application status to 'approved'
$stmt = $conn->prepare("UPDATE job_applications SET application_status = 'approved' WHERE id = ?");
$stmt->bind_param("i", $application_id);

if ($stmt->execute()) {
    echo "Application approved successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
