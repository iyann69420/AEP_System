<?php

ob_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "qrcode";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirmed']) && $_POST['confirmed'] == 1) {
        moveRecordsToArchive($mysqli);
    }
}

function moveRecordsToArchive($mysqli) {
    try {
        // Move records to the 'reportsrestore' table
        $mysqli->query("INSERT INTO reportsrestore SELECT * FROM reports");

        // Clear the 'reports' table
        $mysqli->query("TRUNCATE TABLE reports");

        echo "Records moved to archive successfully";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$mysqli->close();

?>
