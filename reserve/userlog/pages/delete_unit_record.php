
<?php
include 'conixion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $facultyId = $_POST['id'];
    $deleteSql = "DELETE FROM reports WHERE id = $facultyId";
    
    if ($con->query($deleteSql) === TRUE) {
        // The record has been deleted successfully
        echo "Record deleted successfully";
    } else {
        // Handle the error
        echo "Error deleting record: " . $con->error;
    }
}
?>
