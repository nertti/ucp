<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Политика в отношении обработки персональных данных");
?><?php $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'PACK_ID' => 'politika_personalnykh_dannykh',
]); ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>