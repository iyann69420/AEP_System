<?php
include 'conixion.php';

if(isset($_POST['start-date'])) {
    $start_date = $_POST['start-date'];
    
    // Fetch records with timestamp greater than or equal to the selected start date
    $result = $con->prepare("SELECT * FROM reports WHERE timestamp >= ?");
    $result->execute([$start_date]);
    
    foreach ($result as $value):
        // Display records
    endforeach;
}
?>
