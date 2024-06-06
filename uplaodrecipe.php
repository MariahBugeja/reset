<?php
session_start();
require_once 'db_connection.php'; 

// Check if the form is submitted
if (isset($_POST["submit"])) {
    // File upload directory
    $target_dir = "uploads/";

    // Create the uploads directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Get file details
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is OK, try to upload the file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $ingredients = $_POST['ingredients'];
            $instruction = $_POST['instruction'];
            $image_path = $target_file;

            $sql = "INSERT INTO postrecipe (title, description, ingredients, instruction, image, userid) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if (isset($_SESSION['user_id'])) {
                $userid = $_SESSION['user_id']; 
            } else {
                echo "User not logged in."; // Error message if user is not logged in
                exit; 
            }

            if ($stmt) {
                $stmt->bind_param("sssssi", $title, $description, $ingredients, $instruction, $image_path, $userid);

                if ($stmt->execute()) {
                    // Redirect to the account page after successful submission
                    header("Location: accountpage.php");
                    exit; 
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "SQL error: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
