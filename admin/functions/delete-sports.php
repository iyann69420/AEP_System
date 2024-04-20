<?php
include('../../connection/constants.php');


if(isset($_GET['id']) && !empty($_GET['id'])) {
    $sportId = $_GET['id'];

  
    $delete_sql = "DELETE FROM sports WHERE sport_id = $sportId";

    if(mysqli_query($conn, $delete_sql)) {
        session_start();
        $_SESSION['delete'] = "Sport deleted successfully.";
        $_SESSION['delete_type'] = "success";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        session_start();
        $_SESSION['delete'] = "Failed to delete sport. Please try again.";
        $_SESSION['delete_type'] = "error";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    echo "Invalid request!";
}
?>