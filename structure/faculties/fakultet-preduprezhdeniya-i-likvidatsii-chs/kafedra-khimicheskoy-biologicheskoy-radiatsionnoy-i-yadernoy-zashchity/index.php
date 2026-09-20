<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Кафедра химической, биологической, радиационной и ядерной защиты");
?><? $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'IBLOCK_TYPE' => 'static_pages',
    'IBLOCK_CODE' => 'static_pages',
    'ELEMENT_CODE' => '2-1-5-kafedra-khimicheskoy-biologicheskoy-radiatsionnoy-i-yadernoy-zashchity-',
    'PROPERTY_CODE' => 'EDITOR',
    'SHOW_AREAS' => 'Y',
]); ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>