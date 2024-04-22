<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>QR Code Generator</title>
    <link rel="icon" href="img/favicon.ico" type="image/png">
    <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/style.css">
    <link rel = "icon" href ="/TRACK-WISE/asset/icon.png" type = "image/x-icon">
    <script src="libs/navbarclock.js"></script>
    <style>
         body {
            background-image: url('back-banner.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .myoutput {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-right: 20px; /* Add space on the right */
        }
        .logo-container {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .logo {
            width: 50px;
            height: 50px;
        }
        .myoutput h3 {
            margin-bottom: 20px;
            color: #007bff;
        }
        .input-field {
            text-align: left;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            padding: 12px;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .submitBtn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        .submitBtn:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 14px;
            text-align: left;
            margin-top: 5px;
        }
        .form-label {
            text-align: center;
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

         .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(your-background-image.jpg);
            background-size: cover;
            animation: fadeIn 0.3s ease-in-out; /* Smooth fade-in animation */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);   
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9));
            padding: 20px;
            width: 28%; /* Adjust the width as needed */
            max-height: 100%; /* Adjust the maximum height as needed */
            overflow-y: auto; /* Enable vertical scrolling when content exceeds the modal height */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            font-family: Arial, sans-serif; /* Adjust font as needed */
            animation: slideIn 0.3s ease-in-out; /* Smooth slide-in animation */
        }

        @keyframes slideIn {
            from {
                transform: translate(-50%, -60%);
                opacity: 0;
            }
            to {
                transform: translate(-50%, -50%);
                opacity: 1;
            }
        }

        /* Styles for the close button */
        /*.close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
            cursor: pointer;
            color: #555; /* Text color for the close button
        }
        .close:hover {
            color: red;
        }  */
        h2 {
            color: #333; /* Header text color */
            font-size: 24px; /* Header font size */
        }
        p {
            color: #666; /* Paragraph text color */
            font-size: 16px; /* Paragraph font size */
        }

        .agree-button {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            position: absolute;
            right: 25px;
            bottom: -40px;
        }

        .agree-button:hover {
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <a href="http://localhost/TRACK-WISE/"><img src="logo.png" alt="Logo" class="logo"></a>
    </div>

    <script>
        function redirectToURL(url) {
            window.location.href = url;
        }
    </script>

    <?php
    // Connect to the database (Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials)
    $hostName = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "qrcode";
    $conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to check if the verification code already exists in the database
    function isVerificationCodeExists($studentNumber, $conn)
    {
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM allowed_student_numbers WHERE student_number = ?");
        $stmt->bind_param("s", $studentNumber);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Check if the verification code already exists
        return $row['count'] > 0;
    }

    // Function to check if the empin already exists in the database
    function isEmpinExists($empin, $conn)
    {
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM allowed_student_numbers WHERE empin = ?");
        $stmt->bind_param("s", $empin);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Check if the empin already exists
        return $row['count'] > 0;
    }

    // Function to insert a new student number into the database
    function insertStudentNumber($studentNumber, $verificationPin, $FullName, $conn)
    {
        // Check if the verification code already exists
        if (isVerificationCodeExists($studentNumber, $conn)) {
            return false; // Return false if the verification code already exists
        }

        // Check if the empin already exists
        if (isEmpinExists($verificationPin, $conn)) {
            return false; // Return false if the empin already exists
        }

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO allowed_student_numbers (student_number, empin, FullName) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $studentNumber, $verificationPin, $FullName);

        // Execute the prepared statement
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Add verification code manually to the database if submitted via a form
    if (isset($_POST['submit_verification'])) {
        $verificationCode = $_POST['verification_code'];
        $verificationPin = $_POST['verification_pin'];
        $FullName = $_POST['full_name']; // Get the full name from the form
        if (!empty($verificationCode)) {
            // Call the function to insert the verification code and full name into the database
            $inserted = insertStudentNumber($verificationCode, $verificationPin, $FullName, $conn);
            if ($inserted) {
                echo '<script>alert("Verification code added successfully!");</script>';
                // Redirect to the desired URL after successful form submission
                echo '<script>redirectToURL("http://localhost/track-wise/student2/");</script>';
                exit; // Add this to prevent further processing of the page
            } else {
                echo '<script>alert("Student number or MPIN is already inserted or Error adding verification code. Please try again!");</script>';
            }
        }
    }

    // Allowed student numbers (We'll fetch them from the database)
    $allowed_student_numbers = array();

    $sql = "SELECT student_number FROM allowed_student_numbers";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $allowed_student_numbers[] = $row['student_number'];
        }
    }

    // Close the database connection
    $conn->close();

    ?>

  <div class="myoutput">
        <div class="input-field">
            <h3><strong>REGISTER YOUR STUDENT ID</strong></h3>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="verification_code" class="form-label">Student ID</label>
                    <center><input type="text" class="form-control" name="verification_code" id="verification_code" placeholder="Enter verification code" required></center>
                </div>
              <div class="form-group">
    <label for="verification_pin" class="form-label">MPIN</label>
    <center><input type="password" class="form-control" name="verification_pin" id="verification_pin" placeholder="Enter Password or Pin" required minlength="8"></center>
</div>
                <div class="form-group">
                    <label for="full_name" class="form-label">Full Name</label>
                    <center><input type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter your full name" required></center>
                </div>
                <div class="form-group">
                    <label>
                       <!-- <input type="checkbox" id="termsCheckbox"> I agree to the <a href="#" id="showTermsLink">Terms and Conditions</a>-->
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit_verification" class="btn btn-primary submitBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Terms and Conditions -->
    <div id="termsModal" class="modal">
        <div class="modal-content">
           <!-- <span class="close" id="closeTermsModal">&times;</span> ito yung close icon sa taas -->
            <h2>"Terms and Conditions"</h2>
            <p>By using our services, you agree to comply with and be bound by these terms and conditions. We are committed to protecting your privacy and personal information, and your data will be handled in accordance with our privacy policy, available on our website. All content provided on our platform, including text, graphics, logos, and images, is our intellectual property and is protected by copyright and trademark laws. You may not use, reproduce, or distribute our content without our written permission. While we strive for accuracy and quality in our services, we cannot guarantee their completeness or suitability for any particular purpose, and we are not liable for any damages or losses resulting from the use of our services. We reserve the right to update and modify these terms and conditions at any time, and any changes will be effective immediately upon posting on our website. It is your responsibility to review these terms periodically to stay informed of any updates.</p>

            <button class="agree-button" id="agreeButton" onclick="enableCloseButton()">I Agree</button>

            <!-- Add your terms and conditions content here -->
        </div>
    </div>

    <script>
        // Function to show the modal when the checkbox is checked
        document.getElementById("termsCheckbox").addEventListener("change", function() {
            var modal = document.getElementById("termsModal");
            if (this.checked) {
                modal.style.display = "block";
            } else {
                modal.style.display = "none";
            }
        });

        // Function to close the modal when the close button is clicked  symbol x  in upper right
        document.getElementById("agreeButton").addEventListener("click", function() {
            var modal = document.getElementById("termsModal");
            modal.style.display = "none";
        });

         // JavaScript function to close the modal or closing after click the button
        document.getElementById("closeTermsModal").addEventListener("click", function() {
            var modal = document.getElementById("termsModal");
            modal.style.display = "none";
        });

    </script>
    <script type="text/javascript">
                // JavaScript function to enable the close button
        function enableCloseButton() {
            document.getElementById('closeTermsModal').style.pointerEvents = 'auto';
        }

        // JavaScript function to close the modal
        function closeModal() {
            document.getElementById('termsModal').style.display = 'none';
        }

        // Add event listener to close the modal when the escape key is pressed
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

    </script>


     <script>
        // JavaScript function to close the modal and enable the submit button
        function agreeAndCloseModal() {
            document.getElementById('termsModal').style.display = 'none';
            enableSubmitButton();
        }

        // JavaScript function to enable the submit button
        function enableSubmitButton() {
            const submitButton = document.querySelector('[name="submit_verification"]');
            submitButton.disabled = false;
        }

        // Add event listener to enable the submit button when the checkbox is checked
        const agreeCheckbox = document.getElementById('agreeCheckbox');
        const submitButton = document.querySelector('[name="submit_verification"]');
        
        agreeCheckbox.addEventListener('change', function() {
            submitButton.disabled = !agreeCheckbox.checked;
        });

        // Add event listener to check if the submit button is clicked without agreeing to terms
        const submitButton = document.querySelector('[name="submit_verification"]');
        submitButton.addEventListener('click', function() {
            if (!agreeCheckbox.checked) {
                alert('Please check the "I Agree" checkbox before submitting.');
            }
        });
    </script>


</body>
</html>
     
