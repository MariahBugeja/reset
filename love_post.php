<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "Error: User ID not found in session.";
    exit;
}

$user_id = $_SESSION['user_id']; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['love']) && $_POST['love'] == 1 && isset($_POST['postid'])) {
    $post_id = $_POST['postid'];

    $check_love_query = $conn->prepare("SELECT * FROM love WHERE userid = ? AND postid = ?");
    if (!$check_love_query) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }
    $check_love_query->bind_param("ii", $user_id, $post_id);
    $check_love_query->execute();
    $check_love_result = $check_love_query->get_result();

    if ($check_love_result === false) {
        echo "Error executing query: " . $conn->error;
        exit;
    }

    if ($check_love_result->num_rows == 0) {
        // User hasn't loved the post yet, insert the love
        $insert_love_query = $conn->prepare("INSERT INTO love (userid, postid) VALUES (?, ?)");
        if (!$insert_love_query) {
            echo "Error preparing insert statement: " . $conn->error;
            exit;
        }
        $insert_love_query->bind_param("ii", $user_id, $post_id);

        if ($insert_love_query->execute()) {
            echo "Post loved successfully!";
        } else {
            echo "Error executing insert: " . $conn->error;
        }
    } else {
        // User has already loved this post
        echo "You have already loved this post.";
    }
} else {
    echo "Invalid request.";
}
?>
