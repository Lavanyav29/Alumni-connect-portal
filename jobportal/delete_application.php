<?php
require 'db.php';

if (isset($_GET['id'])) {
    $application_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM job_applications WHERE id = ?");
    $stmt->bind_param("i", $application_id);

    if ($stmt->execute()) {
        echo "Application deleted successfully!";
    } else {
        echo "Error deleting application.";
    }
}
header("Location: job_application.php");
exit();
?>
