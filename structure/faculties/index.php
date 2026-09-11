<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Факультеты");
$APPLICATION->SetTitle("Факультеты");
?><?php $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'PACK_ID' => 'faculties',
]); ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>