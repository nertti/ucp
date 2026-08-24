<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetTitle("Форма опроса");
?><?$APPLICATION->IncludeComponent(
	"bitrix:voting.form", 
	"custom", 
	array(
		"VOTE_ID" => $_REQUEST["VOTE_ID"],
		"VOTE_RESULT_TEMPLATE" => "vote_result.php?VOTE_ID=#VOTE_ID#",
		"COMPONENT_TEMPLATE" => "custom",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>