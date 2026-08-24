<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список зарегистрированных");
?><style>
#left-column, #right-column, #header, .bx-breadcrumb{
	display: none;
}
#left-column + #content{
	width: 100%; 
}
</style>
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.list", 
	"conf", 
	array(
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_URL" => "result_edit.php",
		"NEW_URL" => "result_new.php",
		"NOT_SHOW_FILTER" => "",
		"NOT_SHOW_TABLE" => "",
		"SEF_MODE" => "N",
		"SHOW_ADDITIONAL" => "Y",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_STATUS" => "N",
		"VIEW_URL" => "result_view.php",
		"WEB_FORM_ID" => "",
		"COMPONENT_TEMPLATE" => "conf",
		"NAME_TEMPLATE" => ""
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>