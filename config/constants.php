<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $site_url = getenv('SITEURL') ? getenv('SITEURL') : 'http://localhost/ki-khaboV2/';
    $db_host  = getenv('DB_HOST') ? getenv('DB_HOST') : 'localhost';
    $db_user  = getenv('DB_USERNAME') ? getenv('DB_USERNAME') : 'root';
    $db_pass  = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '';
    $db_name  = getenv('DB_NAME') ? getenv('DB_NAME') : 'ki-khabo';

    if (!defined('SITEURL')) define('SITEURL', $site_url);
    if (!defined('LOCALHOST')) define('LOCALHOST', $db_host);
    if (!defined('DB_USERNAME')) define('DB_USERNAME', $db_user);
    if (!defined('DB_PASSWORD')) define('DB_PASSWORD', $db_pass);
    if (!defined('DB_NAME')) define('DB_NAME', $db_name); 

    if (!isset($conn) || !$conn) {
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); #connect db
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); #select db
    }
?>