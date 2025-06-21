<?php 
if (!isset($_SESSION['user'])){
    $_SESSION['no-login-msg'] = "<div class='red text-center'> Please Login First! </div>";
    header('location:'.SITEURL.'admin/login.php');
}

?>
