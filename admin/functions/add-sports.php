<?php
include('../../connection/constants.php');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    
    $sportName = $_POST["sportName"];

    
    $check_sql = "SELECT * FROM sports WHERE name = '$sportName'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
      
        session_start();
        $_SESSION['add'] = "Sport already exists.";
        $_SESSION['add_type'] = "error";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    
    $sql = "INSERT INTO sports (name) VALUES ('$sportName')";

    
    if (mysqli_query($conn, $sql)) {
       
        session_start();
        $_SESSION['add'] = "Sport added successfully.";
        $_SESSION['add_type'] = "success";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        
        session_start();
        $_SESSION['add'] = "Failed to add sport. Please try again.";
        $_SESSION['add_type'] = "error";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    
    echo "Form submission error!";
}
?>
