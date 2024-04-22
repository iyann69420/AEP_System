<?php

include 'conixion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        moveIndividualRecordToArchive($_POST['id']);
    }
}

function moveIndividualRecordToArchive($recordId) {
    global $con;

    try {
        // Move the individual record to the 'reportsrestore' table
        $con->query("INSERT INTO reportsrestore SELECT * FROM reports WHERE id = $recordId");

        // Delete the individual record from the 'reports' table
        $con->query("DELETE FROM reports WHERE id = $recordId");

        echo "Record moved to archive successfully";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
