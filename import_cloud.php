<?php
if ($argc < 2) {
    echo "Usage: php import_cloud.php YOUR_AIVEN_PASSWORD\n";
    exit(1);
}

$host = 'ki-khabo-ki-khabo.e.aivencloud.com';
$port = 23130;
$user = 'avnadmin';
$pass = $argv[1];
$dbname = 'defaultdb';

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
