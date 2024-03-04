<?php
    include 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
        $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        $stmt = $pdo->prepare("INSERT INTO message_table (`user`, `email`, `phone`, `message`) VALUES (?, ?, ?, ?)");
        
        if ($stmt->execute([$user, $email, $phone, $message])) {
            $response = array('status' => 'success', 'message' => 'Message sent successfully!');
        } else {
            $response = array('status' => 'error', 'message' => 'Failed to insert data into the database.');
        }
    }
    else {
        $response = array('status' => 'error', 'message' => 'Invalid request!');
    }

    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

?>