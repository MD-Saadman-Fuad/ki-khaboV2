<?php
    session_start();

    define('SITEURL', 'http://localhost/ki-khaboV2/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'ki-khabo'); 

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); #connect db
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); #select db
?>