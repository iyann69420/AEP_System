<?php
ob_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "qrcode";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) die("Connection failed: " . $mysqli->connect_error);

if (isset($_GET['id'])) {
    $recordId = $_GET['id'];
    $selectSql = "SELECT id, name, Time, time_out FROM unitlogs2 WHERE id = $recordId";
    $result = $mysqli->query($selectSql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $unitNumber = $row['name'];
        $timeIn = $row['Time'];
        $timeOut = $row['time_out'];
    } else {
        echo "Error: Record not found.";
        exit();
    }
} else {
    echo "Error: Record ID not provided.";
    exit();
}

// Handle Time In, Time Out, and Update Record buttons
if (isset($_POST['time_in_button'])) {
    $updateSql = "UPDATE unitlogs2 SET Time = '0000-00-00 00:00:00' WHERE id = $recordId";
    $mysqli->query($updateSql);
    echo "Time In record updated successfully";
    exit();
}

if (isset($_POST['time_out_button'])) {
    $updateSql = "UPDATE unitlogs2 SET time_out = '0000-00-00 00:00:00' WHERE id = $recordId";
    $mysqli->query($updateSql);
    echo "Time Out record updated successfully";
    exit();
}

if (isset($_POST['update'])) {
    $unitNumber = $_POST['unit_number'];
    $timeIn = $_POST['time_in'];
    $timeOut = $_POST['time_out'];

    $updateSql = "UPDATE unitlogs2 SET name = '$unitNumber', Time = '$timeIn', time_out = '$timeOut' WHERE id = $recordId";

    if ($mysqli->query($updateSql) === TRUE) {
        // Display alert message using JavaScript
        echo '<script>alert("Record updated successfully");</script>';
        
        // Redirect using JavaScript after the alert is shown
        echo '<script>window.location.href = "/TRACK-WISE/admin2/pages/unitlogs2.php";</script>';
        exit();
    } else {
        echo "Error updating record: " . $mysqli->error;
        exit();
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
   body {
    margin: 0; /* Remove default body margin */
}

.container-fluid {
    position: relative;
    bottom:-200px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh; /* Ensure the container takes at least the full viewport height */
    margin: 0; /* Remove any margin */
}


form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    margin-top: -700px; /* Adjust the margin-top as needed */
}

label {
    display: block;
    margin-bottom: 8px;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
}

button {
    background-color: #00C1FE;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #808080;
}
.update-button {
    background-color: #008000;
    color: #fff;
    padding: 10px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

update-button:hover {
    background-color: #008000;
}

.logout-button {
    background-color: #dc3545;
    color: #fff;
    padding: 10px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

logout-button:hover {
    background-color: #008000;
}
    </style>
</head>
<body class="bg-content">
    <main class="dashboard">
        <?php include "component/sidebar.php"; ?>
        <div class="container-fluid">
            <form method="post">
                <label for="unit_number">Unit Number:</label>
                <input type="text" id="unit_number" name="unit_number" value="<?php echo $unitNumber; ?>" required>

                <label for="time_in">Time In:</label>
                <input type="text" id="time_in" name="time_in" value="<?php echo $timeIn; ?>" required>

                <label for="time_out">Time Out:</label>
                <input type="text" id="time_out" name="time_out" value="<?php echo $timeOut; ?>" required>

         
                
                <button type="submit" name="update">Update Record</button>
                <button type="button" class="update-button" >Time In</button>
			<button type="button" class="logout-button" >Time Out</button>
                <br>
                <br>
                <a href="unitlogs2.php"><button type="button">Back</button></a> 
            </form>
        </div>
    </main>
    <script src="../js/script.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>

    <!-- JavaScript function to copy the formatted time -->
    <script>
        function copyFormattedTime() {
            var formattedTimeField = document.getElementById("formatted_time");
            formattedTimeField.select();
            document.execCommand("copy");
            alert("Formatted time copied to clipboard: " + formattedTimeField.value);
        }
    </script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector(".update-button").addEventListener("click", function () {
            document.getElementById("time_in").value = "0000-00-00 00:00:00";
            updateTime('time_in_button');
        });

        document.querySelector(".logout-button").addEventListener("click", function () {
            document.getElementById("time_out").value = "0000-00-00 00:00:00";
            updateTime('time_out_button');
        });

        function updateTime(buttonType) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", window.location.href, true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var data = buttonType + "=1";

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText); // Display the response from the server
					window.location.href = "/TRACK-WISE/admin2/pages/unitlogs2.php"; // Redirect after updating
                }
            };

            xhr.send(data);
        }
    });
	
</script>
</body>

</html>

