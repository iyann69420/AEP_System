<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href ="\TRACK-WISE/asset/icon.png" type = "image/x-icon">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .navbar {
            margin-bottom: 20px;
        }

        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .list-group {
            max-height: 200px;
            overflow-y: auto;
        }

        

        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 50%, 0);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .animated.fadeInUp {
            animation-name: fadeInUp;
        }
        .bg-content {
            background-color: #c3cbdc;
            background-image: linear-gradient(147deg, #c3cbdc 0%, #edf1f4 74%);

        }

    </style>
</head>

<body class="bg-content">
    <main class="dashboard d-flex">
        <!-- start sidebar -->

        <?php
        include "component/sidebar.php";
        include 'conixion.php';
        $nbr_students = $con->query("SELECT * FROM allowed_student_numbers");
        $nbr_students = $nbr_students->rowCount();

        $nbr_sched = $con->query("SELECT * FROM addtable");
        $nbr_sched = $nbr_sched->rowCount();

        $nbr_dev = $con->query("SELECT * FROM units");
        $nbr_dev = $nbr_dev->rowCount();

        $nbr_fac = $con->query("SELECT * FROM facultylogs");
        $nbr_fac = $nbr_fac->rowCount();

        $nbr_adm = $con->query("SELECT * FROM facultylogs");
        $nbr_adm = $nbr_adm->rowCount();

        $nbr_subadm = $con->query("SELECT * FROM adminlogs");
        $nbr_subadm = $nbr_subadm->rowCount();
        ?>
        <!-- end sidebar -->

        <!-- start content page -->
        <div class="container-fluid px">
          

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark wow fadeInUp">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Home</a>
                    <!-- Add more navigation links as needed -->
                </div>
            </nav>

            <div class="row gap-3 justify-content-center mt-5">
                <div class="card card__items card__items--blue col-md-3 position-relative animated fadeInUp">
                    <div class="card__students d-flex flex-column gap-2 mt-3">
                        <i class="fas fa-user-graduate me-2"></i>
                        <span>Student</span>
                    </div>
                    <div class="card__nbr-students">
                        <span class="h5 fw-bold nbr"><?php echo $nbr_students; ?></span>
                    </div>
                </div>
          
                
                <div class="card card__items card__items--gradient col-md-3 position-relative animated fadeInUp">
                    <div class="card__users d-flex flex-column gap-2 mt-3">
                        <i class="fas fa-chalkboard-teacher me-2"></i>
                        <span>Faculty</span>
                    </div>
                    <div class="card__nbr-students">
                        <span class="h5 fw-bold nbr"><?php echo $nbr_fac; ?></span>
                    </div>
                </div>

                <div class="card card__items card__items--blue col-md-3 position-relative animated fadeInUp">
                    <div class="card__students d-flex flex-column gap-2 mt-3">
                        <i class="fas fa-user-shield me-2"></i>
                        <span>Admin</span>
                    </div>
                    <div class="card__nbr-students">
                        <span class="h5 fw-bold nbr"><?php echo $nbr_adm; ?></span>
                    </div>
                </div>

                <div class="card card__items card__items--blue col-md-3 position-relative animated fadeInUp">
                    <div class="card__students d-flex flex-column gap-2 mt-3">
                        <i class="fas fa-user-shield me-2"></i>
                        <span>sub-Admin</span>
                    </div>
                    <div class="card__nbr-students">
                        <span class="h5 fw-bold nbr"><?php echo $nbr_subadm; ?></span>
                    </div>
                </div>

				 <div class="card card__items card__items--rose col-md-3 position-relative animated fadeInUp">
                    <div class="card__Course d-flex flex-column gap-2 mt-3">
                        <i class="fas fa-calendar-plus me-2" style="color:  #00C1FE;"></i>
                        <span  >Schedules</span>
                    </div>
                    <div class="card__nbr-course">
                        <span class="h5 fw-bold nbr"><?php echo $nbr_sched; ?></span>
                    </div>
                </div>
				 <div class="card card__items card__items--yellow col-md-3 position-relative animated fadeInUp">
                    <div class="card__payments d-flex flex-column gap-2 mt-3">
                        <i class="fas fa-cube me-2"></i>
                        <span>UNIT</span>
                    </div>
                    <div class="card__payments">
                        <div class="card__nbr-students">
                            <span class="h5 fw-bold nbr"><?php echo $nbr_dev; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end contentpage -->

        <!-- Add your footer content here -->
      
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
    <script src="../js/script.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
</body>

</html>
