<?php
session_start();
require_once 'db_connection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_sql = "SELECT * FROM user WHERE email = ? AND password = ?";
    $login_stmt = $conn->prepare($login_sql);
    $login_stmt->bind_param("ss", $email, $password);
    $login_stmt->execute();
    $login_result = $login_stmt->get_result();

    if ($login_result->num_rows == 1) {
        $user = $login_result->fetch_assoc();
        $_SESSION['user_id'] = $user['userid']; 
        header("Location: index.php"); 
        exit;
    } else {
        $message = "Invalid email or password";
    }
}

var_dump($_SESSION);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body class="login-body">
    <div class="overlay">
        <div class="login-container">
            <form method="post" class="login-form">
                <h1>Login to Pinfood</h1>
                <?php if ($message): ?>
                    <p class="error"><?php echo $message; ?></p>
                <?php endif; ?>
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Login</button>
                
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </form>
        </div>
    </div>
</body>
</html>
