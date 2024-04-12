<?php include ('./partials/sidebar.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Sports</h1>

        <br /><br />

        <?php
         if (isset($_SESSION['add'])) 
         {
             echo $_SESSION['add'];
             unset($_SESSION['add']);
         }
         if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-brand-found']))
        {
            echo $_SESSION['no-brand-found'];
            unset($_SESSION['no-brand-found']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
         ?>

        
        <br><br>

        <button id="addSportBtn" class="btn-primary">Add Sports</button>

        <br /><br /><br />

       <!-- Modal content -->
        <!-- Modal content -->
        <div id="addSportModal" class="modal">
        
            <div class="modal-content">

                <span class="close">&times;</span>
                <h2>Add Sport</h2>

                <form id="addSportForm" method="POST" action="<?php echo SITEURL; ?>admin/add-brands.php">
                    <label for="sportName">Sport Name:</label>
                    <input type="text" id="sportName" name="sportName" required>
                    <input type="submit" class="btn-primary" value="Add">
                </form>

                <!-- Cancel button to exit the modal -->
                <button id="cancelBtn" class="btn-secondary">Cancel</button>
                
                
            </div>

        </div>


        <table class="tbl-full">
            <tr>
                <th>#</th>
                <th>Brand Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM sports";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['sport_id'];
                    $title = $row['name'];
                    $status = $row['description'];
                    $tables_courts['tables/courts']
                  ?>
                   
                    <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $title;?></td>
                            <td style='color: <?php echo ($status == 1) ? "green" : "red"; ?>;'><?php echo $status_display; ?></td>

                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-brands.php?id=<?php echo $id; ?>" class='btn-secondary'>Update Brand</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-brands.php?id=<?php echo $id; ?>" class="btn-third">Delete Brand</a>
                            </td>
                    </tr>
                    
                    <?php
                }
            } 
            else 
            {
             ?>
                <tr>
                    <td colspan='4'><div class='error'>No Sports Added</div></td>
                </tr>
                <?php
            }
            ?>

        </table>
    </div>
</div>
