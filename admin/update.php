<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "UPDATE message_table SET user = '$user', email = '$email', phone = '$phone', message = '$message' WHERE id = 2";

    if ($conn->query($sql) === TRUE) {
        echo "Contact section updated successfully";
    } else {
        echo "Error updating contact section: " . $conn->error;
    }
}

$conn->close();
?>
