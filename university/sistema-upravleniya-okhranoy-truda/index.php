<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Система управления охраной труда");
?><?php $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'PACK_ID' => 'sistema_upravleniya_okhranoy_truda',
]); ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>