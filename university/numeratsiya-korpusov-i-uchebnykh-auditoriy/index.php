<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Нумерация корпусов и учебных аудиторий");
?><?php $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'PACK_ID' => 'numeratsiya_korpusov',
]); ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>