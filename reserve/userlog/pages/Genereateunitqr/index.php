<?php
$f = "visit.php";
if (!file_exists($f)) {
    touch($f);
    $handle = fopen($f, "w");
    fwrite($handle, 0);
    fclose($handle);
}

include('libs/phpqrcode/qrlib.php');

function getUsernameFromEmail($email)
{
    $find = '@';
    $pos = strpos($email, $find);
    $username = substr($email, 0, $pos);
    return $username;
}

if (isset($_POST['submit'])) {
    $tempDir = 'temp/';
    $email = $_POST['mail'];


    $filename = $_POST['mail'];
    $body = isset($_POST['msg']) ? $_POST['msg'] : '';
    $codeContents = '' . $email . '' .  '&body=' . urlencode($body);
    QRcode::png($codeContents, $tempDir . '' . $filename . '.png', QR_ECLEVEL_L, 5);
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qrcode";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $body variable
$body = isset($_POST['msg']) ? $_POST['msg'] : '';

if (isset($_POST['submit'])) {
    // Get input data
    $email = $_POST['mail'];

    // Insert data into the database
    $sql = "INSERT INTO units (unit_number, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $email, $email, $body);

        if ($stmt->execute()) {
            // Display alert, wait for a moment, then go back
            
        } else {
            echo "Error executing SQL statement: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing SQL statement: " . $conn->error;
    }
}

// Close the database connection
$conn->close();

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>




<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Generate Unit QR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href ="\TRACK-WISE/asset/icon.png" type = "image/x-icon">
    <link rel="icon" href="img/favicon.icon" type="image/png">
    <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/style.css">
    <script src="libs/navbarclock.js"></script>
     <style>
        /* Your responsive CSS rules go here */
        body {
            font-size: 16px; /* Default font size for larger screens */
        }

        .myoutput {
            max-width: 600px; /* Set a maximum width for the container */
            margin: 0 auto; /* Center the container */
            padding: 10px;
        }

        .input-field {
            text-align: center;
        }

        .form-control,
        select {
            width: 100%;
            box-sizing: border-box; /* Include padding and border in width calculation */
        }

        .form-group {
            margin-bottom: 15px;
        }

        @media (min-width: 768px) {
            .myoutput {
                max-width: 800px; /* Adjust the maximum width for larger screens if needed */
            }
        }

        @media (max-width: 768px) {
            body {
                font-size: 14px; /* Adjust the font size for small screens */
            }
            .form-control {
                width: 100%;
            }
            .submitBtn {
                width: 100%;
            }
            .myoutput {
                width: 100%;
                display: block; /* Change the display to block for stacking */
            }
            .qr-field {
                margin-top: 20px; /* Add margin to move QR field down */
            }
        }

        .form-control {
            width: 20em;
        }

        .submitBtn {
            width: 20em;
        }

        .qrframe img {
            max-width: 100%;
            height: auto;
        }
         .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 10px;
    }

    .form-group label {
        text-align: center;
    }

    .form-control {
        width: 20em;
    }

    @media (max-width: 767px) {
            .form-control, select {
                width: 100%;
            }
        }
    </style>

</head>

<body onload="startTime()">
    <div class="background-container">
        <div class="background-animation">
        </div>
        <div> 
            <nav class="navbar-inverse" role="navigation">
                <div id="clockdate">
                    <div class="clockdate-wrapper">
                        <div id="clock"></div>
                        <div id="date"><?php echo date('l, F j, Y'); ?></div>
                    </div>
                </div>
                <div class="dllink" style="text-align:right; margin:-100px 0px 120px 0px;"></div>
                <button class="btnn"><a href="/TRACK-WISE/Admin2/pages/dashboard.php">Back</a></button>
            </div>
            </nav>
            <div class="myoutput">
                <div class="input-field">
                    <center><h3>Please Fill-out All Fields<br><br>Generate Unit QR</h3></center>
                    <form method="post" action="">
                        <div class="form-group">
                            <label>Unit Number</label>
                            <input type="text" class="form-control" name="mail" style="width:20em;" placeholder="Enter Unit Number ex:UNIT1" value="<?php echo isset($email) ? $email : ''; ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submitBtn"  class="btn btn-primary submitBtn" style="width:20em; margin:0;">
                        </div>
                    </form>
                    <center><button id="showQrBtn" class="btn btn-primary submitBtn" style="width: 20em; margin: 10px 0;">Show QR Code</button></center>
                </div>
            </div>

            <?php
            if (!isset($filename)) {
                $filename = "author";
            }
            ?>

          <div id="qrModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="qr-frame">
            <h2 style="text-align: center;">QR Code Result:</h2>
            <div class="qrframe">
                <?php echo '<img alt="Displaying QR After Submit" src="temp/' . @$filename . '.png" style="width:200px; height:200px; font-size:23px; bottom:20px"><br>'; ?>
            </div>
            <a class="btn btn-primary submitBtn" style="width: 210px; margin: 5px 0;" href="download.php?file=<?php echo $filename; ?>.png">Download QR Code</a>
        </div>
    </div>
</div>

            <script>
                const modal = document.getElementById('qrModal');
                const showQrBtn = document.getElementById('showQrBtn');
                const closeBtn = document.getElementsByClassName('close')[0];

                showQrBtn.onclick = function() {
                    modal.style.display = 'block';
                };

                closeBtn.onclick = function() {
                    modal.style.display = 'none';
                };

                window.onclick = function(event) {
                    if (event.target === modal) {
                        modal.style.display = 'none';
                    }
                };
            </script>
        </div>
		<style>
    /* Your existing styles */

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        max-width: 400px;
        text-align: center;
    }

    .close {
        color: darkred;
        float: right;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: darkred;
        text-decoration: none;
        cursor: pointer;
    }

    @media (max-width: 400px) {
        .modal-content {
            max-width: 95%;
        }
    }
</style>

    </body>
</html>
