<?php
session_start(); // Start the session at the beginning

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "qrcode";

if (isset($_POST['submit'])) {
    try {
        $con = new PDO("mysql:host=$hostName;dbname=$dbName", $dbUser, $dbPassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_POST['email'];
        $password = $_POST['pass'];

        $maxLoginAttempts = 3; // Maximum allowed login attempts
        $loginAttempts = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] : 0;

        if ($loginAttempts >= $maxLoginAttempts) {
            echo '<script>alert("Login attempts exceeded. Please try again later.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
            exit; // Stop execution if max attempts reached
        } else {
            $requete = "SELECT * FROM adminlogs WHERE email = :email AND password = :password";
            $statment = $con->prepare($requete);
            $statment->bindParam(':email', $email);
            $statment->bindParam(':password', $password);
            $statment->execute();
            $result = $statment->fetch();

            if ($result !== false) {
                // Update the login time
                $updateTimeQuery = "UPDATE adminlogs SET time_in = NOW() WHERE email = :email";
                $updateTimeStatement = $con->prepare($updateTimeQuery);
                $updateTimeStatement->bindParam(':email', $email);
                $updateTimeStatement->execute();

                $_SESSION['name'] = $result['full_name'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['password'] = $result['password'];

                if (isset($_POST['check'])) {
                    setcookie('email', $_SESSION['email'], time() + 3600);
                    setcookie('password', $_SESSION['password'], time() + 3600);
                }

                // Reset login attempts on successful login
                unset($_SESSION['login_attempts']);

                echo '<script>alert("Login successful.");</script>';
                echo '<script>window.location.href = "http://localhost/reserve/index.php";</script>';
                exit; // Stop execution after JavaScript redirect
            } elseif (empty($email) || empty($password)) {
                echo '<script>alert("Please enter your email or password.");</script>';
                echo '<script>window.location.href = "index.php";</script>';
                exit; // Stop execution after JavaScript redirect
            } else {
                // Increment login attempts
                $_SESSION['login_attempts'] = $loginAttempts + 1;
                $attemptsLeft = $maxLoginAttempts - $loginAttempts;
                echo "<script>alert('Invalid login. $attemptsLeft attempts left.');</script>";
                echo '<script>window.location.href = "index.php";</script>';
                exit; // Stop execution after JavaScript redirect
            }
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
