<?php
// Include the database connection
require 'db.php';

// Get the posted_by value from the request
$posted_by = $_GET['posted_by']; // Fetch the posted_by parameter
$response = [];

// Step 1: Check if posted_by exists in alumni_user table
$stmt = $conn->prepare("SELECT id, name FROM alumni_user WHERE name = ?");
$stmt->bind_param("s", $posted_by);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $alumni_id = $user_data['id']; // Get the alumni ID

    // Step 2: Fetch the profile details from alumni_profile table using alumni_id
    $stmt = $conn->prepare("SELECT full_name, profile_pic, email, phone 
                             FROM alumni_profile WHERE alumni_id = ?");
    $stmt->bind_param("i", $alumni_id);
    $stmt->execute();
    $profile_result = $stmt->get_result();

    // Check if profile details are found
    if ($profile_result->num_rows > 0) {
        $profile = $profile_result->fetch_assoc();
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = 'Profile not found!';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Alumni user not found!';
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Profile</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
}

header {
    text-align: center;
    margin-bottom: 20px;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.profile-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    width: 300px;
}

.profile-pic {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 15px;
}

.error-message {
    color: red;
    font-weight: bold;
}
</style>
    
</head>
<body>
    <header>
        <h1>Alumni Profile Details</h1>
    </header>

    <div class="container">
        <?php if (isset($response['success']) && $response['success']): ?>
            <div class="profile-card">
                <img src="<?php echo $profile['profile_pic']; ?>" alt="Profile Picture" class="profile-pic">
                <h2><?php echo $profile['full_name']; ?></h2>
                <p>Email: <?php echo $profile['email']; ?></p>
                <p>Phone: <?php echo $profile['phone']; ?></p>
            </div>
        <?php else: ?>
            <div class="error-message">
                <p><?php echo $response['message']; ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
