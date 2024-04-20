<?php include ('../partials/sidebar.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Users</h1>
        <br /><br />



        <br><br>

        <button id="addSportBtn" class="btn-primary">Add Users</button>

        <br /><br /><br />

      

        <table class="tbl-full">
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Middle initials</th>
                <th>Last Name</th>
                <th>Contact </th>
                <th>Address </th>
                <th>Email</th>
                
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM users";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $username = $row['username'];
                    $firstname = $row['firstname'];
                    $middleinitials = $row['middleinitials'];
                    $lastname = $row['lastname'];
                    $contact = $row['contact'];
                    $address = $row['address'];
                    $email = $row['email'];
                    
                    ?>
                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $username;?></td>
                        <td><?php echo $firstname;?></td>
                        <td><?php echo $middleinitials;?></td>
                        <td><?php echo $lastname;?></td>
                        <td><?php echo $contact;?></td>
                        <td><?php echo $address;?></td>
                        <td><?php echo $email;?></td>
                        
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-brands.php?id=<?php echo $id; ?>" class='btn-secondary'>Update Brand</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-brands.php?id=<?php echo $id; ?>" class="btn-third">Delete Brand</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan='4'><div class='error'>No UsersAdded</div></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
