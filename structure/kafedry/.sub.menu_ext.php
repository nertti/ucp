<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent(
	"custom:menu.sections.elements",
	 "",
	 array(
		"IBLOCK_TYPE" => "faculties",
		"IBLOCK_ID" => "20",
		"DEPTH_LEVEL" => "1",
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "3600"
	),	false );
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>