<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $note_id = $_POST['note_id'];
    $content = $_POST['content'];

    $sql = "UPDATE notes SET content = :content, updated_at = CURRENT_TIMESTAMP WHERE id = :note_id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['content' => $content, 'note_id' => $note_id, 'user_id' => $_SESSION['user_id']])) {
        echo '<div class="container mt-5">
                <div class="alert alert-success" role="alert">
                    Note updated successfully!
                </div>
              </div>';
    } else {
        echo '<div class="container mt-5">
                <div class="alert alert-danger" role="alert">
                    Error: ' . $stmt->errorCode() . '
                </div>
              </div>';
    }
}

$note_id = $_GET['id'] ?? null;
if (!$note_id) {
    header("Location: profile.php");
    exit;
}

$sql = "SELECT * FROM notes WHERE id = :note_id AND user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['note_id' => $note_id, 'user_id' => $_SESSION['user_id']]);
$note = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$note) {
    header("Location: view_notes.php");
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
            <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
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
