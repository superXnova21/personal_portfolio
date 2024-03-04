<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "admin_db"; 

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $quote = $_POST["quote"];
        $description = $_POST["description"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];   
        $facebook = $_POST["facebook"];
        $instagram = $_POST["instagram"];
        $linkedin = $_POST["linkedin"];
        $github = $_POST["github"];

        // Upload profile image
        if ($_FILES["about-image"]["error"] == 0) {
            $imageData = file_get_contents($_FILES["about-image"]["tmp_name"]);
        }

        // SQL to update data in the database
        $sql = "UPDATE about_table SET about_quote=?, description=?, name=?, phone=?, email=?, facebook=?, instagram=?, linkedin=?, github=?, aboutimage=? WHERE id=?"; // Assuming the id of the row you want to update is 1, change it accordingly

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(1, $quote);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $name);
        $stmt->bindParam(4, $phone);
        $stmt->bindParam(5, $email);
        $stmt->bindParam(6, $facebook);
        $stmt->bindParam(7, $instagram);
        $stmt->bindParam(8, $linkedin);
        $stmt->bindParam(9, $github);
        $stmt->bindParam(10, $imageData, PDO::PARAM_LOB);
        $stmt->bindParam(11, $_POST['id']);

        
        $stmt->execute();
        echo "<script>alert('Updated successfully!'); setTimeout(function() { window.location.href = 'index.php'; }, 1000);</script>";
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null; 
}
?>
