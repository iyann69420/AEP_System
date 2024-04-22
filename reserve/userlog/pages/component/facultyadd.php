<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qrcode";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];  // Add the password field
    $time_in = $_POST['time_in'];
    $time_out = $_POST['time_out'];

    // Check if the email already exists
    $check_sql = "SELECT id FROM facultylogs WHERE email = '$email'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "Error: Email already exists";
    } else {
        // Insert the record if the email doesn't exist
        $insert_sql = "INSERT INTO facultylogs (full_name, email, password, time_in, time_out) VALUES ('$full_name', '$email', '$password', '$time_in', '$time_out')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "Record added successfully";
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>



<div class="button-add-faculty">
    <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add Faculty</button>-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="facultylogs.php" enctype="multipart/form-data">
                        <div class="">
                            <label for="recipient-name" class="col-form-label">Full Name:</label>
                            <input type="text" class="form-control" id="recipient-name" name="full_name">
                        </div>
                        <div class="">
                            <label for="recipient-email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="recipient-email" name="email">
                        </div>
			
<div class="">
    <label for="recipient-password" class="col-form-label">Password:</label>
    <input type="password" class="form-control" id="recipient-password" name="password">
</div>

                        <div class="">
                            <label for="recipient-timein" class="col-form-label">Time In:</label>
                            <input type="text" class="form-control" id="recipient-timein" name="time_in">
                        </div>
                        <div class="">
                            <label for="recipient-timeout" class="col-form-label">Time Out:</label>
                            <input type="text" class="form-control" id="recipient-timeout" name="time_out">
                        </div>
                        <!-- Assuming "password" is part of your database structure -->
                       
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Add Faculty</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
