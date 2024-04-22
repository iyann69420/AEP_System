<?php
include 'conixion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Fetch the record from the allowed_Student_numbers table
    $result = $con->query("SELECT * FROM allowed_Student_numbers WHERE id = $id");
    $row = $result->fetch_assoc();

    // Move the record to the studentrestore table
    $con->query("INSERT INTO studentrestore (First_Name, Last_Name, empin, section, Year, student_number) VALUES (
        '{$row['First_Name']}',
        '{$row['Last_Name']}',
        '{$row['empin']}',
        '{$row['section']}',
        '{$row['Year']}',
        '{$row['student_number']}'
    )");

    // Delete the record from the allowed_Student_numbers table
    $con->query("DELETE FROM allowed_Student_numbers WHERE id = $id");

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
