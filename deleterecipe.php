<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_recipe'])) {
    $recipeId = $_POST['recipe_id'];

    $delete_query = "DELETE FROM postrecipe WHERE recipeId = ?";
    $delete_stmt = $conn->prepare($delete_query);

    if (!$delete_stmt) {
        die("Error preparing delete statement: " . $conn->error);
    }

    $delete_stmt->bind_param("i", $recipeId);
    if ($delete_stmt->execute()) {
        header("Location: accountpage.php");
        exit;
    } else {
        echo "Failed to delete recipe.";
    }
} else {
    echo "Invalid request.";
}
?>
