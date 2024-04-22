<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <script>
    function validateForm() {
      var studentNumbers = ["20-0123", "20-0124", "20-0125", "20-0126", "20-0127", "20-0128"];
      var input = document.getElementById("studentNumber").value;
      if (studentNumbers.includes(input)) {
        return true; // Valid student number
      } else {
        document.getElementById("error").innerHTML = "Invalid student number";
        return false; // Invalid student number
      }
    }
  </script>
</head>
<body>
  <h2>Login Form</h2>
  <form onsubmit="return validateForm()">
    <label for="studentNumber">Student Number:</label>
    <input type="text" id="studentNumber" name="studentNumber" required>
    <input type="submit" value="Login">
  </form>
  <p id="error" style="color: red;"></p>
</body>
</html>
