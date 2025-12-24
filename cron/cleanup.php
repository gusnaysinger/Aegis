<?php
require __DIR__ . '/../static/php/connection.php';

$sql = "DELETE FROM files WHERE created_at < NOW() - INTERVAL 7 DAY";

if (!mysqli_query($conn, $sql)) {
    error_log(
        "[" . date('Y-m-d H:i:s') . "] ERRO: " . mysqli_error($conn) . PHP_EOL,
        3,
        __DIR__ . '/../logs/cron.log'
    );
}