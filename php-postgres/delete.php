<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['id' => $_SESSION['user_id']])) {
        session_destroy();
        echo "Account deleted.";

        // Redirect to register page after account deletion
        header("Location: register.php");
        exit;
    } else {
        echo "Error: " . $stmt->errorCode();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Account</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Delete Account</h2>
        <form method="POST" action="delete.php">
            <p>Are you sure you want to delete your account?</p>
            <button type="submit" class="btn btn-danger">Delete Account</button>
            <a href="profile.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
