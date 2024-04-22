<?php
ob_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "qrcode";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection error']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['record_id'])) {
        $recordId = $mysqli->real_escape_string($_POST['record_id']);

        // Check if the record is already logged out
        $checkQuery = $mysqli->query("SELECT time_out FROM unitlogs2 WHERE id = '$recordId'");
        $recordData = $checkQuery->fetch_assoc();

        if (!empty($recordData['time_out']) && $recordData['time_out'] != '0000-00-00 00:00:00') {
            // Record already logged out
            echo json_encode(['success' => false, 'message' => 'Record already logged out']);
            exit;
        }

        // Your existing code for logging out the record
        $result = $mysqli->query("UPDATE unitlogs2 SET time_out = NOW() WHERE id = '$recordId'");

        if ($result && $mysqli->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Record logged out successfully']);
            exit;
        } else {
            // An error occurred during the update
            echo json_encode(['success' => false, 'message' => 'Failed to log out the record']);
            exit;
        }
    }
}

// Return an error JSON response if the request is invalid
echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit;
?>
