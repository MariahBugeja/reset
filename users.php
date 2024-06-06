<?php
session_start();
require_once 'db_connection.php';
include 'includes/header.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php"); 
    exit; 
}

if (isset($_GET['userid'])) {
    $user_id = $_GET['userid'];
} else {
    echo "User ID not provided.";
    exit;
}

$user_query = "SELECT * FROM user WHERE userid = ?";
$user_stmt = $conn->prepare($user_query);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();

// Check if user exists
if ($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc(); 

    // Display user information
    $username = $user['username'];
    $email = $user['email'];

    // Fetch user's posts
    $posts_query = "SELECT * FROM post WHERE Userid = ?";
    $posts_stmt = $conn->prepare($posts_query);
    $posts_stmt->bind_param("i", $user_id);
    $posts_stmt->execute();
    $posts_result = $posts_stmt->get_result();

    // Fetch user's recipes
    $recipes_query = "SELECT * FROM postrecipe WHERE userid = ?";
    $recipes_stmt = $conn->prepare($recipes_query);
    $recipes_stmt->bind_param("i", $user_id);
    $recipes_stmt->execute();
    $recipes_result = $recipes_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - <?php echo $username; ?></title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body class="account-body">
    <div class="account-container">
        <div class="account-profile">
            <!-- Display user profile information -->
            <h2 class="account-username"><?php echo $username; ?></h2>
            <p class="account-email"><?php echo $email; ?></p>
            <!-- Follow button -->
            <form action="follow_user.php" method="post">
                <input type="hidden" name="followed_user_id" value="<?php echo $user_id; ?>">
                <button type="submit" name="follow">Follow</button>
            </form>
        </div>
        <div class="account-tabs">
            <button class="account-tab active" onclick="showTab('account-created')">Created</button>
            <button class="account-tab" onclick="showTab('account-saved')">Saved</button>
        </div>
        <div id="account-created" class="account-posts">
            <h2 class="account-posts-title">User's Posts</h2>
            <div class="account-posts-grid">
                <!-- Display user's posts -->
                <?php if ($posts_result->num_rows > 0): ?>
                    <?php while($post = $posts_result->fetch_assoc()): ?>
                        <div class="account-post">
                            <img src="<?php echo $post['image']; ?>" alt="Post Image">
                            <h3 class="account-post-title"><?php echo $post['title']; ?></h3>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>
            <h2 class="account-posts-title">User's Recipes</h2>
            <div class="account-posts-grid">
                <!-- Display user's recipes -->
                <?php if ($recipes_result->num_rows > 0): ?>
                    <?php while($recipe = $recipes_result->fetch_assoc()): ?>
                        <div class="account-post">
                            <img src="<?php echo $recipe['image']; ?>" alt="Recipe Image">
                            <h3 class="account-post-title"><?php echo $recipe['title']; ?></h3>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No recipes found.</p>
                <?php endif; ?>
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
    echo "User not found.";
}
?>
