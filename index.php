<?php
session_start();
require_once 'db_connection.php';
include 'includes/header.php';

$posts_query = "SELECT * FROM post";
$posts_result = $conn->query($posts_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">

</head>
<body class="home">
    <?php include 'includes/header.php'; ?>

    <div class="categories">
        <button class="category">Vegan</button>
        <button class="category">Healthy</button>
        <button class="category">Easy to Make</button>
    </div>

    <div class="post-grid">
        <?php while($post = $posts_result->fetch_assoc()): ?>
            <div class="post">
                <img src="<?php echo $post['image']; ?>" alt="Post Image"> 
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

