<?php
include('../../connection/constants.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sportId = $_POST["sport_id"];
    $sportName = $_POST["sportName"];

    // Check if the updated sport name already exists (excluding the current sport)
    $check_sql = "SELECT * FROM sports WHERE name = '$sportName' AND sport_id != $sportId";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        session_start();
        $_SESSION['update'] = "Failed to update sport. Sport name already exists.";
        $_SESSION['update_type'] = "error";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Update the sport
    $update_sql = "UPDATE sports SET name = '$sportName' WHERE sport_id = $sportId";

    if (mysqli_query($conn, $update_sql)) {
        session_start();
        $_SESSION['update'] = "Sport updated successfully.";
        $_SESSION['update_type'] = "success";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        session_start();
        $_SESSION['update'] = "Failed to update sport. Please try again.";
        $_SESSION['update_type'] = "error";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    echo "Form submission error!";
}
?>
