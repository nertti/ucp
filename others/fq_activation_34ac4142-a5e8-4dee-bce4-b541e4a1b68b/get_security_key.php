<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

// ================= НАСТРОЙКИ =================
$admin_email = 'tsit@ucp.by'; 
$from_email = 'noreply@' . ($_SERVER['HTTP_HOST'] ?? 'ucp.by');

$log_file = __DIR__ . '/requests_log.txt';         // Лог заявок на активацию
$launches_log = __DIR__ . '/launches_log.txt';     // Общий лог всех запусков
$debug_log_file = __DIR__ . '/mail_debug_log.txt';
// ==============================================

function debug_log($msg) {
    global $debug_log_file;
    $timestamp = date('Y-m-d H:i:s');
    @file_put_contents($debug_log_file, "[$timestamp] $msg\n", FILE_APPEND);
}

function get_client_ip() {
    $ip = 'Неизвестно';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_list = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim($ip_list[0]);
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function send_mail_reliable($to, $from, $subject, $message) {
    $headers  = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "Return-Path: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    debug_log("----------------------------------------");
    debug_log("Начинаем отправку письма на $to...");

    error_clear_last();
    $mail_success = @mail($to, $subject, $message, $headers);
    if ($mail_success) {
        debug_log("УСПЕХ: Письмо отправлено через стандартную функцию mail().");
        return true;
    } else {
        $error = error_get_last();
        $err_msg = $error ? $error['message'] : 'Неизвестная ошибка';
        debug_log("ОШИБКА Способ 1 (mail): $err_msg");
    }

    $sendmail_paths = ['/usr/sbin/sendmail', '/usr/lib/sendmail', '/usr/bin/sendmail'];
    $sendmail_bin = null;
    foreach ($sendmail_paths as $path) {
        if (@file_exists($path) && @is_executable($path)) {
            $sendmail_bin = $path;
            break;
        }
    }
    if ($sendmail_bin) {
        $full_email = "To: $to\nSubject: $subject\n$headers\n\n$message";
        $handle = @popen("$sendmail_bin -t -i", "w");
        if ($handle) {
            fwrite($handle, $full_email);
            if (pclose($handle) === 0) {
                debug_log("УСПЕХ: Письмо отправлено через вызов $sendmail_bin.");
                return true;
            }
        }
    }

    $smtp_conn = @fsockopen("127.0.0.1", 25, $errno, $errstr, 5);
    if ($smtp_conn) {
        stream_set_timeout($smtp_conn, 5);
        fgets($smtp_conn, 515); fputs($smtp_conn, "HELO localhost\r\n");
        fgets($smtp_conn, 515); fputs($smtp_conn, "MAIL FROM: <$from>\r\n");
        fgets($smtp_conn, 515); fputs($smtp_conn, "RCPT TO: <$to>\r\n");
        fgets($smtp_conn, 515); fputs($smtp_conn, "DATA\r\n");
        fgets($smtp_conn, 515); fputs($smtp_conn, "To: $to\r\nSubject: $subject\r\n$headers\r\n\r\n$message\r\n.\r\n");
        fgets($smtp_conn, 515); fputs($smtp_conn, "QUIT\r\n");
        fclose($smtp_conn);
        debug_log("УСПЕХ: Письмо передано в локальный SMTP сервер.");
        return true;
    }

    debug_log("КРИТИЧЕСКАЯ ОШИБКА: Все способы отправки провалились.");
    return false;
}

// ================= ОСНОВНАЯ ЛОГИКА =================
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? 'activate';
        $hwid = $_POST['hwid'] ?? '';
        
        if (empty($hwid)) {
            echo "ERROR_EMPTY_HWID";
            exit;
        }

        $hwid = preg_replace('/[^A-Za-z0-9_-]/', '', $hwid);
        $client_ip = get_client_ip();
        $server_time = date('Y-m-d H:i:s');

        // =========================================================
        // РЕЖИМ 1: ФИКСАЦИЯ ЗАПУСКА ИГРЫ (ping)
        // =========================================================
        if ($action === 'ping') {
            // 1. Пишем в общий лог запусков
            $log_line = "[$server_time] HWID: $hwid | IP: $client_ip\n";
            @file_put_contents($launches_log, $log_line, FILE_APPEND);
            
            // 2. Создаём папку results/HWID/, если её ещё нет
            $dir = __DIR__ . '/results/' . $hwid;
            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }
            
            // 3. Увеличиваем счётчик в файле counter.txt
            $counter_file = $dir . '/counter.txt';
            $count = 0;
            if (file_exists($counter_file)) {
                $count = (int)trim(file_get_contents($counter_file));
            }
            $count++;
            @file_put_contents($counter_file, (string)$count);
            
            echo "PING_OK";
            exit;
        }

        // =========================================================
        // РЕЖИМ 2: ЗАПРОС НА АКТИВАЦИЮ (activate)
        // =========================================================
        if ($action === 'activate') {
            $sysinfo = $_POST['sysinfo'] ?? '';
            $first_name = $_POST['name'] ?? 'Не указано';
            $last_name = $_POST['surname'] ?? 'Не указано';
            $organization = $_POST['organization'] ?? 'Не указано';
            $email = $_POST['email'] ?? 'Не указано';

            $log_content = "=== Запрос на ключ ===\n";
            $log_content .= "Дата (сервер): " . $server_time . "\n";
            $log_content .= "IP-адрес: " . $client_ip . "\n";
            $log_content .= "Пользователь: " . $first_name . " " . $last_name . "\n";
            $log_content .= "Организация: " . $organization . "\n";
            $log_content .= "E-mail для связи: " . $email . "\n";
            $log_content .= "HWID: " . $hwid . "\n\n";
            $log_content .= "[Система ПК]:\n" . $sysinfo . "\n";
            $log_content .= "--------------------------------------\n\n";

            @file_put_contents($log_file, $log_content, FILE_APPEND);

            $subject = 'Ключ для: ' . $first_name . ' ' . $last_name . ' (' . $hwid . ')';
            $message_body = "Новый запрос на активацию программы от пользователя.\n\n" . $log_content;
            
            $mail_status = send_mail_reliable($admin_email, $from_email, $subject, $message_body);

            if ($mail_status) {
                echo "OK";
            } else {
                echo "WARNING_MAIL_FAILED";
            }
            exit;
        }
    } else {
        echo "ERROR_NOT_POST";
    }
} catch (Exception $e) {
    debug_log("Фатальная ошибка PHP: " . $e->getMessage());
    echo "ERROR_FATAL";
}
?>