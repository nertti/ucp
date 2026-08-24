<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интерактивные опросы");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:voting.list", 
	"custom", 
	array(
		"COMPONENT_TEMPLATE" => "custom",
		"CHANNEL_SID" => array(
			0 => "POLLS",
		),
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "3600",
		"VOTE_FORM_TEMPLATE" => "vote_new.php?VOTE_ID=#VOTE_ID#",
		"VOTE_RESULT_TEMPLATE" => "vote_result.php?VOTE_ID=#VOTE_ID#"
	),
	false
);?>

<?/*$APPLICATION->IncludeComponent(
	"bitrix:voting.current", 
	"custom", 
	array(
		"CHANNEL_SID" => "POLLS",
		"VOTE_ID" => "2",
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
);*/?> 

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>