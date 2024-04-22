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
    // Move all records to the '302restore' table
    $mysqli->query("INSERT INTO 302restore SELECT * FROM unitlogs");

    // Delete all records from the 'unitlogs' table
    $mysqli->query("DELETE FROM unitlogs");

    // Commit the transaction
    $mysqli->commit();

    echo "Records moved to '302restore' table and deleted from 'unitlogs' table successfully.";
} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $mysqli->rollback();

    echo "Error: " . $e->getMessage();
}

$mysqli->close();
?>
