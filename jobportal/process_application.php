<?php
session_start();
require 'db.php';

if (!isset($_SESSION['alumni_user_name'])) {
    echo "Unauthorized access.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $application_id = $_POST['application_id'];
    $action = $_POST['action'];

    // Process the hire or deny action
    if ($action === 'hire') {
        echo "Student has been hired.";
        // Code to update application status in the database or notify student
    } elseif ($action === 'deny') {
        echo "Application has been denied.";
        // Code to update application status in the database or notify student
    } else {
        echo "Invalid action.";
    }
} else {
    echo "Invalid request.";
}
