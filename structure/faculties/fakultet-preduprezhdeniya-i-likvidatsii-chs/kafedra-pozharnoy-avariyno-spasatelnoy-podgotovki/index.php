<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetTitle("Кафедра пожарной аварийно-спасательной подготовки");
?><? $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'IBLOCK_TYPE' => 'static_pages',
    'IBLOCK_CODE' => 'static_pages',
    'ELEMENT_CODE' => '2-1-3-kafedra-pozharnoy-avariyno-spasatelnoy-podgotovki',
    'PROPERTY_CODE' => 'EDITOR',
    'SHOW_AREAS' => 'Y',
]); ?>
