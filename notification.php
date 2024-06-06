<?php
session_start();
require_once 'db_connection.php';

// Check if user is logged in, redirect to login page if not
if (!isset($_SESSION['userId'])) {
    header("Location: loginpage.php");
    exit();
}

// Function to fetch notifications for the current user
function getNotifications($userId, $limit = 10) {
    $db = connectToDatabase();
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $query = "SELECT * FROM notification WHERE userId = ? ORDER BY createdAt DESC LIMIT ?";
    $statement = $db->prepare($query);
    if (!$statement) {
        die("Error preparing statement: " . $db->error); 
    }
    $statement->bind_param("ii", $userId, $limit);
    if (!$statement->execute()) {
        die("Error executing statement: " . $statement->error); 
    }
    $result = $statement->get_result();
    if (!$result) {
        die("Error getting result: " . $statement->error); 
    }
    $notifications = $result->fetch_all(MYSQLI_ASSOC);
    $statement->close();
    return $notifications;
}

// Get notifications for the current user
$userId = $_SESSION['userId'];
$notifications = getNotifications($userId);

// Display notifications
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
</head>
<body>
    <h1>Notifications</h1>
    <ul>
        <?php foreach ($notifications as $notification): ?>
            <li><?php echo $notification['message']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
