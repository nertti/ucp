<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
	$query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
	if ($query) {
		$url .= '&succes=1';
	} else {
		$url .= '?succes=1';
	}
	$parsStep1 = explode("#FORM_", $arResult["DETAIL_TEXT"]);
	$parsStep2 = explode("#", $parsStep1[1]);
	ob_start();
	$APPLICATION->IncludeComponent(
		"bitrix:form", 
		"conf", 
		array(
			"SEF_MODE" => "Y",
			"WEB_FORM_ID" => $parsStep2[0],
			"RESULT_ID" => "",
			"START_PAGE" => "new",
			"SHOW_LIST_PAGE" => "N",
			"SHOW_EDIT_PAGE" => "N",
			"SHOW_VIEW_PAGE" => "N",
			"SUCCESS_URL" => $_SERVER['REQUEST_URI'].$url,
			"SHOW_ANSWER_VALUE" => "Y",
			"SHOW_ADDITIONAL" => "Y",
			"SHOW_STATUS" => "Y",
			"EDIT_ADDITIONAL" => "Y",
			"EDIT_STATUS" => "Y",
			"NOT_SHOW_FILTER" => array(
				0 => "",
				1 => "",
			),
			"NOT_SHOW_TABLE" => array(
				0 => "",
				1 => "",
			),
			"CHAIN_ITEM_TEXT" => "",
			"CHAIN_ITEM_LINK" => "",
			"IGNORE_CUSTOM_TEMPLATE" => "Y",
			"USE_EXTENDED_ERRORS" => "Y",
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => "3600",
			"AJAX_OPTION_JUMP" => "Y",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"SEF_FOLDER" => "",
			"COMPONENT_TEMPLATE" => "custom",
			"AJAX_OPTION_ADDITIONAL" => "",
			"SEF_URL_TEMPLATES" => array(
				"new" => "",
				"list" => "",
				"edit" => "",
				"view" => "",
			)
		),false
	);
	$out = ob_get_contents();
	ob_end_clean(); 
?>
<?if(!empty($_GET["succes"])){
			$arResult["DETAIL_TEXT"] = preg_replace("/#FORM_([A-Za-z-0-9]+)#/",GetMessage("FORM_DATA_SUCCES"),$arResult["DETAIL_TEXT"]);
		}else $arResult["DETAIL_TEXT"] = preg_replace("/#FORM_([A-Za-z-0-9]+)#/",$out,$arResult["DETAIL_TEXT"]);?>
<? 
	$parsStep1 = explode("#FILETREE_", $arResult["DETAIL_TEXT"]);
	$parsStep2 = explode("#", $parsStep1[1]); 
	ob_start();
	$APPLICATION->IncludeComponent(
		"r:filetree",
		"",
		Array(
			"ALLOWED_EXTENSIONS" => "jpg,png,gif,mp3,pdf,djvu,doc,docx,xls,xlsx,rar,zip",
			"ROOT_FOLDER" => $parsStep2[0]
		),false  
	);
	$outFileTree = ob_get_contents();
	ob_end_clean();   
	$arResult["DETAIL_TEXT"] = preg_replace("/#FILETREE_(.+)#/",$outFileTree,$arResult["DETAIL_TEXT"]);     
?>