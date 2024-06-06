<?php
session_start();
require_once 'db_connection.php';
include 'includes/header.php'; 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php"); 
    exit; 
}

$user_id = $_SESSION['userId']; 

// Fetch user information
$user_query = "SELECT * FROM user WHERE userid = ?";
$user_stmt = $conn->prepare($user_query);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();



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
    <title>Account Page</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .edit-icon {
            cursor: pointer;
            margin-left: 10px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body class="account-body">
    <div class="account-container">
        <div class="account-profile">
            <!-- Display user profile information -->
            <h2 class="account-username"><?php echo $username; ?></h2>
            <p class="account-email"><?php echo $email; ?></p>
        </div>
        <div class="account-tabs">
            <button class="account-tab active" onclick="showTab('account-created')">Created</button>
            <button class="account-tab" onclick="showTab('account-saved')">Saved</button>
        </div>
        <div id="account-created" class="account-posts">
            <h2 class="account-posts-title">My Posts</h2>
            <div class="account-posts-grid">
                <!-- Display user posts -->
                <?php if ($posts_result->num_rows > 0): ?>
                    <?php while($post = $posts_result->fetch_assoc()): ?>
                        <div class="account-post">
                            <img src="<?php echo $post['image']; ?>" alt="Post Image">
                            <div>
                                <h3 class="account-post-title">
                                    <span class="title-text"><?php echo $post['title']; ?></span>
                                    <i class="fas fa-edit edit-icon" onclick="editTitle(<?php echo $post['postId']; ?>)"></i>
                                </h3>
                                <form method="post" action="updatepost.php" class="hidden" id="form-<?php echo $post['postId']; ?>">
                                    <input type="hidden" name="post_id" value="<?php echo $post['postId']; ?>">
                                    <input type="text" name="new_title" value="<?php echo $post['title']; ?>">
                                    <button type="submit" name="update_post">Save</button>
                                </form>
                            </div>
                            <form method="post" action="deletepost.php">
                                <input type="hidden" name="post_id" value="<?php echo $post['postId']; ?>">
                                <button type="submit" name="delete_post">Delete</button>
                            </form>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>
            <h2 class="account-posts-title">My Recipes</h2>
            <div class="account-posts-grid">
                <!-- Display user recipes -->
                <?php if ($recipes_result->num_rows > 0): ?>
                    <?php while($recipe = $recipes_result->fetch_assoc()): ?>
                        <div class="account-post">
                            <img src="<?php echo $recipe['image']; ?>" alt="Recipe Image">
                            <div>
                                <h3 class="account-post-title">
                                    <span class="title-text"><?php echo $recipe['title']; ?></span>
                                    <i class="fas fa-edit edit-icon" onclick="editRecipeTitle(<?php echo $recipe['recipeId']; ?>)"></i>
                                </h3>
                                <form method="post" action="updaterecipe.php" class="hidden" id="recipe-form-<?php echo $recipe['recipeId']; ?>">
                                    <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipeId']; ?>">
                                    <input type="text" name="new_title" value="<?php echo $recipe['title']; ?>">
                                    <button type="submit" name="update_recipe">Save</button>
                                </form>
                            </div>
                            <<form method="post" action="deleterecipe.php">
    <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipeId']; ?>">
    <button type="submit" name="delete_recipe">Delete</button>
</form>

                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No recipes found.</p>
                <?php endif; ?>
            </div>
        </div>
        <div id="account-saved" class="account-posts" style="display: none;">
            <h2 class="account-posts-title">Saved Posts</h2>
            <div class="account-posts-grid">
                <?php
                $saved_posts_query = "SELECT DISTINCT post.*, user.username FROM save 
                                      INNER JOIN post ON save.postid = post.postId 
                                      INNER JOIN user ON post.Userid = user.userid 
                                      WHERE save.userid = ?";
                $saved_posts_stmt = $conn->prepare($saved_posts_query);
                $saved_posts_stmt->bind_param("i", $user_id);
                $saved_posts_stmt->execute();
                $saved_posts_result = $saved_posts_stmt->get_result();

                if ($saved_posts_result->num_rows > 0) {
                    while ($saved_post = $saved_posts_result->fetch_assoc()) {
                        ?>
                        <div class="account-post">
                            <img src="<?php echo $saved_post['image']; ?>" alt="Post Image">
                            <h3 class="account-post-title"><?php echo $saved_post['title']; ?></h3>
                            <p>Creator: <?php echo $saved_post['username']; ?></p>
                            <form method="post" action="delete_saved_post.php">
                                <input type="hidden" name="saved_post_id" value="<?php echo $saved_post['postId']; ?>">
                                <button type="submit" name="delete_saved_post">Delete</button>
                            </form>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No saved posts found.</p>";
                }
                ?>
            </div>
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

        function editTitle(postId) {
            document.getElementById('form-' + postId).classList.toggle('hidden');
        }

        function editRecipeTitle(recipeId) {
            document.getElementById('recipe-form-' + recipeId).classList.toggle('hidden');
        }
    </script>
</body>
</html>

<?php
} else {
    echo "User not found.";
}
?>
