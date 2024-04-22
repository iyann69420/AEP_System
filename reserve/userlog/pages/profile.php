<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbName = "qrcode";

try {
    $con = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}

$fullName = $_SESSION['name'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];

try {
    $selectQuery = "SELECT profile_pictures FROM adminlogs WHERE email = :email";
    $selectStatement = $con->prepare($selectQuery);
    $selectStatement->bindParam(':email', $email);
    $selectStatement->execute();
    $result = $selectStatement->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['profile_pictures']) && !empty($result['profile_pictures'])) {
        $profilePicturePath = $result['profile_pictures'];
    } else {
        $profilePicturePath = 'default_profile_picture.jpg';
    }
} catch (PDOException $e) {
    echo "Error fetching profile picture: " . $e->getMessage();
}

if (isset($_POST['save_picture'])) {
    $uploadDirectory = 'profile_pictures/';
    $uploadedFile = $uploadDirectory . basename($_FILES['profile_picture']['name']);
    $maxFileSize = 2 * 1024 * 1024;

    if ($_FILES['profile_picture']['size'] > $maxFileSize) {
        echo '<script>alert("File size exceeds 2MB limit.");</script>';
    } else {
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadedFile)) {
            try {
                $updateQuery = "UPDATE adminlogs SET profile_pictures = :picture WHERE email = :email";
                $updateStatement = $con->prepare($updateQuery);
                $updateStatement->bindParam(':picture', $uploadedFile);
                $updateStatement->bindParam(':email', $email);
                $updateStatement->execute();

                $_SESSION['profile_picture'] = $uploadedFile;

                echo '<script>alert("Profile picture saved successfully.");</script>';
            } catch (PDOException $e) {
                echo "Profile picture save failed: " . $e->getMessage();
            }
        } else {
            echo '<script>alert("Failed to upload profile picture.");</script>';
        }
    }
}

if (isset($_POST['update_profile'])) {
    $newFullName = $_POST['new_name'];
    $newEmail = $_POST['new_email'];
    $newPassword = $_POST['new_password'];

    try {
        $updateQuery = "UPDATE adminlogs SET full_name = :newFullName, email = :newEmail, password = :newPassword WHERE email = :email";
        $updateStatement = $con->prepare($updateQuery);
        $updateStatement->bindParam(':newFullName', $newFullName);
        $updateStatement->bindParam(':newEmail', $newEmail);
        $updateStatement->bindParam(':newPassword', $newPassword);
        $updateStatement->bindParam(':email', $email);
        $updateStatement->execute();

        $_SESSION['name'] = $newFullName;
        $_SESSION['email'] = $newEmail;
        $_SESSION['password'] = $newPassword;

        echo '<script>alert("Profile updated successfully.");</script>';
    } catch (PDOException $e) {
        echo "Update failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #333;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #fff;
}

    .container {
            text-align: center;
            background-color: #444;
            padding: 10px;
            padding-left: 100px;
            padding-right: 100px;
	
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }


h1 {
    color: #4CAF50;
    font-size: 24px; /* Reduced font size */
}

p {
    color: #ccc;
    font-size: 16px; /* Reduced font size */
}

img {
    width: 120px; /* Reduced image size */
    height: 120px; /* Reduced image size */
    object-fit: cover;
    border: 2px solid #4CAF50;
    border-radius: 50%;
    margin: 10px 0;
}

label {
    color: #4CAF50;
    font-weight: bold;
}

input[type="file"] {
    display: none;
}

button {
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 8px 16px; /* Reduced padding */
    cursor: pointer;
    margin-top: 10px;
    border-radius: 5px;
    font-size: 14px; /* Reduced font size */
}

button:hover {
    background-color: #45a049;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Profile</h1>
        <p>Welcome, <?php echo $fullName; ?>!</p>
        <p>Email: <?php echo $email; ?></p>

        <form method="post" action="" enctype="multipart/form-data">
            <label for="profile_picture"> Click to Insert Picture:</label>
            <?php echo '<img id="profile_image" src="' . $profilePicturePath . '?v=' . time() . '" alt="Profile Picture">'; ?>
            <input type="file" id="profile_picture" name="profile_picture">
            <button type="submit" name="save_picture">Save Picture</button>
        </form>

        <!-- Update Profile Form -->
        <form method="post" action="" enctype="multipart/form-data">
            <label for="new_name">New Full Name:</label>
            <input type="text" id="new_name" name="new_name" placeholder="Enter new full name" required>

            <label for="new_email">New Email:</label>
            <input type="text" id="new_email" name="new_email" placeholder="Enter new email" required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>

            <button type="submit" name="update_profile">Update Profile</button>
            <button type="button" onclick="goBack()">Back</button>
        </form>
    </div>

    <script>
        function goBack() {
            window.location.href = "/track-wise/admin2/pages/dashboard.php";
        }
    </script>
</body>
</html>
