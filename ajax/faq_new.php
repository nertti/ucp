<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

$return = new stdClass();

$msg = htmlspecialchars($_POST['msg']);
$sid = $_POST['sid'];
$code = $_POST['code'];

if (!$APPLICATION->CaptchaCheckCode($code, $sid)) {
	$return->error = 'Неправильно введены символы с картинки';
}

$el = new CIBlockElement;
$data = array(
	'ACTIVE' => 'N',
	'ACTIVE_FROM' => ConvertTimeStamp(),
	'NAME' => time(),
	'IBLOCK_ID' => 54,
	'PREVIEW_TEXT' => $msg,
);

$return->id = $el->Add($data);

$itemLink = 'http://' . $_SERVER['SERVER_NAME'] . '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=54';
$itemLink .= '&type=faq&ID=' . $return->id . '&lang=ru&find_section_section=-1&WF=Y';

$arFields = Array(
	'EMAIL_TO' => COption::GetOptionString('main', 'email_from'),
	'MSG' => $msg,
	'ITEM_LINK' => $itemLink,
);
CEvent::Send('NEW_FAQ', SITE_ID, $arFields);

echo json_encode($return);