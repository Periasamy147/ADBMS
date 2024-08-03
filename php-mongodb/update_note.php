<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $note_id = new MongoDB\BSON\ObjectId($_POST['note_id']);
    $content = $_POST['content'];

    $result = $notesCollection->updateOne(
        ['_id' => $note_id, 'user_id' => new MongoDB\BSON\ObjectId($_SESSION['user_id'])],
        ['$set' => ['content' => $content, 'updated_at' => new MongoDB\BSON\UTCDateTime()]]
    );

    if ($result->getModifiedCount() == 1) {
        echo '<div class="container mt-5">
                <div class="alert alert-success" role="alert">
                    Note updated successfully!
                </div>
              </div>';
    } else {
        echo '<div class="container mt-5">
                <div class="alert alert-danger" role="alert">
                    Error: Could not update note.
                </div>
              </div>';
    }
}

$note_id = $_GET['id'] ?? null;
if (!$note_id) {
    header("Location: profile.php");
    exit;
}

$note = $notesCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($note_id), 'user_id' => new MongoDB\BSON\ObjectId($_SESSION['user_id'])]);

if (!$note) {
    header("Location: profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Note</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Note</h2>
        <form method="POST" action="update_note.php">
            <input type="hidden" name="note_id" value="<?php echo $note['_id']; ?>">
            <div class="form-group">
                <label for="content">Note Content:</label>
                <textarea class="form-control" id="content" name="content" rows="5" required><?php echo htmlspecialchars($note['content']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Note</button>
            <a href="profile.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
