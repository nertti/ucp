<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Университет");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"tree",
	Array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_NOTES" => "",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "Y",
		"COMPONENT_TEMPLATE" => "tree",
		"COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "news",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(0=>"",1=>"",),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "TEXT"
	)
);?>				
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>