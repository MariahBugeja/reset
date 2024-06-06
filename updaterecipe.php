<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_recipe'])) {
    // Validate recipe data and perform necessary updates
    $recipeId = $_POST['recipe_id'];
    $newTitle = $_POST['new_title'];

    $update_query = "UPDATE postrecipe SET title = ? WHERE recipeId = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("si", $newTitle, $recipeId);
    if ($update_stmt->execute()) {
        header("Location: accountpage.php");
        exit;
    } else {
        echo "Failed to update recipe.";
    }
} else {
    echo "Invalid request.";
}
?>
