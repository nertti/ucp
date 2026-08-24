<?php
declare(strict_types=1);

/**
 * Watchdog-эндпоинт для мониторинга связи «локальная сеть -> VPS».
 * Локальный сервер периодически обращается к https://domain.by/oth/watchdog,
 * скрипт записывает текущее время в файл состояния. Время последнего
 * обращения проверяет monitor.sh на VPS.
 *
 * Файлы состояния (watchdog.state, .token) лежат рядом с этим скриптом.
 */

const DEFAULT_STATE_FILE = __DIR__ . '/watchdog.state';
const DEFAULT_TOKEN_FILE = __DIR__ . '/.token';

$stateFile = getenv('WATCHDOG_STATE_FILE') ?: DEFAULT_STATE_FILE;

// Опциональный токен: если задан (env WATCHDOG_TOKEN или файл .token),
// принимать запросы только с корректным параметром ?token=...
$token = (string) getenv('WATCHDOG_TOKEN');
if ($token === '') {
    $tokenFile = getenv('WATCHDOG_TOKEN_FILE') ?: DEFAULT_TOKEN_FILE;
    if (is_readable($tokenFile)) {
        $token = trim((string) @file_get_contents($tokenFile));
    }
}
if ($token !== '') {
    if (!is_string($_GET['token'] ?? null) || !hash_equals($token, $_GET['token'])) {
        http_response_code(403);
        exit('forbidden');
    }
}

$stateDir = dirname($stateFile);
if (!is_dir($stateDir) && !@mkdir($stateDir, 0750, true)) {
    http_response_code(500);
    exit('state dir unavailable');
}

if (@file_put_contents($stateFile, (string) time(), LOCK_EX) === false) {
    http_response_code(500);
    exit('state file unavailable');
}

header('Content-Type: text/plain; charset=utf-8');
echo 'OK ' . date('c') . "\n";