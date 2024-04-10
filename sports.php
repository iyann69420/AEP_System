<?php
include ('./partials/sidebar.php');

?>



<div class="main-content">
    <div class="wrapper">
        <h1>Sports</h1>

        <br /><br />
        <?php

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-service-found']))
        {
            echo $_SESSION['no-service-found'];
            unset($_SESSION['no-service-found']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
     
        ?>
        
        <br><br>

        <a href="<?php echo SITEURL; ?>admin/add-services.php" class="btn-primary">Add Services</a>
        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>#</th>
                <th>Service Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM service_list";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['service'];
                    $description = $row['description'];
                    $status = $row['status'];
                    $status_display = ($status == 1) ? "Active" : "Inactive";
                  ?>
                   
                    <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $title;?></td>
                            <td><?php echo $description; ?></td>
                            <td style='color: <?php echo ($status == 1) ? "green" : "red"; ?>;'><?php echo $status_display; ?></td>

                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-services.php?id=<?php echo $id; ?>" class='btn-secondary'>Update Service</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-services.php?id=<?php echo $id; ?>" class="btn-third">Delete Service</a>
                            </td>
                    </tr>
                    
                    <?php
                }
            } 
            else 
            {
             ?>
                <tr>
                    <td colspan='4'><div class='error'>No Service Added.</div></td>
                </tr>
                <?php
            }
            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>