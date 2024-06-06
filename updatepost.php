<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_post'])) {
    // Validate post data and perform necessary updates
    $postId = $_POST['post_id'];
    $newTitle = $_POST['new_title'];

    $update_query = "UPDATE post SET title = ? WHERE postId = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("si", $newTitle, $postId);
    if ($update_stmt->execute()) {
        header("Location: accountpage.php");
        exit;
    } else {
        echo "Failed to update post.";
    }
}
?>
