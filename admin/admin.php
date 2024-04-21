<body>
    <div class="page">
        <?php
        include('../partials/sidebar.php');
        ?>

        <div class="content">
            <h1>Admin</h1>

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

            <button id="addSportBtn" class="btn-primary">Add Admin</button>

            <div id="addSportModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="modal-title">
                        <h2>Add Admin</h2>
                    </div>
                    <form id="addSportForm" method="POST" action="<?php echo SITEURL; ?>admin/functions/add-admin.php">
                        <label for="fullname">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" required>

                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>

                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>

                        <label for="userRole">User Role:</label>
                        <select id="userRole" name="userRole" required>
                            <option value="0">Admin</option>
                            <option value="1">Staff</option>
                        </select>

                        <input type="submit" class="btn-primary" value="Add">
                    </form>

                    <button id="cancelBtn" class="btn-secondary">Cancel</button>
                </div>
            </div>


            <div id="updateSportModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="modal-title">
                        <h2>Update Admin</h2>
                    </div>
                    <form id="addSportForm" method="POST" action="<?php echo SITEURL; ?>admin/functions/update-admin.php">
                        <label for="fullname">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" required>

                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>

                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>

                        <label for="userRole">User Role:</label>
                        <select id="userRole" name="userRole" required>
                            <option value="0">Admin</option>
                            <option value="1">Staff</option>
                        </select>


                         <input type="hidden" id="adminId" name="adminId">
                        <input type="submit" class="btn-primary" value="Add">
                    </form>

                    <button id="cancelBtn" class="btn-secondary">Cancel</button>
                </div>
            </div>



            <table class="tbl-full">
                <tr>
                    <th>#</th>
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>User Role</th>
                    <th>Actions</th>
                </tr>

                <?php
                $sql = "SELECT * FROM admin";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $fullname = $row['fullname'];
                        $username = $row['username'];
                        $userrole = $row['userrole'];
                        $userrole_display = ($userrole == 0) ? 'Admin' : 'Staff';
                ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $fullname; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $userrole_display; ?></td>

                            

                            <td style="text-align: center;">
                                <button class="updateSportBtn btn-primary" data-sport-id="<?php echo $id; ?>">Update Admin</button>
                                <a href="<?php echo SITEURL; ?>admin/functions/delete-admin.php?id=<?php echo $id; ?>" class="btn-third">Delete Sports</a>
                            </td>

                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan='4'>
                            <div class='error'>No Admin Added</div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>