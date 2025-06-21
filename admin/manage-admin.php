<?php include("partials/menu.php") ?>


<!-- main start -->
<div class="main main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br />
        <br />


        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        if (isset($_SESSION['password-not-match'])) {
            echo $_SESSION['password-not-match'];
            unset($_SESSION['password-not-match']);
        }
        if (isset($_SESSION['change-password'])) {
            echo $_SESSION['change-password'];
            unset($_SESSION['change-password']);
        }
        ?>
        <br />

        <!-- Button add admin -->
        <br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>Serial No.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php

            $sql = "SELECT * FROM admin";

            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                $serial = 1;
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $user_name = $rows['user_name'];
            ?>
                        <tr>
                            <td><?php echo $serial++ ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $user_name ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-red">Delete Admin</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                }
            }

            ?>

        </table>

    </div>
</div>
<!-- main ends -->

<?php include("partials/footer.php") ?>