<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Факультет предупреждения и ликвидации чрезвычайных ситуаций");
?><? $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'IBLOCK_TYPE' => 'static_pages',
    'IBLOCK_CODE' => 'static_pages',
    'ELEMENT_CODE' => '2-1-1-fakultet-preduprezhdeniya-i-likvidatsii-chrezvychaynykh-situatsiy',
    'PROPERTY_CODE' => 'EDITOR',
    'SHOW_AREAS' => 'Y',
]); ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>