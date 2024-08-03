<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = new MongoDB\BSON\ObjectId($_SESSION['user_id']);

    $result = $usersCollection->deleteOne(['_id' => $user_id]);
    
    if ($result->getDeletedCount() == 1) {
        $notesCollection->deleteMany(['user_id' => $user_id]); // Delete user's notes
        session_destroy();
        header("Location: register.php");
        exit;
    } else {
        echo "Error: Could not delete account.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Delete Account</h2>
        <p>Are you sure you want to delete your account?</p>
        <form method="post">
            <button type="submit" class="btn btn-danger">Yes, Delete My Account</button>
        </form>
        <a href="profile.php" class="btn btn-primary mt-3">Back to Profile</a>
    </div>
</body>
</html>
