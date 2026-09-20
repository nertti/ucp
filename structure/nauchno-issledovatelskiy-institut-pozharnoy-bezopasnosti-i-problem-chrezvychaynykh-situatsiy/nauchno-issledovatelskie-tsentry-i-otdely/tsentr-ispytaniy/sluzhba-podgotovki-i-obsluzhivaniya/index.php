<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Служба подготовки и обслуживания");
?><? $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'IBLOCK_TYPE' => 'static_pages',
    'IBLOCK_CODE' => 'static_pages',
    'ELEMENT_CODE' => '2-sluzhba-podgotovki-i-obsluzhivaniya',
    'PROPERTY_CODE' => 'EDITOR',
    'SHOW_AREAS' => 'Y',
]); ?>