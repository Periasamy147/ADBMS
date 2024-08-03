<?php
require 'config.php';
session_start();

$note_id = $_GET['id'] ?? null;
if (!$note_id) {
    header("Location: view_notes.php");
    exit;
}

$sql = "DELETE FROM notes WHERE id = :note_id AND user_id = :user_id";
$stmt = $pdo->prepare($sql);

if ($stmt->execute(['note_id' => $note_id, 'user_id' => $_SESSION['user_id']])) {
    echo '<div class="container mt-5">
            <div class="alert alert-success" role="alert">
                Note deleted successfully!
            </div>
          </div>';
} else {
    echo '<div class="container mt-5">
            <div class="alert alert-danger" role="alert">
                Error: ' . $stmt->errorCode() . '
            </div>
          </div>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Note</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <a href="profile.php" class="btn btn-primary">Back to Profile</a>
    </div>
</body>
</html>
