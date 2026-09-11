<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Кафедра ликвидации чрезвычайных ситуаций");
?><?php $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'PACK_ID' => 'kafedra_likvidatsii_chs',
]); ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>