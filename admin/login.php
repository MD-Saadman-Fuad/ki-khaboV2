<?php include('../config/constants.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo" style="padding-top: 10px;">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <img src="../images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin/login.php">Admin</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>




    <div class="food-search">
        <div style="display: flex; justify-content: center; align-items: center; height: 50vh;">
            <div style="border: 1px solid grey; width: 25%; padding: 2%; background: white; text-align: center; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

                <h1 class="text-center">Login</h1>
                <br>
                <?php
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if (isset($_SESSION['no-login-msg'])) {
                    echo $_SESSION['no-login-msg'];
                    unset($_SESSION['no-login-msg']);
                }


                ?>
                <form action="" method="post" class="text-center" style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); display: inline-block; text-align: center;">


                    <label for="username" style="font-weight: bold;">Username:</label>
                    <br>
                    <input type="text" id="username" name="user_name" placeholder="Enter Username" required autocomplete="off"
                        style="padding: 10px; width: 80%; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; text-align: center;">
                    <br>

                    <label for="password" style="font-weight: bold;">Password:</label>
                    <br>
                    <input type="password" id="password" name="password" placeholder="Enter Password" required autocomplete="off"
                        style="padding: 10px; width: 80%; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; text-align: center;">
                    <br><br>

                    <input type="submit" name="submit" value="Login"
                        style="background-color: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; font-weight: bold;">
                </form>

                <br>




                <!--<p class="text-center">Created by - <a href="#">Saadman Fuad</a></p>-->
            </div>
        </div>
    </div>




</body>

</html>

<?php

if (isset($_POST['submit'])) {
    //$user_name = $_POST['user_name'];
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);;
    $password = md5($_POST['password']);
    //$raw_password = md5($_POST['password']);
    //$pasword = mysqli_real_escape_string($conn, $raw_password);


    $sql = "SELECT * FROM admin WHERE user_name='$user_name'and password='$password'";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = "<div class='green'> Login Successful! </div>";
        $_SESSION['user'] = $user_name;
        header('location:' . SITEURL . 'admin/');
    } else {
        $_SESSION['login'] = "<div class='red text-center'> Username and Password Didn't Match! </div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}









?>

<?php include('../partials-frontend/footer.php') ?>