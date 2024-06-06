<?php
session_start();
require_once 'db_connection.php';
include 'includes/header.php';

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);

$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="create-pin-body">
    <div class="create-pin-container">
        <h2>Create Recipe</h2>
        <form action="uploadrecipe.php" method="post" enctype="multipart/form-data">
            <div class="create-pin-upload-container">
                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" required>
                <label for="image" class="create-recipe-upload-label">
                    <div>Choose a file or drag and drop it here</div>
                    <img id="preview" src="" alt="" class="create-pin-upload-preview" style="display:none;">
                </label>
            </div>
            <div class="create-pin-details-container">
                <div class="create-pin-form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="create-pin-form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required class="create-recipe-textarea"></textarea>
                </div>
                <div class="create-pin-form-group">
                    <label for="ingredients">Ingredients:</label>
                    <textarea id="ingredients" name="ingredients" required class="create-recipe-textarea"></textarea>
                </div>
                <div class="create-pin-form-group">
                    <label for="instruction">Instruction:</label>
                    <textarea id="instruction" name="instruction" required class="create-recipe-textarea"></textarea>
                </div>
            </div>
            <input type="submit" value="Upload" name="submit">
        </form>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            preview.style.display = 'block';
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>
</html>
