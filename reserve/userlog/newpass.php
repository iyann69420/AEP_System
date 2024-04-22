<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "qrcode";

if (isset($_POST['submit'])) {
    try {
        $con = new PDO("mysql:host=$hostName;dbname=$dbName", $dbUser, $dbPassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = $_POST['username'];
        $email = $_POST['email'];

        $requete = "SELECT * FROM adminlogs WHERE full_name = :username AND email = :email";
        $statment = $con->prepare($requete);
        $statment->bindParam(':username', $username);
        $statment->bindParam(':email', $email);
        $statment->execute();
        $result = $statment->fetch();

        if ($result !== false) {
            // Redirect to a new page or perform any other actions here
            echo $result['full_name'];
            echo $result['email'];
        } else {
            // Handle case when no matching data is found
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
