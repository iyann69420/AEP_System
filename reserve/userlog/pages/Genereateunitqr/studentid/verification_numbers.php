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

// Function to insert a new student number into the database
function insertStudentNumber($studentNumber, $conn)
{
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO allowed_student_numbers (student_number) VALUES (?)");
    $stmt->bind_param("s", $studentNumber);

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
    if (!empty($verificationCode)) {
        // Call the function to insert the verification code into the database
        $inserted = insertStudentNumber($verificationCode, $conn);
        if ($inserted) {
            echo '<script>alert("Verification code added successfully!");</script>';
        } else {
            echo '<script>alert("Error adding verification code. Please try again!");</script>';
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
