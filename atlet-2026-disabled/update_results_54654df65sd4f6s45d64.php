<?php
// update_results.php — ИСПРАВЛЕННАЯ ВЕРСИЯ ДЛЯ MULTIPART
$dir = __DIR__ . '/data';
if (!is_dir($dir)) mkdir($dir, 0755, true);

$html = '';

// 1. Пытаемся получить через $_POST
if (isset($_POST['html'])) {
    $html = $_POST['html'];
} 
// 2. Если не получилось — парсим multipart вручную
else {
    $raw = file_get_contents('php://input');
    // Простой способ извлечь содержимое между boundary
    if (preg_match('/name="html"(?:\r\n|\n)(?:\r\n|\n)(.*)(?:\r\n|\n)--/s', $raw, $matches)) {
        $html = $matches[1];
    } else {
        $html = $raw;
    }
}

// Сохраняем
if (!empty($html)) {
    file_put_contents($dir . '/latest.html', $html);
    echo "success";
} else {
    http_response_code(400);
    echo "No data received";
}
?>