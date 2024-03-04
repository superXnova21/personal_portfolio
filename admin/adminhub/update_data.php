<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "admin_db"; 

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = $_POST["name"];
        $bannerQuote = $_POST["banner-quote"];
        $bannerQuoteBelow = $_POST["banner-quote-below"];

        if ($_FILES["profile-image"]["error"] == 0) {
            $imageData = file_get_contents($_FILES["profile-image"]["tmp_name"]);
        }

        $sql = "UPDATE home_table SET quote1=?, quote2=?, name=?, image=? WHERE id=?"; 

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $bannerQuote);
        $stmt->bindParam(2, $bannerQuoteBelow);
        $stmt->bindParam(3, $name);
        $stmt->bindParam(4, $imageData, PDO::PARAM_LOB);
        $stmt->bindParam(5, $_POST['id']);

        $stmt->execute();
        echo "<script>alert('Updated successfully!'); setTimeout(function() { window.location.href = 'index.php'; }, 1000);</script>";
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null; 
}
?>
