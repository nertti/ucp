<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Опрос для студентов и слушателей факультета заочного обучения");
$APPLICATION->SetTitle("Опрос для студентов и слушателей факультета заочного обучения");
?>


<?$APPLICATION->IncludeComponent(
	"bitrix:voting.current", 
	"custom", 
	array(
		"CHANNEL_SID" => "POLLS",
		"VOTE_ID" => "3",
		"VOTE_ALL_RESULTS" => "Y",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "custom",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?> 

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>