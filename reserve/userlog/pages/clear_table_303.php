<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "qrcode";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Move all records from unitlogs to 302restore
$result = $mysqli->query("INSERT INTO 303restore SELECT * FROM unitlogs2");

if ($result) {
    // Delete all records from unitlogs
    $mysqli->query("DELETE FROM unitlogs2");

    echo "Records moved to 303restore successfully";
} else {
    echo "Error moving records: " . $mysqli->error;
}

$mysqli->close();
?>
