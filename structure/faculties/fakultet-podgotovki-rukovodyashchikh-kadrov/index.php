<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Факультет подготовки руководящих кадров");
?><?php $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'PACK_ID' => 'akultet_podgotovki_rukovodyashchikh_kadrov',
]); ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>