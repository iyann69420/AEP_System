<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student list</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .toggle-mpin {
            
        }

        .mpin {
            display: none;
            left: 0;
            padding: 0.2rem 0.5rem;
            background-color: #fff;
            border: 1px solid #ccc;
        }
        .search-bar {
        max-width: 200px; /* Adjust the width as needed */
        margin-bottom: 1rem; /* Optional: Adjust the margin-bottom as needed */
    }
    </style>
</head>

<body class="bg-content">
    <main class="dashboard d-flex">
        <?php include "component/sidebar.php"; ?>
        <div class="container-fluid px-4">
  
            <div class="faculty-list-header d-flex justify-content-between align-items-center py-2">
                <div class="title h6 fw-bold">Student list</div>
                <div class="btn-add d-flex gap-3 align-items-center">
                    <div class="short">
                     
                    </div>
                    <?php include 'component/studentadd.php'; ?>
                </div>
            </div>
                 <!-- Add this code above the table -->
             <div class="search-bar mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search...">
            </div>
            <div class="table-responsive">
                
                <table class="table faculty_list table-borderless">
                    <thead>
                        <tr class="align-middle">
                       
                            <th>First Name</th>
                            <th>Last Name</th>
							<th>Course</th>	
							<th>Year</th>
							<th>Student Number</th>
                            <th>MPIN:</th>
                            <th>Time_in</th>
                            <th>Time_out</th>
                            <th>Action</th>
                            <th class="opacity-0">list</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'conixion.php';
                        $result = $con->query("SELECT * FROM allowed_Student_numbers");
                        foreach ($result as $value):
                        ?>
                            <tr class="bg-white align-middle">
                         
                                <td><?php echo $value['First_Name'] ?></td>
								   <td><?php echo $value['Last_Name'] ?></td>
								      <td><?php echo $value['section'] ?></td>
									     <td><?php echo $value['Year'] ?></td>
										
                                <td><?php echo $value['student_number'] ?></td>
                                <td class="position-relative">
                                    <button class="btn btn-sm btn-secondary toggle-mpin" data-target="mpin-<?php echo $value['id']; ?>">
                                        Show MPIN
                                    </button>
                                    <span id="mpin-<?php echo $value['id']; ?>" class="mpin">
                                        <?php echo $value['empin']; ?>
                                    </span>
                                </td>
                                <td><?php echo $value['time_in'] ?></td>
                                <td><?php echo $value['time_out'] ?></td>
                                <td class="d-md-flex gap-3 mt-3">
                                    <a href="#" class="delete-link" data-id="<?php echo $value['id']; ?>"><i class="far fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="../js/script.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script>
         $(document).ready(function () {
            $(".delete-link").on("click", function (e) {
                e.preventDefault();

                var recordId = $(this).data("id");

                var userConfirmation = confirm("Are you sure you want to delete this record?");
                if (userConfirmation) {
                    $.ajax({
                        type: "POST",
                        url: "studentdelete.php",
                        data: { id: recordId },
                        success: function (response) {
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            $(".toggle-mpin").on("click", function () {
                var targetId = $(this).data("target");
                var mpinElement = $("#" + targetId);

                if (mpinElement.is(":hidden")) {
                    mpinElement.show();
                    $(this).hide();
                } else {
                    mpinElement.hide();
                }
            });

            // Search functionality
            $("#searchInput").on("input", function () {
                var searchText = $(this).val().toLowerCase();

                $(".faculty_list tbody tr").each(function () {
                    var rowData = $(this).text().toLowerCase();
                    if (rowData.indexOf(searchText) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        });
    </script>
</body>

</html>
