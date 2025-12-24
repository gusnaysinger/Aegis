<?php
declare(strict_types=1);

session_start();
require __DIR__ . '/connection.php';

if (!isset($_GET['id'], $_SESSION['user_id'])) {
    http_response_code(400);
    exit;
}

$fileId = (int) $_GET['id'];
$userId = (int) $_SESSION['user_id'];

$sql = "
    SELECT filename, original_name
    FROM files
    WHERE id = ?
      AND (recipient_id = ? OR sender_id = ?)
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $fileId, $userId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(403);
    exit;
}

$file = $result->fetch_assoc();

$filePath = realpath(__DIR__ . '/../../uploads/' . $file['filename']);
if (!$filePath) {
    http_response_code(404);
    exit;
}

while (ob_get_level()) {
    ob_end_clean();
}

header('Content-Type: application/zip');
header(
    'Content-Disposition: attachment; filename="' .
    pathinfo($file['original_name'], PATHINFO_FILENAME) .
    '.zip"'
);
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');

readfile($filePath);
exit;
