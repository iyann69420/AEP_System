<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "qrcode";

try {
    $con = new PDO("mysql:host=$hostName;dbname=$dbName", $dbUser, $dbPassword);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
