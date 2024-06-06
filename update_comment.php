<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['comment_id']) || !isset($_POST['new_content'])) {
    header("Location: loginpage.php");
    exit;
}

$comment_id = $_POST['comment_id'];
$new_content = $_POST['new_content'];
$user_id = $_SESSION['user_id'];

// Check if the comment belongs to the user
$comment_query = "SELECT * FROM comment WHERE commentid = ? AND userid = ?";
$stmt = $conn->prepare($comment_query);
$stmt->bind_param("ii", $comment_id, $user_id);
$stmt->execute();
$comment_result = $stmt->get_result();

if ($comment_result->num_rows > 0) {
    $update_query = "UPDATE comment SET content = ? WHERE commentid = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("si", $new_content, $comment_id);
    $update_stmt->execute();
    header("Location: post.php?postid=" . $_POST['post_id']);
} else {
    echo "Unauthorized action.";
}
?>
