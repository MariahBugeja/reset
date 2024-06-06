<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_post'])) {
    // Validate post data and perform necessary deletion
    $postId = $_POST['post_id'];

    $delete_query = "DELETE FROM post WHERE postId = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $postId);
    if ($delete_stmt->execute()) {
        header("Location: accountpage.php");
        exit;
    } else {
        echo "Failed to delete post.";
    }
} else {
    echo "Invalid request.";
}
?>
