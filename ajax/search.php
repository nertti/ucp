<?php

define('STOP_STATISTICS', true);
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('PUBLIC_AJAX_MODE', true);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

$query = trim((string)($_GET['q'] ?? ''));

if (mb_strlen($query) < 2) {
    header('Content-Type: application/json; charset=UTF-8');

    echo json_encode([
        'success' => true,
        'items' => [],
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

$APPLICATION->IncludeComponent(
    'bitrix:search.page',
    'ajax',
    [
        'RESTART' => 'Y',
        'NO_WORD_LOGIC' => 'N',
        'USE_LANGUAGE_GUESS' => 'Y',
        'CHECK_DATES' => 'Y',
        'arrFILTER' => [],
        'SHOW_WHERE' => 'N',
        'SHOW_WHEN' => 'N',
        'PAGE_RESULT_COUNT' => 10,
        'CACHE_TYPE' => 'N',
        'DEFAULT_SORT' => 'rank',
        'QUERY' => $query,
    ],
    false
);