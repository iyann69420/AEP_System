<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Units Report List</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        .toggle-password { padding: 0.2rem 0.5rem; font-size: 0.8rem; }
        .password { display: none; position: absolute; top: 50%; transform: translateY(-50%); left: 0; padding: 0.2rem 0.5rem; background-color: #fff; border: 1px solid #ccc; }
        .delete-all-button, .print-button,  .archive-button  { padding: 10px 20px; margin: 4px; border-radius: 5px; cursor: pointer; }
        .delete-all-button { background-color: #dc3545; color: #fff; border: 1px solid #00C1FE; }
        .delete-all-button:hover { background-color: #c82333; }
        .print-button { background-color: #007bff; color: #fff; border: 1px solid #007bff; }
        .print-button:hover { background-color: #0056b3; }
		 .archive-button { background-color: #007bff; color: #fff; border: 1px solid #007bff; }
        .archive-button:hover { background-color: #0056b3; }
    </style>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body class="bg-content">
    <main class="dashboard d-flex">
        <?php include "component/sidebar.php"; ?>
        <div class="container-fluid px-4">
            <div class="student-list-header d-flex justify-content-between align-items-center py-2">
                <div class="title h6 fw-bold">Units Report list</div>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search...">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table student_list table-borderless">
                    
                    <thead id="studentTable">
                        <tr>
                            <th>Student No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Section</th>
                            <th>Year</th>
                            <th>Room</th>
                            <th>Unit Number</th>
                            <th>Description</th>
                            <th>Timestamp</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    
        

                    <tbody>
                        <?php
                        include 'conixion.php';
                        $result = $con->query("SELECT * FROM reports");
                        foreach ($result as $value):
                        ?>
                            <tr class="bg-white align-middle">
                                <td><?php echo $value['studentNo'] ?></td>
                                <td><?php echo $value['First_Name'] ?></td>
                                <td><?php echo $value['Last_Name'] ?></td>
                                <td><?php echo $value['section'] ?></td>
                                <td><?php echo $value['year'] ?></td>
                                <td><?php echo $value['room'] ?></td>
                                <td><?php echo $value['unit_number'] ?></td>
                                <td><?php echo $value['description'] ?></td>
                                <td><?php echo $value['timestamp'] ?></td>
                                <td class="d-md-flex gap-3 mt-3">
                                   <a href="#" class="delete-link" data-id="<?php echo $value['id']; ?>"><i class="far fa-archive"> </i></a>


                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="btn-add d-flex gap-3 align-items-center">
                    <div class="short">
                       <form method="post" id="delete-all-form" class="d-inline">
    <input type="hidden" name="confirmed" value="1">
    <button type="submit" class="delete-all-button">Move  All to Archive</button>
</form>

                    </div>
                    <?php include 'component/adminadd.php'; ?>
                    <button type="button" class="print-button" onclick="printTable()">Print Table</button>
					 <button type="button" class="archive-button" onclick="redirectToArchive()">Archive</button>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/script.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script>
      $(document).ready(function () {
    // Script for individual record deletion

$(document).ready(function () {
    // Script for individual record deletion
    $(".delete-link").on("click", function (e) {
        e.preventDefault();

        var recordId = $(this).data("id");

        var userConfirmation = confirm("Are you sure you want to move this record to the archive?");
        if (userConfirmation) {
            $.ajax({
                type: "POST",
                url: "move_to_archive_individual.php", // Create a new PHP file for individual record movement
                data: { id: recordId },
                success: function (response) {
                    alert(response); // Display success message or handle as needed
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
});


    // Script for deleting all records
    $("#delete-all-form").on("submit", function (e) {
        e.preventDefault();
        var userConfirmation = confirm("Are you sure you want to delete all records?");
        if (userConfirmation) {
            $.ajax({
                type: "POST",
                url: "reportdelete.php",
                data: { confirmed: 1 },
                success: function (response) {
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    // Other scripts or functions can be added here
	 function printTable() {
                try {
                    var tableElement = document.querySelector('.table-responsive table');
                    if (!tableElement) {
                        throw new Error("Table element not found.");
                    }

                    html2canvas(tableElement).then(function (canvas) {
                        var link = document.createElement("a");
                        document.body.appendChild(link);
                        link.download = 'table_image.png';
                        link.href = canvas.toDataURL();
                        link.target = '_blank';
                        link.click();
                        document.body.removeChild(link);

                        // Clear the table content after download
                        $('.table.student_list tbody').empty();

                        // Refresh the page to fetch new data
                        location.reload();
                    });
                } catch (error) {
                    console.error("Error during image download:", error);
                    alert("Error during image download. Please try again. Check the console for details.");
                }
            }

            // Attach the printTable function to the print button click event
            $(".print-button").on("click", function () {
                printTable();
            });
});
  function redirectToArchive() {
        window.location.href = "/TRACK-WISE/Admin2/pages/unitarchive.php";
    }


    $(document).ready(function () {
    // Script for search filter
    $("#searchInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".student_list tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    // Rest of your existing JavaScript code...
});

    </script>
</body>

</html>
