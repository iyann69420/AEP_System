<?php
    include_once("header.php");
    include_once("navbar.php");
?>

<html>

<head>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('downloadTableImage').addEventListener('click', function () {
                html2canvas(document.querySelector('#scheduleTable')).then(function (canvas) {
                    var link = document.createElement("a");
                    document.body.appendChild(link);
                    link.download = 'table_image.png';
                    link.href = canvas.toDataURL();
                    link.target = '_blank';
                    link.click();
                    document.body.removeChild(link);
                });
            });
        });
    </script>
</head>

<body>
    <br>
    <div align="center">
        <fieldset>
            <legend>Schedule</legend>
            <div class='container'>
                <table id='scheduleTable' class='table table-bordered' border='1'>
                    <tr>
                        <th>Faculty</th>
                        <th>Course</th>
                        <th>Subject</th>
                        <th>Room</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    // your database connection
                    $host = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "qrcode";

                    // select database
                    mysql_connect($host, $username, $password) or die(mysql_error());
                    mysql_select_db($database) or die(mysql_error());

                    $query = ("SELECT * FROM addtable");
                    $result = mysql_query($query) or die(mysql_error());

                    while ($row = mysql_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['faculty'] . "</td>";
                        echo "<td>" . $row['course'] . "</td>";
                        echo "<td>" . $row['subject'] . "</td>";
                        echo "<td>" . $row['room'] . "</td>";
                        echo "<td>" . $row['start_time'] . "</td>";
                        echo "<td>" . $row['end_time'] . "</td>";
                        echo "<td><form class='form-horizontal' method='post' action='tablelist.php'>
                            <input name='id' type='hidden' value='" . $row['id'] . "';>
                            <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
                            </form></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </fieldset>
    </div>

    <div align="center">
        <br>
        <a href="#" id="downloadTableImage" class='btn btn-warning'>Download Table Image</a>
        <a href="home.php" class='btn btn-success'>New</a>
        <a href="http://localhost/track-wise/student2/pages/dashboard.php" class='btn btn-primary'>Back</a>
    </div>

    <?php
    // delete record
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        echo '<script type="text/javascript">
                      alert("Schedule Successfully Deleted");
                         location="tablelist.php";
                           </script>';
    }
    if (isset($_POST['id'])) {
        $id = mysql_real_escape_string($_POST['id']);
        $sql = mysql_query("DELETE FROM addtable WHERE id='$id'");
        if (!$sql) {
            echo ("Could not delete rows" . mysql_error());
        }
    }
    ?>

</body>

</html>

<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "footer.php";
    include_once("footer.php");
?>
