<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('../admin/db_connect.php');
ob_start();
$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
foreach ($query as $key => $value) {
    if (!is_numeric($key))
        $_SESSION['system'][$key] = $value;
}
ob_end_flush();
include('../header.php');

?>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Bungee+Spice&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <style>
        header.masthead {
            background-image: url('../logbg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        body {
    background-image: url('../logbg.jpg'); !important;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center; /* Center vertically and horizontally */
    height: 100vh;
    font-family: "Roboto Slab", serif;
}

.form-container {
    position: relative;
    max-width: 500px;
    padding: 20px;
    background-color: rgba(128, 128, 128, 0.4); /* Change the background color to gray */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    color: white; /* Set text color to white */
}

        .form-group {
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .col {
            flex: 1;
            margin-right: 10px;
            /* Adjust margin as needed */
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            height: 30px;
            padding-left: 1px;
            /* Fixed height for consistency */
        }

        /* Confirm button styles */
        .confirm-btn {
            background-color: transparent; /* Make button transparent */
            color: #007bff;
            border: 1px solid #007bff;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .confirm-btn:hover {
            background-color: #007bff;
            color: #fff; /* Change text color on hover */
        }

        /* Cancel button styles */
        .cancel-btn {
            background-color: transparent;
            color: #dc3545;
            border: 1px solid #dc3545;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cancel-btn:hover {
            background-color: #a71d2a;
        }

        @media only screen and (max-width: 600px) {
            /* Adjustments for mobile devices */
            .form-container {
                width: 90%;
                padding: 10px;
            }

            .row {
                flex-direction: column;
            }

            .col {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .confirm-btn,
            .cancel-btn {
                position: static;
                margin-top: 20px;
            }
        }

        .title {
    font-family: "Bebas Neue", sans-serif;
    text-align: center;
    margin-bottom: 20px;
    color: lightgreen; /* Add this line to set the color */
}


    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="form-container">
        <h2 class="title" style="color: lightgreen;">Add Reservation</h2>

            <form action="" id="manage-book">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <input type="hidden" name="venue_id" value="<?php echo isset($_GET['venue_id']) ? $_GET['venue_id'] : '' ?>">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="" class="control-label">User Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
                        </div>
                        <div class="col">
                            <label for="" class="control-label">Table Number</label>
                            <textarea cols="30" rows="2" required="" name="address" class="form-control"><?php echo isset($address) ? $address : '' ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="" class="control-label">Sports</label>
                            <input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
                        </div>
                        <div class="col">
                            <label for="" class="control-label">Date and time</label>
                            <input type="text" class="form-control datetimepicker" name="schedule" value="<?php echo isset($schedule) ? $schedule : '' ?>" required>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Confirm button inside the form-container -->
            <button type="submit" form="manage-book" class="confirm-btn">Confirm</button>
            <!-- Cancel button inside the form-container -->
            <button type="button" class="cancel-btn">Cancel</button>
        </div>
    </div>

    <script>
        $('.datetimepicker').datetimepicker({
            format: 'Y/m/d H:i',
            startDate: '+3d'
        })
        $('#manage-book').submit(function(e) {
            e.preventDefault()
            start_load()
            $('#msg').html('')
            $.ajax({
                url: 'admin/ajax.php?action=save_book',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("book Request Sent.", 'success')
                        end_load()
                        uni_modal("", "book_msg.php")

                    }
                }
            })
        })
    </script>
</body>

</html>
