<?php
// Include your database connection file if not already included

// Assuming you're using MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qrcode";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to reset tables
$sql = "TRUNCATE TABLE addtable;
        TRUNCATE TABLE adminlogs;
        TRUNCATE TABLE allowed_student_numbers;
        TRUNCATE TABLE another_table;
        TRUNCATE TABLE contactus;
        TRUNCATE TABLE course;
        TRUNCATE TABLE data;
        TRUNCATE TABLE devices;
        TRUNCATE TABLE faculty;
        TRUNCATE TABLE facultylogs;
        TRUNCATE TABLE kondisyon;
        TRUNCATE TABLE logs;
        TRUNCATE TABLE logs_lab2;
        TRUNCATE TABLE reports;
        TRUNCATE TABLE rooms;
        TRUNCATE TABLE studentlogs;
        TRUNCATE TABLE subject;
        TRUNCATE TABLE subjects;
        TRUNCATE TABLE timer;
        TRUNCATE TABLE unitlogs;
		TRUNCATE TABLE units;
        TRUNCATE TABLE units302;";

if ($conn->multi_query($sql) === TRUE) {
    echo '<div id="successMessage" style="color: green;">Database reset successfully</div>';
} else {
    echo '<div id="errorMessage" style="color: red;">Error resetting database: ' . $conn->error . '</div>';
}

// Close the connection
$conn->close();
?>

