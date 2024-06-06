<?php
require_once 'db_connection.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the delete button was clicked
    if (isset($_POST["delete_saved_post"])) {
        // Retrieve the saved post ID from the form data
        $saved_post_id = $_POST["saved_post_id"];
        
        
        $delete_query = "DELETE FROM save WHERE postid = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $saved_post_id);
        
        if ($delete_stmt->execute()) {
            
            header("Location: accountpage.php");
            exit;
        } else {
         
            echo "Error: Unable to delete saved post.";
        }
    }
}
?>
