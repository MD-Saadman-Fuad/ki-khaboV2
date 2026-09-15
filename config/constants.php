<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Load local .env file if present
    $env_file = __DIR__ . '/../.env';
    if (file_exists($env_file)) {
        $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if (!empty($line) && strpos($line, '#') !== 0 && strpos($line, '=') !== false) {
                list($key, $val) = explode('=', $line, 2);
                $key = trim($key);
                $val = trim($val);
                if (getenv($key) === false) {
                    putenv("$key=$val");
                }
            }
        }
    }

    $site_url = getenv('SITEURL') ? getenv('SITEURL') : 'http://localhost/ki-khaboV2/';
    $db_host  = getenv('DB_HOST') ? getenv('DB_HOST') : 'localhost';
    $db_user  = getenv('DB_USERNAME') ? getenv('DB_USERNAME') : 'root';
    $db_pass  = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '';
    $db_name  = getenv('DB_NAME') ? getenv('DB_NAME') : 'ki-khabo';
    $db_port  = getenv('DB_PORT') ? (int)getenv('DB_PORT') : 3306;

    if (!defined('SITEURL')) define('SITEURL', $site_url);
    if (!defined('LOCALHOST')) define('LOCALHOST', $db_host);
    if (!defined('DB_USERNAME')) define('DB_USERNAME', $db_user);
    if (!defined('DB_PASSWORD')) define('DB_PASSWORD', $db_pass);
    if (!defined('DB_NAME')) define('DB_NAME', $db_name); 
    if (!defined('DB_PORT')) define('DB_PORT', $db_port);

    if (!isset($conn) || !$conn) {
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
        if (!$conn) {
            die("❌ Database connection error: " . mysqli_connect_error());
        }
    }
?>