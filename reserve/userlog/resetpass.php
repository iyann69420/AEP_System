<?php
if (isset($_POST['submit'])) {
    include './pages/conixion.php';

    // Check if 'username' and 'email' are set in $_POST
    if (isset($_POST['username']) && isset($_POST['email'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];

        $query = "SELECT * FROM adminlogs WHERE full_name = :username AND email = :email";
        $statement = $con->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $result = $statement->fetch();

        if ($result) {
            // Username and email match a user in the adminlogs table
            // You can now implement the logic to reset the user's password
            // For example, you can redirect to a password reset page with the user's details
            // header("location: newpass.php?username=" . $result['full_name'] . "&email=" . $result['email']);
            // Alternatively, you can display the user's information
            echo "User found: " . $result['full_name'] . " - " . $result['email'];
        } else {
            // User not found
            // Handle the case where the provided username and email do not match
            // You can show an error message or take other actions
            echo "User not found";
        }
    } else {
        // Handle the case where 'username' or 'email' are not set in $_POST
        echo "Please enter both username and email.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body class="container d-flex justify-content-center align-items-center">
    <form method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Enter username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Enter Email</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="email">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Reset Password</button>
    </form>
</body>
</html>
