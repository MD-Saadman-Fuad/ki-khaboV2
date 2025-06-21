<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>



        <form action="" method="POST">
            <table class="tbl-50">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your Name "></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="user_name" placeholder="Enter your Username "></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter your Password "></td>
                </tr>
                <br>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php") ?>

<?php
if (isset($_POST['submit'])) {
$full_name = $_POST['full_name'];
$user_name = $_POST['user_name'];
$password = md5($_POST['password']); /*password encryption */


    if ((empty($user_name)) || (empty($full_name))) {
        $_SESSION['add'] = "<div class='red'> Please Enter Correct Information </div>";

        header("location:" . SITEURL . 'admin/add-admin.php');
    } else {
        
        $sql = "INSERT INTO admin SET
            full_name = '$full_name',
            user_name = '$user_name',
            password = '$password'
        ";

        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        if ($res == TRUE) {
            $_SESSION['add'] = "<div class='green'> Admin Added Successfully </div>";

            header("location:" . SITEURL . 'admin/manage-admin.php');
        } else {
            $_SESSION['add'] = "<div class='red'> Failed to Add Admin </div>";

            header("location:" . SITEURL . 'admin/add-admin.php');
        }
    }
}
?>