<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST['content'];

    $sql = "INSERT INTO notes (user_id, content) VALUES (:user_id, :content)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['user_id' => $_SESSION['user_id'], 'content' => $content])) {
        echo '<div class="container mt-5">
                <div class="alert alert-success" role="alert">
                    Note created successfully!
                </div>
              </div>';
        echo '<div class="container mt-3">
                <a href="profile.php" class="btn btn-primary">Go to Profile</a>
              </div>';
    } else {
        echo '<div class="container mt-5">
                <div class="alert alert-danger" role="alert">
                    Error: ' . $stmt->errorCode() . '
                </div>
              </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Note</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Create Note</h2>
        <form method="POST" action="create_note.php">
            <div class="form-group">
                <label for="content">Note Content:</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Note</button>
            <a href="profile.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
