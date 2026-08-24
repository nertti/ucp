<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:rss.out", 
	".default", 
	array(
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "26",
		"SECTION_ID" => "108",
		"SECTION_CODE" => "",
		"NUM_NEWS" => "100",
		"NUM_DAYS" => "180",
		"RSS_TTL" => "60",
		"YANDEX" => "Y",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"CACHE_FILTER" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>