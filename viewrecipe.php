<?php
session_start();
require_once 'db_connection.php';
include 'includes/header.php';

if (isset($_GET['recipeid'])) {
    $recipe_id = $_GET['recipeid'];
    $recipe_query = "SELECT * FROM postrecipe WHERE recipeId = $recipe_id";
    $recipe_result = $conn->query($recipe_query);
    if ($recipe_result === false || $recipe_result->num_rows == 0) {
        echo "Error: Recipe not found";
        exit();
    }
    $recipe = $recipe_result->fetch_assoc();

    $user_id = $recipe['userid'];
    $user_query = "SELECT * FROM user WHERE userid = $user_id";
    $user_result = $conn->query($user_query);
    if ($user_result === false || $user_result->num_rows == 0) {
        // Handle user not found error
        echo "Error: User not found";
        exit();
    }
    $user = $user_result->fetch_assoc();

} else {
    echo "Invalid recipe ID";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($recipe['title']) ? $recipe['title'] : 'Recipe Title'; ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container-view {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin-top: 50px; 
        }
    </style>
</head>
<body>
    <div class="container-view">
        <div class="post-details-view">
            <img src="<?php echo $recipe['image']; ?>" alt="Recipe Image">
            <div class="post-content-view">
                <h2 class="post-title-view"><?php echo isset($recipe['title']) ? $recipe['title'] : 'Untitled'; ?></h2>
                <p class="creator-view">Created by: <a href="user_profile.php?userid=<?php echo $user['userid']; ?>"><?php echo $user['username']; ?></a></p>
                <p class="post-description-view"><?php echo $recipe['description']; ?></p>
                <p class="recipe-ingredients-view"><?php echo $recipe['ingredients']; ?></p>
                <p class="recipe-instructions-view"><?php echo $recipe['instruction']; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
