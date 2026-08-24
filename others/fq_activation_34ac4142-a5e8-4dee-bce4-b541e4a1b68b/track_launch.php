<?php
// track_launch.php - Скрипт для фиксации запусков

// Выключаем вывод ошибок, чтобы не мешать клиенту
ini_set('display_errors', 0);
error_reporting(0);

// Функция для получения реального IP-адреса
function get_client_ip() {
    $ip = 'Неизвестно';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Проверяем, что к нам пришел POST-запрос
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    exit('ERROR: Только POST-запросы разрешены.');
}

$hwid = $_POST['hwid'] ?? '';
if (empty($hwid)) {
    http_response_code(400); // Bad Request
    exit('ERROR: HWID не передан.');
}

// Очищаем HWID
$hwid = preg_replace('/[^A-Za-z0-9_-]/', '', $hwid);

// --- ШАГ 1: Запись в общий лог запусков ---
$general_log_file = __DIR__ . '/launch_log.txt';
$log_entry = date('Y-m-d H:i:s') . " | HWID: " . $hwid . " | IP: " . get_client_ip() . "\n";
@file_put_contents($general_log_file, $log_entry, FILE_APPEND);

// --- ШАГ 2: Увеличение индивидуального счетчика ---
$user_folder = __DIR__ . '/results/' . $hwid;
$counter_file = $user_folder . '/counter.txt';

// Важно: увеличиваем счетчик, только если папка для этого HWID уже существует (т.е. мы выдали ему ключ)
if (is_dir($user_folder)) {
    $counter = 0;
    
    // Блокируем файл, чтобы избежать гонки потоков (если вдруг придет два запроса одновременно)
    $handle = fopen($counter_file, 'c+');
    if ($handle && flock($handle, LOCK_EX)) {
        $current_val = trim(fread($handle, 1024));
        if (is_numeric($current_val)) {
            $counter = (int)$current_val;
        }
        
        $counter++;
        
        // Очищаем файл и записываем новое значение
        ftruncate($handle, 0);
        rewind($handle);
        fwrite($handle, $counter);
        
        flock($handle, LOCK_UN); // Снимаем блокировку
        fclose($handle);
    }
}

// Отвечаем клиенту, что все в порядке
echo "OK";
?>