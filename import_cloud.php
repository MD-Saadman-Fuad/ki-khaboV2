<?php
// Load local .env file if present
$env_file = __DIR__ . '/.env';
if (file_exists($env_file)) {
    $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if (!empty($line) && strpos($line, '#') !== 0 && strpos($line, '=') !== false) {
            list($key, $val) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($val));
        }
    }
}

$host = getenv('DB_HOST') ? getenv('DB_HOST') : 'ki-khabo-ki-khabo.e.aivencloud.com';
$port = getenv('DB_PORT') ? (int)getenv('DB_PORT') : 23130;
$user = getenv('DB_USERNAME') ? getenv('DB_USERNAME') : 'avnadmin';
$pass = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME') ? getenv('DB_NAME') : 'defaultdb';

if (empty($pass)) {
    echo "Usage: php import_cloud.php YOUR_AIVEN_PASSWORD\n";
    exit(1);
}

echo "Connecting to Aiven MySQL ($host:$port)...\n";
$conn = mysqli_connect($host, $user, $pass, $dbname, $port);

if (!$conn) {
    die("❌ Connection failed: " . mysqli_connect_error() . "\n");
}

echo "✅ Connected to Aiven MySQL!\n";
echo "Importing ki-khabo.sql...\n";

$sql = file_get_contents(__DIR__ . '/ki-khabo.sql');

if (mysqli_multi_query($conn, $sql)) {
    do {
        if ($result = mysqli_store_result($conn)) {
            mysqli_free_result($result);
        }
    } while (mysqli_more_results($conn) && mysqli_next_result($conn));
    echo "🎉 ki-khabo.sql imported successfully into Aiven 'defaultdb'!\n";
} else {
    echo "❌ Import error: " . mysqli_error($conn) . "\n";
}
?>
