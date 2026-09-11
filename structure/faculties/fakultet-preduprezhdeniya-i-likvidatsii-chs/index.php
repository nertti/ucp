<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Факультет предупреждения и ликвидации чрезвычайных ситуаций");
?><?php $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'PACK_ID' => 'FPiLCHS',
]); ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>