<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['comment_id'])) {
    header("Location: loginpage.php");
    exit;
}

$comment_id = $_POST['comment_id'];
$user_id = $_SESSION['user_id'];

// Check if the comment belongs to the user
$comment_query = "SELECT * FROM comment WHERE commentid = ? AND userid = ?";
$stmt = $conn->prepare($comment_query);
$stmt->bind_param("ii", $comment_id, $user_id);
$stmt->execute();
$comment_result = $stmt->get_result();

if ($comment_result->num_rows > 0) {
    $delete_query = "DELETE FROM comment WHERE commentid = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $comment_id);
    $delete_stmt->execute();
    header("Location: post.php?postid=" . $_POST['post_id']);
} else {
    echo "Unauthorized action.";
}
?>
