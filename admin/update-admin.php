
<?php include("partials/menu.php") ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php 
        
            $id = $_GET['id'];

            $sql = "SELECT * FROM admin WHERE id = $id";
            $res = mysqli_query($conn, $sql);

            if ($res==true){
                $count=mysqli_num_rows($res);
                if($count==1){
                    $row=mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $user_name = $row['user_name'];
                }
                else{
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
        <table class="tbl-50">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="user_name" value="<?php echo $user_name ?>"></td>
                </tr>
                
                <br>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php 
if (isset($_POST['submit'])){
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];


    $sql = "UPDATE admin SET 
    full_name= '$full_name',
    user_name = '$user_name'
    WHERE id = '$id'
    ";

    $res = mysqli_query($conn, $sql);

    if ($res==true){
        $_SESSION['update'] = "<div class='green'> Admin Updated Successfully </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['update'] = "<div class='red'> Failed to Update Admin. Try again! </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

}

?>

<?php include("partials/footer.php") ?>