<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

header('Content-Type: application/json; charset=UTF-8');

$items = [];

foreach ($arResult['SEARCH'] as $item) {
    $items[] = [
            'id' => (int)$item['ITEM_ID'],
            'name' => $item['TITLE'],
            'url' => $item['URL'],
    ];
}

echo json_encode([
        'success' => true,
        'items' => $items,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);