<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Отдел научной и инновационной деятельности");
?><? $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'IBLOCK_TYPE' => 'static_pages',
    'IBLOCK_CODE' => 'static_pages',
    'ELEMENT_CODE' => '2-8-5-otdel-nauchnoy-i-innovatsionnoy-deyatelnosti-',
    'PROPERTY_CODE' => 'EDITOR',
    'SHOW_AREAS' => 'Y',
]); ?>
