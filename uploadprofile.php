<?php
session_start();
require_once 'db_connection.php'; // Include your database connection script

if(isset($_POST["submit"])) {
    $user_id = $_SESSION['user_id'];

    if(isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == 0) {
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);

        if(in_array(strtolower($file_extension), $allowed_types)) {
            $upload_dir = "profile_pics/";
            $upload_file = $upload_dir . $user_id . "." . $file_extension;

            if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $upload_file)) {
                $update_query = "UPDATE user SET profile_pic = ? WHERE userid = ?";
                $update_stmt = $conn->prepare($update_query);
                $update_stmt->bind_param("si", $upload_file, $user_id);
                $update_stmt->execute();
                $update_stmt->close();
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file type. Allowed types are jpg, jpeg, png, and gif.";
        }
    } else {
        echo "No file selected or an error occurred while uploading.";
    }
}

// Redirect back to account page after upload
header("Location: accountpage.php");
exit;
?>
