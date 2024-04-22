<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Students&Faculty Logs</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        .container-fluid {
            padding: 20px;
        }

        h2 {
            margin-bottom: 10px;
            color: #343a40;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        @media screen and (max-width: 600px) {
            table {
                overflow-x: auto;
                display: block;
            }

            th, td {
                white-space: nowrap;
            }
        }
    </style>
</head>

<body class="bg-content">
    <main class="dashboard d-flex">
        <!-- start sidebar -->
        <?php include "component/sidebar.php"; ?>
        <!-- end sidebar -->

        <!-- start content page -->
        <div class="container-fluid px-4">
            <?php 
              
        
                $facultyHost = "localhost";
                $facultyUsername = "root";
                $facultyPassword = "";
                $facultyDatabase = "qrcode";
                $facultyConn = new mysqli($facultyHost, $facultyUsername, $facultyPassword, $facultyDatabase);
                if ($facultyConn->connect_error) {
                    die("Connection failed: " . $facultyConn->connect_error);
                }

                $facultySql = "SELECT full_name, time_in, time_out FROM facultylogs";
                $facultyResult = $facultyConn->query($facultySql);

                if ($facultyResult->num_rows > 0) {
                    echo "<h2>Faculty</h2>";
                    echo "<table>
                            <tr>
                                <th>Full Name</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Action</th>
                            </tr>";

                    while ($row = $facultyResult->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["full_name"] . "</td>
                                <td>" . $row["time_in"] . "</td>
                                <td>" . $row["time_out"] . "</td>
                                <td>
                                    <a href='#'><i class='far fa-edit'></i></a>
                                    <a href='#'><i class='far fa-trash-alt'></i></a>
                                </td>
                            </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p>0 results for Faculty Logs</p>";
                }

                $facultyConn->close();

                $logsHost = "localhost";
                $logsUsername = "root";
                $logsPassword = "";
                $logsDatabase = "qrcode";
                $logsConn = new mysqli($logsHost, $logsUsername, $logsPassword, $logsDatabase);

                if ($logsConn->connect_error) {
                    die("Connection failed: " . $logsConn->connect_error);
                }

                $logsSql = "SELECT name, Time, time_out FROM logs";
                $logsResult = $logsConn->query($logsSql);

                if ($logsResult->num_rows > 0) {
                    echo "<h2>Room 302</h2>";
                    echo "<table>
                            <tr>
                                <th>Name</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Action</th>
                            </tr>";

                    while ($row = $logsResult->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["name"] . "</td>
                                <td>" . $row["Time"] . "</td>
                                <td>" . $row["time_out"] . "</td>
                                <td>
                                    <a href='#'><i class='far fa-edit'></i></a>
                                    <a href='#'><i class='far fa-trash-alt'></i></a>
                                </td>
                            </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p>0 results for Logs</p>";
                }

                $logsConn->close();

                $logsHost = "localhost";
                $logsUsername = "root";
                $logsPassword = "";
                $logsDatabase = "qrcode";
                $logsConn = new mysqli($logsHost, $logsUsername, $logsPassword, $logsDatabase);

                if ($logsConn->connect_error) {
                    die("Connection failed: " . $logsConn->connect_error);
                }

                $logsSql = "SELECT name, Time, time_out FROM logs_lab2";
                $logsResult = $logsConn->query($logsSql);

                if ($logsResult->num_rows > 0) {
                    echo "<h2>Room 303</h2>";
                    echo "<table>
                            <tr>
                                <th>Name</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Action</th>
                            </tr>";

                    while ($row = $logsResult->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["name"] . "</td>
                                <td>" . $row["Time"] . "</td>
                                <td>" . $row["time_out"] . "</td>
                                <td>
                                    <a href='#'><i class='far fa-edit'></i></a>
                                    <a href='#'><i class='far fa-trash-alt'></i></a>
                                </td>
                            </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p>0 results for Logs</p>";
                }

                $logsConn->close();
            ?>
            <script src="../js/script.js"></script>
            <script src="../js/bootstrap.bundle.js"></script>
        </body>

    </html>
