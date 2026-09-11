<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Лицензии, сертификаты и аттестаты");
$APPLICATION->SetTitle("Лицензии, сертификаты и аттестаты");
?><?php $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'PACK_ID' => '1_licenses',
]); ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>