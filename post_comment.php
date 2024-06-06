<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['comment']) && isset($_POST['postid'])) {
        $comment = $_POST['comment'];
        $post_id = $_POST['postid'];
        $user_id = $_SESSION['userId']; 

        // Get the current timestamp
        $timestamp = date("Y-m-d H:i:s");

        $user_query = "SELECT username FROM user WHERE userid = '$user_id'";
        $user_result = $conn->query($user_query);
        if ($user_result->num_rows > 0) {
            $user_row = $user_result->fetch_assoc();
            $username = $user_row['username'];

            $insert_query = "INSERT INTO comment (content, userid, postid, username, timestamp) VALUES ('$comment', '$user_id', '$post_id', '$username', '$timestamp')";
            $insert_result = $conn->query($insert_query);

            if ($insert_result === true) {
                // Insert notification
                $notification_message = "New comment posted on your post.";
                $notification_insert_query = "INSERT INTO notification (message, userId, createdAt) VALUES ('$notification_message', '$user_id', '$timestamp')";
                $notification_insert_result = $conn->query($notification_insert_query);
                
                if ($notification_insert_result === true) {
                    header("Location: viewpost.php?postid=$post_id");
                    exit();
                } else {
                    echo "Error: Failed to insert notification. " . $conn->error;
                    exit();
                }
            } else {
                echo "Error: Failed to insert comment. " . $conn->error;
                exit();
            }
        } else {
            echo "Error: User not found.";
            exit();
        }
    } else {
        echo "Error: Missing data.";
        exit();
    }
} else {
    echo "Error: Invalid request method.";
    exit();
}
?>
