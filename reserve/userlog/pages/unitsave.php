<?php
ob_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "qrcode";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

function deleteRecord($table, $id) {
    global $mysqli;
    $sql = "DELETE FROM $table WHERE id = $id";
    return $mysqli->query($sql);
}

if (isset($_POST['delete302'])) {
    $id = $_POST['delete302'];
    deleteRecord("302restore", $id);
}

if (isset($_POST['delete303'])) {
    $id = $_POST['delete303'];
    deleteRecord("303restore", $id);
}

$sql302 = "SELECT '302restore' as table_name, id, Last_Name, First_Name, section, year, student_number, name, Time, time_out FROM 302restore";
$result302 = $mysqli->query($sql302);

$sql303 = "SELECT '303restore' as table_name, id, Last_Name, First_Name, section, year, student_number, name, Time, time_out FROM 303restore";
$result303 = $mysqli->query($sql303);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin list</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .container-fluid {
            padding: 20px;
            margin: auto;
            width: 80%;
		  margin-top: 20px;
			  
        }

        .table-responsive {
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            overflow-x: auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
            border-bottom: 2px solid #dee2e6;
        }

        td {
            border-bottom: 1px solid #dee2e6;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        h1, h2 {
            color: #007bff;
        }

        .operation-buttons a {
            margin-right: 10px;
        }
		 .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-container button {
            flex: 0 0 48%; /* Adjust the width as needed */
        }
		.action-button {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        background-color: #dc3545;
        color: white;
        border: 1px solid #dc3545;
        border-radius: 5px;
        cursor: pointer;
    }

    .action-button:hover {
        background-color: #808080;
        border-color: #808080;
    }
	.back-button {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        background-color: #007bff;;
        color: white;
        border: 1px solid #007bff;;
        border-radius: 5px;
        cursor: pointer;
    }

    .back-button:hover {
        background-color: #808080;
        border-color: #808080;
    }
    </style>
</head>

<body class="bg-content">
    <main class="dashboard d-flex">
        <div class="container-fluid">
           

            <!-- 302restore Table -->
            <h2>302 Save Records</h2>
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>Student No</th>
                            <th>Unit number</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result302->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['Last_Name']; ?></td>
                                <td><?php echo $row['First_Name']; ?></td>
                                <td><?php echo $row['section']; ?></td>
                                <td><?php echo $row['year']; ?></td>
                                <td><?php echo $row['student_number']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['Time']; ?></td>
                                <td><?php echo $row['time_out']; ?></td>
                                <td class="operation-buttons">
                                    <form method="post" action="">
                                        <input type="hidden" name="delete302" value="<?php echo $row['id']; ?>">
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- 303restore Table -->
            <h2 class="mt-4 mb-4">303 Save Records</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>Student No</th>
                            <th>Unit number</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result303->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['Last_Name']; ?></td>
                                <td><?php echo $row['First_Name']; ?></td>
                                <td><?php echo $row['section']; ?></td>
                                <td><?php echo $row['year']; ?></td>
                                <td><?php echo $row['student_number']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['Time']; ?></td>
                                <td><?php echo $row['time_out']; ?></td>
                                <td class="operation-buttons">
                                    <form method="post" action="">
                                        <input type="hidden" name="delete303" value="<?php echo $row['id']; ?>">
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
			<div class="btn-container">
    
    <form method="post" action="">
        <input type="submit" name="deleteAllRecords" class="action-button" value="Delete All Records">
    </form>
	<a href="/TRACK-WISE/Admin2/pages/dashboard.php" class="back-button">Back</a>
</div>
            </div>
        </div>
    </main>
    <script src="../js/script.js"></script>
	
	
</body>

</html>

<?php
if (isset($_POST['deleteAllRecords'])) {
    deleteAllRecords("302restore");
    deleteAllRecords("303restore");
}

function deleteAllRecords($table) {
    global $mysqli;
    $sql = "TRUNCATE TABLE $table";
    return $mysqli->query($sql);
}
?>
