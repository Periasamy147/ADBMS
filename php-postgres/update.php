<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if cancel button is clicked
if (isset($_POST['cancel'])) {
    header("Location: profile.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql = "UPDATE users SET email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['email' => $email, 'id' => $_SESSION['user_id']])) {
        // Update successful, redirect to profile page
        header("Location: profile.php");
        exit;
    } else {
        echo "Error: " . $stmt->errorCode();
    }
}

$sql = "SELECT * FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Profile</h2>
        <form method="POST" action="update.php">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="submit" class="btn btn-secondary" name="cancel">Cancel</button>
        </form>
    </div>
</body>
</html>
