<?php
// update_results.php — ФИНАЛЬНАЯ ВЕРСИЯ
$dir = __DIR__ . '/data';
if (!is_dir($dir)) mkdir($dir, 0755, true);

$timestamp = date('Y-m-d_H-i-s');

$jsonRaw = $_POST['json'] ?? file_get_contents('php://input');

// Убираем префикс "json=", если он есть
if (strpos($jsonRaw, 'json=') === 0) {
    $jsonRaw = substr($jsonRaw, 5);
}

// Декодируем URL-encoding
$jsonRaw = urldecode($jsonRaw);

// Убираем возможные BOM и лишние пробелы
$jsonRaw = trim($jsonRaw, "\xEF\xBB\xBF \n\r\t");

file_put_contents($dir . "/debug_{$timestamp}.log", 
    "TIME: " . date('H:i:s') . "\n" .
    "LENGTH: " . strlen($jsonRaw) . " bytes\n\n" .
    $jsonRaw
);

if (empty($jsonRaw)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Empty data']);
    exit;
}

$data = json_decode($jsonRaw, true);

if ($data === null) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error', 
        'message' => 'Invalid JSON after cleaning',
        'error' => json_last_error_msg(),
        'starts_with' => substr($jsonRaw, 0, 100)
    ]);
    exit;
}

// Успех!
$data['received_at'] = date('Y-m-d H:i:s');

file_put_contents($dir . '/latest.json', json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

echo json_encode([
    'status' => 'success', 
    'message' => 'Results updated',
    'count' => count($data['participants'] ?? [])
]);
?>