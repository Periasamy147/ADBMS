<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST['content'];
    $user_id = new MongoDB\BSON\ObjectId($_SESSION['user_id']);

    $result = $notesCollection->insertOne([
        'user_id' => $user_id,
        'content' => $content,
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);

    if ($result->getInsertedCount() == 1) {
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
                    Error: Could not create note.
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
