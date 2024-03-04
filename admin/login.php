<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form id="loginForm" action="connect.php" method="post">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input type="submit" value="Login">
            <?php
            if(isset($_GET['error']) && $_GET['error'] == "invalid_credentials") {
                echo '<p class="error-message">Invalid username or password</p>';
            }
            ?>
        </form>
        <a href="#">Forgot password?</a>
    </div>
</body>
</html>

