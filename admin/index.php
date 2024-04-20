<body>
    <div class="page">
        <?php
        include('../partials/sidebar.php');
        ?>

        <div class="content">
            <h1>DASHBOARD</h1>
            <div class="wrapper">
                <?php
                //if(isset($_SESSION['login']))
                //{
                //echo $_SESSION['login'];
                //unset($_SESSION['login']);
                // }

                ?>
                <div class="card">
                    <?php
                    $sql =  "SELECT * FROM reservations";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <p>Reservations</p>
                </div>

                <div class="card">
                    <?php
                    $sql2 =  "SELECT * FROM sports";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <p>Sports</p>
                </div>

                <div class="card">
                    <?php
                    $sql6 =  "SELECT * FROM users";
                    $res6 = mysqli_query($conn, $sql6);
                    $count6 = mysqli_num_rows($res6);
                    ?>
                    <h1><?php echo $count6; ?></h1>
                    <p>Users</p>
                </div>
            </div>
        </div>
    </div>


</body>