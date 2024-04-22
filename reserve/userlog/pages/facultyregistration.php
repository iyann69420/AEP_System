<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        select,
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .alert-success {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration!</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body class="bg-content">
    <main class="dashboard d-flex">
        <!-- start sidebar -->
        <?php include "component/sidebar.php"; ?>
        <!-- end sidebar -->

        <!-- start content page -->
        <div class="container-fluid px-4">
      

            <!-- start student list table -->

            <?php
            $host = "localhost";  // Your MySQL host
            $username = "root";  // Your MySQL username
            $password = "";  // Your MySQL password
            $database = "qrcode";  // Your database name

            $conn = mysqli_connect($host, $username, $password, $database);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $full_name = $email = $password = $user_type = "";
            $success_message = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $full_name = $_POST["full_name"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $user_type = $_POST["user_type"];

                // Validate the password with a regular expression
                $password_pattern = "/^[a-zA-Z0-9]{8,32}$/"; // Only letters and digits allowed, and length between 8 to 32 characters
                if (preg_match($password_pattern, $password)) {
                    // Use prepared statement to prevent SQL injection
                    $stmt = $conn->prepare("INSERT INTO facultylogs (full_name, email, password) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $full_name, $email, $password);

                    if ($stmt->execute()) {
                        $success_message = "Registration successful!";
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    $error_message = "Password must be between 8 to 32 characters and should not contain special characters.";
                }
            }
            ?>
            <div class="container">
                <h2>Registration Form</h2>
                <?php if (!empty($success_message)): ?>
                    <div class="alert-success">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                <form method="post">
                    <div class="form-group">
                        <label for="user_type">User Type</label>
                        <select name="user_type" required>
                    <option value="facultylogs">Faculty</option>
                            <option value="Studentlogs">Student</option>
							     <option value="adminlogs">Sub-Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" name="full_name" pattern="^[A-Za-z\s]+$" title="Only alphabets and spaces are allowed" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                        <div id="password-error" style="color: red;"><?php echo isset($error_message) ? $error_message : ''; ?></div>
                    </div>
                    <button type="submit">Register</button>
                </form>
            </div>
        </div>
        <!-- end content page -->
    </main>

    <script src="../js/script.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>

    <!-- Add this script at the end of your HTML file -->
   <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get the user_type dropdown element
        var userTypeDropdown = document.getElementsByName("user_type")[0];

        // Add event listener for the change event
        userTypeDropdown.addEventListener("change", function () {
            // Get the selected value
            var selectedValue = userTypeDropdown.value;

            // Redirect based on the selected value
            if (selectedValue === "facultylogs") {
                window.location.href = "facultyregistration.php";
            } else if (selectedValue === "Studentlogs") {
                window.location.href = "studentregistration.php";
            }
            // Add other conditions for different user types if needed
        });
    });
</script>

</body>

</html>

