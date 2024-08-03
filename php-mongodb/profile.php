<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = new MongoDB\BSON\ObjectId($_SESSION['user_id']);
$notes = $notesCollection->find(['user_id' => $user_id]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Your Notes</h2>
        <div class="mt-4">
            <a href="create_note.php" class="btn btn-success">Create Note</a>
            <a href="logout.php" class="btn btn-danger ml-2">Logout</a>
            <form action="delete.php" method="POST" style="display: inline;">
                <button type="submit" class="btn btn-danger ml-2">Delete Account</button>
            </form>
        </div>
        <hr>
        <ul class="list-group mt-3">
            <?php foreach ($notes as $note): ?>
                <li class="list-group-item">
                    <?php echo htmlspecialchars($note['content']); ?>
                    <div class="float-right">
                        <a href="update_note.php?id=<?php echo $note['_id']; ?>" class="btn btn-sm btn-warning mr-2">Update</a>
                        <a href="delete_note.php?id=<?php echo $note['_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
