<?php

    $host = 'localhost';
    $dbname = 'admin_db';
    $username = 'root';
    $password = '';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        $response = array('status' => 'error', 'message' => 'Database connection failed: ' . $e->getMessage());
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit();
    }
?>    