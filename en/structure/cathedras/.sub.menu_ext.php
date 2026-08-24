<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent(
	"custom:menu.sections.elements",
	 "", 
	 array(
		"IBLOCK_TYPE" => "faculties",
		"IBLOCK_ID" => "46",  
		"DEPTH_LEVEL" => "1",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000"
	),	false ); 
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>