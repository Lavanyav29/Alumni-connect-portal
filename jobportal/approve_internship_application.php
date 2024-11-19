<?php
session_start();
require 'db.php'; // Include your database connection file

// Check if internship application ID is passed
if (!isset($_GET['id'])) {
    echo "Application not found.";
    exit;
}

$application_id = $_GET['id'];

// Update the application status to 'approved'
$stmt = $conn->prepare("UPDATE internship_applications SET application_status = 'approved' WHERE id = ?");
$stmt->bind_param("i", $application_id);

if ($stmt->execute()) {
    echo "Internship application approved successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
