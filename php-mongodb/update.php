<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = new MongoDB\BSON\ObjectId($_SESSION['user_id']);
    $email = $_POST['email'];

    $result = $usersCollection->updateOne(
        ['_id' => $user_id],
        ['$set' => ['email' => $email]]
    );

    if ($result->getModifiedCount() == 1) {
        echo "Email updated successfully.";
    } else {
        echo "Error: Could not update email.";
    }
}

$user_id = new MongoDB\BSON\ObjectId($_SESSION['user_id']);
$user = $usersCollection->findOne(['_id' => $user_id]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Email</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Email</h2>
        <form method="POST" action="update.php">
            <div class="form-group">
                <label for="email">New Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Email</button>
            <a href="profile.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
