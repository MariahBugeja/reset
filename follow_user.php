<?php
session_start();
require_once 'db_connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php"); 
    exit; 
}

// Check if the form is submitted
if (isset($_POST['follow'])) {
    // Get the followed user ID from the form
    $followed_user_id = $_POST['followed_user_id'];
    
    // Get the current user ID from the session
    $follower_user_id = $_SESSION['user_id'];
    
    $check_query = "SELECT * FROM follow WHERE userid = ? AND timestamp = ?";
    $check_stmt = $conn->prepare($check_query);
    
    if (!$check_stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit;
    }
    
    $check_stmt->bind_param("is", $follower_user_id, $followed_user_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        // User is already following, so unfollow
        $unfollow_query = "DELETE FROM follow WHERE userid = ? AND timestamp = ?";
        $unfollow_stmt = $conn->prepare($unfollow_query);
        
        if (!$unfollow_stmt) {
            // Check for errors in query preparation
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit;
        }
        
        $unfollow_stmt->bind_param("is", $follower_user_id, $followed_user_id);
        
        if (!$unfollow_stmt->execute()) {
            echo "Unfollow failed: (" . $unfollow_stmt->errno . ") " . $unfollow_stmt->error;
        } else {
            // Redirect back to the user profile page after unfollowing
            header("Location: users.php?userid=$followed_user_id"); 
            exit; 
        }
    } else {
        // User is not following, so follow
        $follow_query = "INSERT INTO follow (userid, timestamp) VALUES (?, ?)";
        $follow_stmt = $conn->prepare($follow_query);
        
        if (!$follow_stmt) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit;
        }
        
        // Set the timestamp to current time
        $timestamp = date("Y-m-d H:i:s");
        
        $follow_stmt->bind_param("is", $follower_user_id, $timestamp);
        if (!$follow_stmt->execute()) {
            echo "Execute failed: (" . $follow_stmt->errno . ") " . $follow_stmt->error;
        } else {
            // Redirect back to the user profile page after following
            header("Location: users.php?userid=$followed_user_id"); 
            exit; 
        }
    }
} else {
    echo "Invalid request.";
}
?>
