<?php
session_start();
require_once 'db_connection.php';
include 'includes/header.php';

function generateCard($row) {
    return '
    <div class="search-card"> <!-- Added class "search-card" -->
        <img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["title"]) . '" class="search-card-image"> <!-- Added class "search-card-image" -->
        <div class="search-card-content"> <!-- Added class "search-card-content" -->
            <h3 class="search-card-content-h3">' . htmlspecialchars($row["title"]) . '</h3> <!-- Added class "search-card-content-h3" -->
        </div>
    </div>';
}

$resultsHtml = '';

if (isset($_GET['query'])) {
    $query = '%' . $_GET['query'] . '%';

    $stmt1 = $conn->prepare("SELECT 'post' AS source, postId AS id, title, description, image, Userid, Typeoffood AS additional FROM post WHERE title LIKE ? OR Typeoffood LIKE ?");
    $stmt1->bind_param("ss", $query, $query);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    $stmt2 = $conn->prepare("SELECT 'postrecipe' AS source, recipeId AS id, title, description, image, userid, ingredients AS additional FROM postrecipe WHERE title LIKE ? OR ingredients LIKE ?");
    $stmt2->bind_param("ss", $query, $query);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result1->num_rows > 0 || $result2->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $resultsHtml .= generateCard($row);
        }
        while ($row = $result2->fetch_assoc()) {
            $resultsHtml .= generateCard($row);
        }
    } else {
        $resultsHtml = '<p>No results found.</p>';
    }

    $stmt1->close();
    $stmt2->close();
} else {
    $resultsHtml = '<p>No search query provided.</p>';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
<style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.search-results {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.search-card {
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: transform 0.2s;
}

.search-card:hover {
    transform: scale(1.05);
}

.search-card img.search-card-image {
    width: 100%;
    height: auto;
    display: block;
}

.search-card-content {
    padding: 15px;
}

.search-card-content h3.search-card-content-h3 {
    margin: 0;
    font-size: 1.2em;
    color: #333;
}

</style>
</head>
<body>
    <div class="search-results">
        <?php echo $resultsHtml; ?>
    </div>
</body>
</html>
