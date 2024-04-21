<?php
include('../../connection/constants.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userRole = $_POST["userRole"];

   
    $check_sql = "SELECT * FROM admin WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        session_start();
        $_SESSION['add'] = "Admin already exists.";
        $_SESSION['add_type'] = "error";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }




    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql_admin = "INSERT INTO admin (fullname, username, password, userrole) VALUES ('$fullname', '$username', '$hashed_password', '$userRole')";

    if (mysqli_query($conn, $sql_admin)) {
        session_start();
        $_SESSION['add'] = "Admin account added successfully.";
        $_SESSION['add_type'] = "success";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        session_start();
        $_SESSION['add'] = "Failed to add Admin account. Please try again.";
        $_SESSION['add_type'] = "error";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    echo "Form submission error!";
}
?>
