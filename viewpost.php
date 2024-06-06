<?php
session_start();
require_once 'db_connection.php';
include 'includes/header.php';

if(isset($_GET['postid'])) {
    $post_id = $_GET['postid'];
    $post_query = "SELECT * FROM post WHERE postId = $post_id";
    $post_result = $conn->query($post_query);
    if($post_result === false || $post_result->num_rows == 0) {
        // Handle post not found error
        echo "Error: Post not found";
        exit();
    }
    $post = $post_result->fetch_assoc();

    // Fetch user details
    $user_id = $post['Userid'];
    $user_query = "SELECT * FROM user WHERE userid = $user_id";
    $user_result = $conn->query($user_query);
    if($user_result === false || $user_result->num_rows == 0) {
        // Handle user not found error
        echo "Error: User not found";
        exit();
    }
    $user = $user_result->fetch_assoc();
} else {
    // Handle invalid post id error
    echo "Invalid post ID";
    exit();
}

// Fetch comments for the post
$comment_query = "SELECT comment.*, user.username FROM comment INNER JOIN user ON comment.userid = user.userid WHERE comment.postid = $post_id";
$comment_result = $conn->query($comment_query);
$comments = array();

if ($comment_result->num_rows > 0) {
    while ($row = $comment_result->fetch_assoc()) {
        $comments[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($post['title']) ? $post['title'] : 'Post Title'; ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container-view {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

.post-details-view {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 800px;
    width: 100%;
    display: flex;
    margin-bottom: 20px;
}

.post-details-view img {
    max-width: 300px;
    height: auto;
    margin-right: 20px;
}

.post-content-view {
    flex: 1;
}

.post-title-view {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
}

.creator-view {
    font-size: 16px;
    color: #666;
    margin-bottom: 10px;
}

.post-description-view {
    font-size: 16px;
    margin-bottom: 20px;
}

.comment-section {
    width: 100%;
}

.comment {
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
}

.comment p {
    margin: 5px 0;
}

.comment-form {
    width: 100%;
    margin-top: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 20px;
}

.comment-form textarea {
    width: 100%;
    height: 100px;
    resize: none;
    margin-bottom: 10px;
}

.comment-form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.comment-form input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
</head>
<body>
    <div class="container-view">
        <div class="post-details-view">
            <img src="<?php echo $post['image']; ?>" alt="Post Image">
            <div class="post-content-view">
                <h2 class="post-title-view"><?php echo isset($post['title']) ? $post['title'] : 'Untitled'; ?></h2>
                <p class="creator-view">Created by: <a href="user_profile.php?userid=<?php echo $user['userid']; ?>"><?php echo $user['username']; ?></a></p>
                <p class="post-description-view"><?php echo $post['description']; ?></p>
            </div>
        </div>

        <div class="comment-section">
            <h3>Comments</h3>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <p><?php echo $comment['content']; ?></p>
                        <p>By: <a href="user_profile.php?userid=<?php echo $comment['userid']; ?>"><?php echo $comment['username']; ?></a></p>
                        <p>Time: <?php echo $comment['timestamp']; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No comments yet.</p>
            <?php endif; ?>
        </div>

        <!-- Comment Form -->
        <div class="comment-form">
            <h3>Add Comment</h3>
            <form action="post_comment.php" method="post">
                <textarea name="comment" placeholder="Enter your comment" required></textarea>
                <input type="hidden" name="postid" value="<?php echo $post_id; ?>">
                <input type="submit" value="Post Comment">
            </form>
        </div>
    </div>
</body>
</html>
