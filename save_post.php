<?php
session_start();
require_once 'db_connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit;
}

if (isset($_POST['save'])) {
    $post_id = $_POST['postid'];
    $user_id = $_SESSION['user_id'];

    // Insert into the save table
    $save_query = "INSERT INTO save (userid, postid) VALUES (?, ?)";
    $stmt = $conn->prepare($save_query);
    $stmt->bind_param("ii", $user_id, $post_id);

    if ($stmt->execute()) {
        // Redirect user to account page
        header("Location: accountpage.php");
        exit;
    } else {
        echo "Error saving post: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Unauthorized access!";
}
?>
