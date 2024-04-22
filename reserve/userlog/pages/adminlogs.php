<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin list</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        .toggle-password {
            padding: 0.2rem 0.5rem;
            font-size: 0.8rem;
        }

        .password {
            display: none;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 0;
            padding: 0.2rem 0.5rem;
            background-color: #fff;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body class="bg-content">
    <main class="dashboard d-flex">
        <?php 
            include "component/sidebar.php";
        ?>
        <div class="container-fluid px-4">
     
            <div class="student-list-header d-flex justify-content-between align-items-center py-2">
                <div class="title h6 fw-bold">Admin list</div>
                <div class="btn-add d-flex gap-3 align-items-center">
                    <div class="short">
                        
                    </div>
                    <?php include 'component/adminadd.php'; ?>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table student_list table-borderless">
                    <thead>
                        <tr class="align-middle">
                        
                            <th>FullName</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Time_in</th>
                            <th>Time_out</th>
                            <th class="opacity-0">list</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          include 'conixion.php';
                          $result = $con -> query("SELECT * FROM adminlogs");
                          foreach($result as $value):
                        ?>
                        <tr class="bg-white align-middle">
                            <td><?php echo $value['full_name'] ?></td>
                            <td><?php echo $value['email'] ?></td>
                            <td class="position-relative">
                                <button class="btn btn-sm btn-secondary toggle-password" data-target="password-<?php echo $value['id']; ?>">
                                    Show Password
                                </button>
                                <span id="password-<?php echo $value['id']; ?>" class="password">
                                    <?php echo $value['password']; ?>
                                </span>
                            </td>
                            <td><?php echo $value['time_in'] ?></td>
                            <td><?php echo $value['time_out'] ?></td>
                            <td class="d-md-flex gap-3 mt-3">
                                <a href="#"><i class="far fa-pen"></i></a>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleButtons = document.querySelectorAll(".toggle-password");

            toggleButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const targetId = this.getAttribute("data-target");
                    const passwordElement = document.getElementById(targetId);

                    if (passwordElement.style.display === "none" || passwordElement.style.display === "") {
                        passwordElement.style.display = "inline-block";
                        this.style.display = "none";
                    } else {
                        passwordElement.style.display = "none";
                    }
                });
            });
        });

        $(document).ready(function() {
            $(".delete-link").on("click", function(e) {
                e.preventDefault();

                var recordId = $(this).data("id");

                var userConfirmation = confirm("Are you sure you want to delete this record?");
                if (userConfirmation) {
                    $.ajax({
                        type: "POST",
                        url: "admindelete.php",
                        data: { id: recordId },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
