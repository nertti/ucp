
<?php
// ================= НАСТРОЙКИ =================
$allowed_ip   = '79.98.53.247';
$auth_token   = 'SuperSecretToken_192_168_14_144_XyZ!@#'; // Придумайте сложный токен
$dest_dir     = '/var/www/ucp.by/data/www/ucp.by/upload/abiturient/priemnaya-kampaniya/';
$allowed_exts = ['pdf', 'rar'];
// =============================================

// 1. Проверка IP-адреса
$client_ip = $_SERVER['REMOTE_ADDR'] ?? '';
// Обработка случая, если PHP за прокси и IP пришел в IPv6 формате
if (strpos($client_ip, '::ffff:') === 0) {
    $client_ip = substr($client_ip, 7);
}

if ($client_ip !== $allowed_ip) {
    http_response_code(403);
    header('Content-Type: application/json');
    die(json_encode(['status' => 'error', 'message' => 'Forbidden IP']));
}

// 2. Проверка Токена (читаем из заголовка X-Auth-Token)
$token = $_SERVER['HTTP_X_AUTH_TOKEN'] ?? '';
if ($token !== $auth_token) {
    http_response_code(401);
    header('Content-Type: application/json');
    die(json_encode(['status' => 'error', 'message' => 'Unauthorized']));
}

$action = $_GET['action'] ?? '';

if ($action === 'check') {
    // Чтение JSON из тела запроса
    $input = json_decode(file_get_contents('php://input'), true);
    $files_to_check = $input['files'] ?? [];
    $to_upload = [];

    foreach ($files_to_check as $file) {
        // basename защищает от directory traversal атак (например, если имя файла "../../etc/passwd")
        $name = basename($file['name']); 
        $path = $dest_dir . $name;

        if (!file_exists($path)) {
            $to_upload[] = $name;
        } else {
            // Быстрая проверка: если размер отличается, файл точно изменился
            if (filesize($path) != $file['size']) {
                $to_upload[] = $name;
            } else {
                // Медленная проверка: если размер совпадает, проверяем хэш
                if (md5_file($path) !== $file['hash']) {
                    $to_upload[] = $name;
                }
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode(['status' => 'ok', 'to_upload' => $to_upload]);

} elseif ($action === 'upload') {
    if (empty($_FILES['file'])) {
        http_response_code(400);
        header('Content-Type: application/json');
        die(json_encode(['status' => 'error', 'message' => 'No file provided']));
    }

    $file = $_FILES['file'];
    $name = basename($file['name']);
    $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_exts)) {
        http_response_code(400);
        header('Content-Type: application/json');
        die(json_encode(['status' => 'error', 'message' => 'Invalid file extension']));
    }

    $dest_path = $dest_dir . $name;
    
    if (move_uploaded_file($file['tmp_name'], $dest_path)) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'message' => 'File uploaded successfully']);
    } else {
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Failed to move uploaded file']);
    }

} else {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
}
?>