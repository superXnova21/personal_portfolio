<?php
    include '../../config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST['id'];
        
        $sql = "DELETE FROM message_table WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        echo json_encode(['success' => true]);
        exit;
    }
?>
