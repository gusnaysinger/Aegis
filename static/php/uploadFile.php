<?php
session_start();
require_once 'connection.php';

//garante segurança para que nao seja possivel baixar arquivos de outro user
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    exit('Acesso negado');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Requisição inválida');
}

if (empty($_POST['recipient'])) {
    exit('Destinatário inválido');
}

$recipient = (int) $_POST['recipient'];
if ($recipient <= 0) {
    exit('Destinatário inválido');
}

//limita a 100mb
$MAX_SIZE = 100 * 1024 * 1024;

$tempBase  = __DIR__ . '/../../temp/';
$finalDir  = __DIR__ . '/../../uploads/';

@mkdir($tempBase, 0755, true);
@mkdir($finalDir, 0755, true);

if (!isset($_FILES['files']) || empty($_FILES['files']['name'][0])) {
    exit('Nenhum arquivo enviado');
}

$batchDir = $tempBase . uniqid('batch_', true) . '/';
mkdir($batchDir, 0755, true);

$originalNames = [];

//move arquivos
foreach ($_FILES['files']['name'] as $i => $name) {

    if ($_FILES['files']['error'][$i] !== UPLOAD_ERR_OK) {
        continue;
    }

    if ($_FILES['files']['size'][$i] > $MAX_SIZE) {
        continue;
    }

    $tmpName  = $_FILES['files']['tmp_name'][$i];
    $origName = basename($name);

    if (move_uploaded_file($tmpName, $batchDir . $origName)) {
        $originalNames[] = $origName;
    }
}

if (empty($originalNames)) {
    rmdir($batchDir);
    exit('Nenhum arquivo válido para upload');
}

//envia arquivos para o python compactar em um zip
$finalName = uniqid('file_', true) . '.zip';
$finalPath = $finalDir . $finalName;

$python = escapeshellarg('python');
$script = escapeshellarg(realpath(__DIR__ . '/../../scripts/compress.py'));
$input  = escapeshellarg(realpath($batchDir));
$output = escapeshellarg($finalPath);

$cmd = "$python $script $input $output";
exec($cmd, $outputLog, $returnCode);

if ($returnCode !== 0 || !file_exists($finalPath)) {
    array_map('unlink', glob($batchDir . '*'));
    rmdir($batchDir);
    exit('Erro ao compactar arquivos');
}

//limpa pasta temp
foreach (glob($batchDir . '*') as $file) {
    unlink($file);
}
rmdir($batchDir);

//envia informaçoes para o db
$displayName = count($originalNames) === 1
    ? $originalNames[0]
    : 'Pacote (' . count($originalNames) . ' arquivos)';

$sql = "INSERT INTO files (filename, original_name, recipient_id, sender_id)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssii",
    $finalName,
    $displayName,
    $recipient,
    $_SESSION['user_id']
);

$stmt->execute();

//retorna para pagina do usuario
header('Location: /Aegis/templates/user.php');
exit;
