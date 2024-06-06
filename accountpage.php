<?php
session_start();
require_once 'db_connection.php';
include 'includes/header.php'; 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if user is not logged in
    exit; 
}

$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM user WHERE userid = ?";
$user_stmt = $conn->prepare($user_query);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();

if ($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc(); 

    // Handle profile picture upload
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_pic"])) {
        $target_dir = "uploads/"; 
        $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profile_pic"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                // Update the user's profile picture path in the database
                $update_query = "UPDATE user SET profile_pic = ? WHERE userid = ?";
                $update_stmt = $conn->prepare($update_query);
                $update_stmt->bind_param("si", $target_file, $user_id);
                $update_stmt->execute();
                header("Location: account.php");
                exit;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    //  user's posts
    $posts_query = "SELECT * FROM post WHERE Userid = ?";
    $posts_stmt = $conn->prepare($posts_query);
    $posts_stmt->bind_param("i", $user_id);
    $posts_stmt->execute();
    $posts_result = $posts_stmt->get_result();

    //  user's recipes
    $recipes_query = "SELECT * FROM postrecipe WHERE userid = ?";
    $recipes_stmt = $conn->prepare($recipes_query);
    $recipes_stmt->bind_param("i", $user_id);
    $recipes_stmt->execute();
    $recipes_result = $recipes_stmt->get_result();

    // Check if posts and recipes are  successfully
    if ($posts_result->num_rows > 0 || $recipes_result->num_rows > 0) { // Check if posts or recipes are fetched successfully
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your CSS file -->
</head>
<body class="account-body">
    <div class="account-container">
        <div class="account-profile">
            <form method="post" enctype="multipart/form-data">
                <label for="profile_pic_input">
                    <?php if (!empty($user['profile_pic'])): ?>
                        <img src="<?php echo $user['profile_pic']; ?>" alt="Profile Picture" class="profile-pic">
                    <?php else: ?>
                        <div class="profile-pic"></div> <!-- Empty circle -->
                    <?php endif; ?>
                </label>
                <input type="file" name="profile_pic" id="profile_pic_input" style="display: none;">
                <h2 class="account-username"><?php echo $user['username']; ?></h2>
                <p class="account-email"><?php echo $user['email']; ?></p>
            </form>
        </div>
        <div class="account-tabs">
            <button class="account-tab active" onclick="showTab('account-created')">Created</button>
            <button class="account-tab" onclick="showTab('account-saved')">Saved</button>
        </div>
        <div id="account-created" class="account-posts">
            <h2 class="account-posts-title">My Posts</h2>
            <div class="account-posts-grid">
                <?php while($post = $posts_result->fetch_assoc()): ?>
                    <div class="account-post">
                        <img src="<?php echo $post['image']; ?>" alt="Post Image">
                        <h3 class="account-post-title"><?php echo $post['title']; ?></h3>
                    </div>
                <?php endwhile; ?>
            </div>
            <h2 class="account-posts-title">My Recipes</h2>
            <div class="account-posts-grid">
                <?php while($recipe = $recipes_result->fetch_assoc()): ?>
                    <div class="account-post">
                        <img src="<?php echo $recipe['image']; ?>" alt="Recipe Image">
                        <h3 class="account-post-title"><?php echo $recipe['title']; ?></h3>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <div id="account-saved" class="account-posts" style="display: none;">
            <h2 class="account-posts-title">Saved Posts</h2>
        </div>
    </div>
    <script>
        function showTab(tabName) {
            document.getElementById('account-created').style.display = 'none';
            document.getElementById('account-saved').style.display = 'none';
            document.getElementById(tabName).style.display = 'block';
            document.querySelectorAll('.account-tab').forEach(button => {
                button.classList.remove('active');
            });
            document.querySelector(`.account-tab[onclick="showTab('${tabName}')"]`).classList.add('active');
        }
    </script>
</body>
</html>

<?php
    } else {
        echo "No posts or recipes found.";
    }
} else {
    echo "User not found.";
}
?>
