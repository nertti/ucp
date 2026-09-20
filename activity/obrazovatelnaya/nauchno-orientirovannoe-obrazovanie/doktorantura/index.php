<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Докторантура");
?><? $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'IBLOCK_TYPE' => 'static_pages',
    'IBLOCK_CODE' => 'static_pages',
    'ELEMENT_CODE' => '3-1-3-nauchno-orientirovannoe-obrazovanie-doktorantura',
    'PROPERTY_CODE' => 'EDITOR',
    'SHOW_AREAS' => 'Y',
]); ?>