<?php
ob_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "qrcode";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) die("Connection failed: " . $mysqli->connect_error);

function moveToRestoreTable($recordId, $mysqli) {
    $recordId = $mysqli->real_escape_string($recordId);

    $result = $mysqli->query("SELECT * FROM unitlogs WHERE id = '$recordId'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $insertQuery = "INSERT INTO 302restore (name, Time, time_out, First_Name, student_number, section, Last_Name, year) VALUES ('{$row['name']}', '{$row['Time']}', '{$row['time_out']}', '{$row['First_Name']}', '{$row['student_number']}', '{$row['section']}', '{$row['Last_Name']}', '{$row['year']}')";
        $mysqli->query($insertQuery);
    }
}

function deleteRecord($recordId, $mysqli) {
    $recordId = $mysqli->real_escape_string($recordId);
    $mysqli->query("DELETE FROM unitlogs WHERE id = '$recordId'");
    echo '<script>alert("Delete record sucessfully");</script>';
}

function logoutAllRecords($mysqli) {
    $result = $mysqli->query("UPDATE unitlogs SET time_out = NOW() WHERE time_out = '0000-00-00 00:00:00'");

    if ($result && $mysqli->affected_rows > 0) {
        echo '<script>alert("Records logged out successfully");</script>';
    } else {
        echo '<script>alert("All records are already logged out");</script>';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirmed']) && $_POST['confirmed'] == 1) {
        if (isset($_POST['record_id']) && !empty($_POST['record_id'])) {
            deleteRecord($_POST['record_id'], $mysqli);
        } else {
            logoutAllRecords($mysqli);
        }
    }
}

$sql = "SELECT id, First_Name, Last_Name, section,year, student_number, name, Time, time_out FROM unitlogs ORDER BY name DESC";
$result = $mysqli->query($sql);

if ($result) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href ="\TRACK-WISE/asset/icon.png" type = "image/x-icon">
    <title>Unit Log 302</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/style.css">
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; }
        .dashboard { display: flex; min-height: 100vh; }
        .container-fluid { padding: 20px; }
        table { border-collapse: collapse; width: 100%; overflow-x: auto; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 15px; text-align: left; }
        th { background-color: #007bff; color: white; border-bottom: 2px solid #dee2e6; }
        td { border-bottom: 1px solid #dee2e6; }
        tr:hover { background-color: #f5f5f5; }
        .update-button, .delete-button, .logout-button { display: inline-block; padding: 8px 16px; margin: 4px; border-radius: 5px; cursor: pointer; text-align: center; transition: background-color 0.3s; }
        .update-button { background-color: #008000; color:#fff; border: 1px solid #008000; }
        .logout-button { background-color: #dc3545; color: #FFFFFF; border: 1px solid #dc3545; }
        .delete-button { background-color:#922B21; color: #FFFFFF; border: 1px solid #939393; }
        .update-button:hover { background-color:#1E8449; color:#fff; text-decoration:none; }
        .delete-button:hover{background-color:#641E16; color:#fff; text-decoration:none;}
        .logout-button:hover {background-color:#EC7063; color:#fff; text-decoration:none;}
        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }
        .logout-all-button, .clear-all-button, .archive-all-button, .print-button, .back-button {
            padding: 10px 20px;
            margin-left: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-all-button { background-color: #dc3545; color: #fff; border: 1px solid black; }
        .clear-all-button { background-color: #007bff; color: #fff; border: 1px solid black; }
		.archive-all-button { background-color: #007bff; color: #fff; border: 1px solid black; }
        .print-button { background-color: #007bff; color: #fff; border: 1px solid black; }
        .back-button { background-color: #007bff; color: #fff; border: 1px solid black; }
        .logout-all-button:hover, .clear-all-button:hover, .archive-all-button:hover, .print-button:hover, 
		.back-button:hover { background-color: #808080; color: #fff; border: 1px solid #808080;}
		  h1 {
        text-align: left;
    }
	
.title-container {
    position: fixed;
    top: 20px; /* Adjust the top position as needed */
    left: 20px; /* Adjust the left position as needed */
    z-index: 1;
    background-color: #007bff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(1, 1, 1, 1.1);
	border: 1px solid black;
}

h1 {
    margin: 0;
    font-size: 24px;
    font-weight: bold;
    text-align: left;
 color: #fff;
}
.title-container:hover { background-color: #808080; color: #fff; border: 1px solid #808080;}


		 
    </style>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>


    <script>
        function toggleLogoutDropdown() {
            var dropdownContent = document.querySelector(".logout-dropdown-content");
            dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
        }

        function openCenteredWindow(url) {
            var w = window.innerWidth / 2, h = window.innerHeight / 2, l = window.innerWidth / 4, t = window.innerHeight / 4;
            window.open(url, '_blank', 'width=' + w + ',height=' + h + ',left=' + l + ',top=' + t);
        }

        function confirmDelete(recordId) {
            if (confirm("Are you sure you want to delete this record?")) {
                document.querySelector('form[data-record-id="' + recordId + '"]').submit();
            }
        }
        function confirmLogoutAll() {
            if (confirm("Are you sure you want to logout all records?")) {
                document.getElementById("logout-all-form").submit();
            }
        }
        function showDownloadModal() {
        $('#downloadModal').modal('show');
    }

    function downloadTable(format) {
        $('#downloadModal').modal('hide');
        try {
            var tableElement = document.querySelector('.table-responsive');

            if (!tableElement) {
                throw new Error("Table element not found.");
            }

            if (format === 'pdf') {
                downloadAsPDF(tableElement);
            } else if (format === 'image') {
                downloadAsImage(tableElement);
            }

            // Remove the deleteAllRecords call if it's not necessary for your logic
        } catch (error) {
            console.error("Error during download:", error);
            alert("Error during download. Please try again. Check the console for details.");
        }
    }

    function downloadAsPDF(element) {
        html2canvas(element, { scrollY: -window.scrollY }).then(function (canvas) {
            var pdf = new window.jspdf.jsPDF();
            pdf.addImage(canvas.toDataURL(), 'PNG', 0, 0, canvas.width / 6.7, canvas.height / 4.8);
            pdf.save('table_pdf.pdf');
        });
    }

    function downloadAsImage(element) {
        html2canvas(element, { scrollY: -window.scrollY }).then(function (canvas) {
            var link = document.createElement("a");
            document.body.appendChild(link);
            link.download = 'table_image.png';
            link.href = canvas.toDataURL();
            link.target = '_blank';
            link.click();
            document.body.removeChild(link);
        });
    }
        function deleteAllRecords() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'move_records_to_restore.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                    location.reload();
                }
            };
            xhr.send();
        }

        function goBack() {
            window.location.href = "/TRACK-WISE/faculty2/pages/dashboard.php";
        }

        function confirmLogout(recordId) {
            if (confirm("Are you sure you want to logout this record?")) {
                logoutRecord(recordId);
            }
        }

        function logoutRecord(recordId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'logout_record_302.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                }
            };
            xhr.send('record_id=' + recordId);
        }

        
    </script>
	<script>
  

    function redirectToArchives() {
        window.location.href = "/TRACK-WISE/faculty2/pages/unitsave302.php";
    }

 
</script>

<script>
    function moveTo302Restore() {
        if (confirm("Are you sure you want to move all records to 302restore?")) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'clear_table_302.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                    location.reload();
                }
            };
            xhr.send();
        }
    }
</script>

</head>
<body class="bg-content">
    <main class="dashboard">
        <div class="container-fluid">
            <header>
            
            </header>
            <div class="table-responsive">
                <?php if ($result) { ?>
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
                            <?php while ($row = $result->fetch_assoc()) {
                                $backgroundColor = '';
                                if (
                                    ($row['Time'] !== null && $row['Time'] !== '0000-00-00 00:00:00') ||
                                    ($row['time_out'] !== null && $row['time_out'] !== '0000-00-00 00:00:00')
                                ) {
                                    $backgroundColor = '#d4edda';
                                }
                                if ($row['time_out'] !== null && $row['time_out'] !== '0000-00-00 00:00:00') {
                                    $backgroundColor = '#f8d7da';
                                }
                            ?>
                                <tr style="background-color: <?php echo $backgroundColor; ?>;">
                                    <td><?php echo $row['Last_Name']; ?></td>
                                    <td><?php echo $row['First_Name']; ?></td>
                                    <td><?php echo $row['section']; ?></td>
                                    <td><?php echo $row['year']; ?></td>
                                    <td><?php echo $row['student_number']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['Time']; ?></td>
                                    <td><?php echo $row['time_out']; ?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="update-button" style="color:#fff;">Update</a>
                                        <a href="javascript:void(0);" onclick="confirmLogout(<?php echo $row['id']; ?>)" class="logout-button" style="color:#fff;">Logout</a>
                                        <form method="post" style="display: inline;" data-record-id="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="confirmed" value="1">
                                            <input type="hidden" name="record_id" value="<?php echo $row['id']; ?>">
                                            <button type="button" class="delete-button" onclick="confirmDelete(<?php echo $row['id']; ?>)" style="color:#fff;">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            <div class="button-container">
                                <form method="post" id="logout-all-form" class="d-inline">
								 <div class="title-container">
    <h1>302 Unit Log</h1>
</div>
                                    <input type="hidden" name="confirmed" value="1">
                                    <button type="button" class="logout-all-button" onclick="confirmLogoutAll()">Logout All Records</button>
                                </form>
                   <button type="button" class="clear-all-button" id="clearAllButton" onclick="moveTo302Restore()">Clear Table</button>


								
                                <button type="button" class="print-button" onclick="showDownloadModal()">Print Table</button>

								 <button type="button" class="archive-all-button" onclick="redirectToArchives()">Archives</button>

                                <button type="button" class="back-button" onclick="goBack()">Back</button>
                            </div>
                        </tbody>
                    </table>
                <?php } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                } ?>
            </div>
        </div>
    </main>
    <!-- Add this modal -->
<div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadModalLabel">Choose Download Format</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Select the format you want to download:</p>
                <button type="button" class="btn btn-primary" onclick="downloadTable('pdf')">Download as PDF</button>
                <button type="button" class="btn btn-secondary" onclick="downloadTable('image')">Download as Image</button>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>
<?php
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
$mysqli->close();
?>

