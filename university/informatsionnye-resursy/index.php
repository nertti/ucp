<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Информационно-образовательная платформа");
?><?php $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'PACK_ID' => 'informatsionnye_resursy',
]); ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>