<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Экспертная деятельность");
?><?
$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"tree", 
	array(
		"COMPONENT_TEMPLATE" => "tree",
		"ROOT_MENU_TYPE" => "sub",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "sub",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>