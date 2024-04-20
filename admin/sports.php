<body>
    <div class="page">
        <?php
        include('../partials/sidebar.php');
        ?>

        <div class="content">
            <h1>Sports</h1>

            <?php
            if (isset($_SESSION['add'])) {

                echo "<script>alertify.{$_SESSION['add_type']}('{$_SESSION['add']}');</script>";
                unset($_SESSION['add']);
                unset($_SESSION['add_type']);
            }

            if (isset($_SESSION['update'])) {
                echo "<script>alertify.{$_SESSION['update_type']}('{$_SESSION['update']}');</script>";
                unset($_SESSION['update']);
                unset($_SESSION['update_type']);
            }

            if (isset($_SESSION['delete'])) {
                echo "<script>alertify.{$_SESSION['delete_type']}('{$_SESSION['delete']}');</script>";
                unset($_SESSION['delete']);
                unset($_SESSION['delete_type']);
            }
            ?>

            <button id="addSportBtn" class="btn-primary">Add Sports</button>

            <div id="addSportModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="modal-title">
                        <h2>Add Sport</h2>
                    </div>
                    <form id="addSportForm" method="POST" action="<?php echo SITEURL; ?>admin/functions/add-sports.php">
                        <label for="sportName">Sport Name:</label>
                        <input type="text" id="sportName" name="sportName" required>
                        <input type="submit" class="btn-primary" value="Add">
                    </form>

                    <button id="cancelBtn" class="btn-secondary">Cancel</button>
                </div>
            </div>

            <div id="updateSportModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="modal-title">
                        <h2>Update Sport</h2>
                    </div>
                    <form id="updateSportForm" method="POST" action="<?php echo SITEURL; ?>admin/functions/update-sports.php">
                        <!-- Include hidden input field for sport ID -->
                        <input type="hidden" id="sport_id" name="sport_id" value="">
                        <label for="sportName">Sport Name:</label>
                        <input type="text" id="sportName" name="sportName" required>
                        <input type="submit" class="btn-primary" value="Update">
                    </form>
                    <button id="cancelUpdateBtn" class="btn-secondary">Cancel</button>
                </div>
            </div>



            <table class="tbl-full">
                <tr>
                    <th>#</th>
                    <th>Sports Name</th>
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
                ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>

                            <td style="text-align: center;">
                                <button class="updateSportBtn btn-primary" data-sport-id="<?php echo $id; ?>">Update Sport</button>
                                <a href="<?php echo SITEURL; ?>admin/functions/delete-sports.php?id=<?php echo $id; ?>" class="btn-third">Delete Sports</a>
                            </td>

                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan='4'>
                            <div class='error'>No Sports Added</div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>