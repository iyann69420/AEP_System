<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "qrcode";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) die("Connection failed: " . $mysqli->connect_error);

// Start a transaction
$mysqli->begin_transaction();

try {
    // Move all records to the '303restore' table
    $mysqli->query("INSERT INTO 303restore SELECT * FROM unitlogs2");

    // Delete all records from the 'unitlogs2' table
    $mysqli->query("DELETE FROM unitlogs2");

    // Commit the transaction
    $mysqli->commit();

    echo "Records moved to '303restore' table and deleted from 'unitlogs2' table successfully.";
} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $mysqli->rollback();

    echo "Error: " . $e->getMessage();
}

$mysqli->close();
?>
