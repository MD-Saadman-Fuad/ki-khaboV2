<?php
header('Content-Type: application/json');

// Include DB config & connection
require_once __DIR__ . '/config/constants.php';

$response = [
    'status' => 'error',
    'db' => 'disconnected',
    'timestamp' => date('Y-m-d H:i:s T')
];

if (isset($conn) && $conn) {
    // Run a lightweight query to keep DB session active
    $result = mysqli_query($conn, "SELECT 1");
    if ($result) {
        $response['status'] = 'ok';
        $response['db'] = 'connected';
    } else {
        $response['message'] = mysqli_error($conn);
    }
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
