<?php
include ('../partials/sidebar.php');

?>

<div class = "main-content">
           <div class = "wrapper">
                <h1>DASHBOARD</h1>
                <br><br>

                <?php
                        //if(isset($_SESSION['login']))
                        //{
                        //echo $_SESSION['login'];
                        //unset($_SESSION['login']);
                       // }
                  
                  ?>
                  <br><br>

  
    

                <div class = "col-4 text-center">

                      <?php

                      $sql =  "SELECT * FROM reservations";
                      $res = mysqli_query($conn,$sql);
                      $count = mysqli_num_rows($res);

                      ?>
                      <h1><?php echo $count;?></h1>
                       Reservations 

                </div>

                

                <div class = "col-4 text-center">
                  
                  <?php

                  $sql2 =  "SELECT * FROM sports";
                  $res2 = mysqli_query($conn,$sql2);
                  $count2 = mysqli_num_rows($res2);

                  ?>
                      <h1><?php echo $count2;?></h1>
                       Sports

                </div>


        

                <div class = "col-4 text-center">
                  <?php

                  $sql6 =  "SELECT * FROM users";
                  $res6 = mysqli_query($conn,$sql6);
                  $count6 = mysqli_num_rows($res6);

                  ?>
                      <h1><?php echo $count6;?></h1>
                       Users

                </div>

               

                

           
                <div class = "clearfix"></div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>







                            
