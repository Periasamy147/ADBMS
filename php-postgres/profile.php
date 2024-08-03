<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Function to fetch user details
function getUserDetails($pdo, $user_id) {
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$user = getUserDetails($pdo, $_SESSION['user_id']);

// Function to fetch user notes
function getUserNotes($pdo, $user_id) {
    $sql = "SELECT * FROM notes WHERE user_id = :user_id ORDER BY created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$notes = getUserNotes($pdo, $_SESSION['user_id']);
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
        <h2>Profile</h2>
        <h3>Welcome, <?php echo htmlspecialchars($user['username']); ?></h3>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <div class="mt-4">
            <a href="update.php" class="btn btn-primary mr-2">Update Email</a>
            <a href="create_note.php" class="btn btn-success mr-2">Create Note</a>
            <a href="delete.php" class="btn btn-danger mr-2">Delete Account</a>
            
        </div>
        <hr>
        <h4>Your Notes:</h4>
        <ul class="list-group mt-3">
            <?php foreach ($notes as $note): ?>
                <li class="list-group-item">
                    <?php echo htmlspecialchars($note['content']); ?>
                    <div class="float-right">
                        <a href="update_note.php?id=<?php echo $note['id']; ?>" class="btn btn-sm btn-warning mr-2">Update</a>
                        <a href="delete_note.php?id=<?php echo $note['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
