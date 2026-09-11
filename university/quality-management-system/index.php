<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Система менеджмента качества");
?><?php $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'PACK_ID' => 'quality_management_system',
]); ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>