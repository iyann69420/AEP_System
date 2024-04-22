<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Log</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="resetstyles.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        .dashboard {
            display: flex;
        }
    </style>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
</head>

<body class="bg-content">
    <main class="dashboard">
        <?php include "component/sidebar.php"; ?>
        <div class="container-fluid">

            <h1>Reset Database</h1>
            <p>Clicking the reset button will wipe out all records from the "qrcode" database. This action cannot be undone.</p>
            <button type="button" onclick="confirmReset()">Reset Database</button>

            <div id="successMessage" style="color: green; display: none;"></div>
            <div id="errorMessage" style="color: red; display: none;"></div>
        </div>

        <script>
            function confirmReset() {
                if (confirm('Are you sure you want to reset the database?')) {
                    resetDatabase();
                }
            }

            function resetDatabase() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            document.getElementById('successMessage').style.display = 'block';
                            document.getElementById('successMessage').innerHTML = xhr.responseText;
                        } else {
                            document.getElementById('errorMessage').style.display = 'block';
                            document.getElementById('errorMessage').innerHTML = 'Error resetting database: ' + xhr.responseText;
                        }
                    }
                };
                xhr.open('POST', 'reset.php', true);
                xhr.send();
            }
        </script>
    </main>
</body>

</html>
