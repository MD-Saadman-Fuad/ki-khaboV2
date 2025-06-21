<?php 
    include('../config/constants.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM admin WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true){
        $_SESSION['delete'] = "<div class='green'> Admin Deleted Successfully </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['delete'] = "<div class='red'> Failed to Delete Admin. Try again! </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>