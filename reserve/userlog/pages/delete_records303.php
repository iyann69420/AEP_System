<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "qrcode";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$mysqli->query("DELETE FROM unitlogs2");

$mysqli->close();
?>
