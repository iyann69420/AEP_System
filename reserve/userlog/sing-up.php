<?php
if (isset($_POST['submit'])) {
    include './pages/conixion.php'; // Include your database connection script

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $conPassword = $_POST['conPass'];

    if ($password == $conPassword) {
        // Passwords match; you can proceed with database insert
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security

        // Perform database insert (replace 'your_table_name' with your actual table name)
        $sql = "INSERT INTO adminlogs (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            // Registration successful; you can redirect or display a success message
            header('Location: registration_success.php'); // Replace with your success page
        } else {
            // Registration failed; you can handle the error
            header('Location: index.php?error=registration_failed'); // Redirect to registration page with an error message
        }
    } else {
        // Passwords do not match; you can handle the error
        header('Location: index.php?error=passwords_do_not_match'); // Redirect to registration page with an error message
    }
}
?>
