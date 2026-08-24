<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контакты");
$APPLICATION->SetTitle("Контакты");?>

<?
    $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "tree",
        array(
            "ROOT_MENU_TYPE" => "sub",
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "top",
            "USE_EXT" => "Y",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "Y",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "COMPONENT_TEMPLATE" => "tree",
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "AUTO"
        ),
        false
    );


?>


 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>