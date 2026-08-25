<?php

define('STOP_STATISTICS', true);
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('PUBLIC_AJAX_MODE', true);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Main\Context;
use Bitrix\Main\Loader;

header('Content-Type: application/json; charset=UTF-8');

try {
    if (!Loader::includeModule('search')) {
        throw new \RuntimeException('Модуль search не подключен');
    }

    $request = Context::getCurrent()->getRequest();

    $query = trim((string)$request->get('q'));

    if (mb_strlen($query) < 2) {
        echo json_encode([
            'success' => true,
            'items' => [],
        ], JSON_UNESCAPED_UNICODE);

        exit;
    }

    // Ограничиваем длину поискового запроса
    $query = mb_substr($query, 0, 100);

    $search = new \CSearch();

    $search->Search([
        'QUERY' => $query,
        'SITE_ID' => SITE_ID,
        'CHECK_DATES' => 'Y',
    ]);

    $items = [];

    while ($result = $search->Fetch()) {
        $items[] = [
            'id' => (int)$result['ITEM_ID'],
            'name' => $result['TITLE'],
            'url' => $result['URL'],
        ];

        if (count($items) >= 10) {
            break;
        }
    }

    echo json_encode([
        'success' => true,
        'items' => $items,
    ], JSON_UNESCAPED_UNICODE);

} catch (\Throwable $e) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
}