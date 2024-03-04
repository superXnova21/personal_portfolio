<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === "admin" && $password === "admin") {
        $_SESSION['loggedin'] = true;
        header("Location: adminhub/index.php");
        exit;
    } else {
        header("Location: login.php?error=invalid_credentials");
        exit;
    }
}
?>
