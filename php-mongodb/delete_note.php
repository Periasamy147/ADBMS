<?php
require 'config.php';
session_start();

$note_id = $_GET['id'] ?? null;
if (!$note_id) {
    header("Location: view_notes.php");
    exit;
}

$note_id = new MongoDB\BSON\ObjectId($note_id);
$user_id = new MongoDB\BSON\ObjectId($_SESSION['user_id']);

$result = $notesCollection->deleteOne(['_id' => $note_id, 'user_id' => $user_id]);

if ($result->getDeletedCount() == 1) {
    echo '<div class="container mt-5">
            <div class="alert alert-success" role="alert">
                Note deleted successfully!
            </div>
          </div>';
} else {
    echo '<div class="container mt-5">
            <div class="alert alert-danger" role="alert">
                Error: Could not delete note.
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
        <!-- Success and error messages are displayed here -->
    </div>
</body>
</html>
