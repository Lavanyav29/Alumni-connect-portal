<?php
require 'db.php'; // Include your database connection file

// Check if internship application ID is passed
if (isset($_GET['id'])) {
    $application_id = $_GET['id'];

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM internship_applications WHERE id = ?");
    $stmt->bind_param("i", $application_id);

    if ($stmt->execute()) {
        echo "Internship application deleted successfully!";
    } else {
        echo "Error deleting application.";
    }
    $stmt->close();
}

// Redirect back to internship applications page
header("Location: internship_application.php");
exit();
?>
