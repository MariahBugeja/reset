<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pinfood</title>
</head>
<body>
    <div class="pinfood-header">
        <div class="header">
            <div class="header-left">
                <div class="logo"><a href="index.php" style="text-decoration: none; color: inherit;">Pinfood</a></div>
                <div class="nav-item"><a href="createpin.php" style="text-decoration: none; color: inherit;">Create</a></div>
            </div>
            <div class="header-center">
                <form action="search.php" method="GET">
                    <input type="text" name="query" class="search-input" placeholder="Search">
                </form>
            </div>
            <div class="header-right">
            <a href="notification.php"class="icon notification-icon">

</a>
                <a href="recipe.php" class="icon recipe-icon"></a>
                <a href="accountpage.php" style="text-decoration: none; color: inherit;" class="icon profile-icon"></a>
            </div>
        </div>
    </div>
</body>
</html>
