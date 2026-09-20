<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Отдел кадров");
?><? $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'IBLOCK_TYPE' => 'static_pages',
    'IBLOCK_CODE' => 'static_pages',
    'ELEMENT_CODE' => '2-8-3-otdel-kadrov',
    'PROPERTY_CODE' => 'EDITOR',
    'SHOW_AREAS' => 'Y',
]); ?>
