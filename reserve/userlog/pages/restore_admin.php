<?php
include 'conixion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminId = $_POST['admin_id'];

    $selectQuery = "SELECT * FROM adminrestore WHERE id = ?";
    $selectStmt = $con->prepare($selectQuery);
    $selectStmt->bind_param('i', $adminId);
    $selectStmt->execute();
    $result = $selectStmt->get_result();

    if ($result->num_rows > 0) {
        $adminData = $result->fetch_assoc();

        $insertQuery = "INSERT INTO adminlogs (full_name, email, password, time_in, time_out) 
                        VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $con->prepare($insertQuery);
        $insertStmt->bind_param('sssss', $adminData['full_name'], $adminData['email'], $adminData['password'], $adminData['time_in'], $adminData['time_out']);

        if ($insertStmt->execute()) {
            $deleteQuery = "DELETE FROM adminrestore WHERE id = ?";
            $deleteStmt = $con->prepare($deleteQuery);
            $deleteStmt->bind_param('i', $adminId);

            if ($deleteStmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error deleting record from adminrestore table']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error restoring record']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Record not found in adminrestore table']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
