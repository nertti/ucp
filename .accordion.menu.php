<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
 
global $APPLICATION;
 
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"custom:menu.sections", "", 
	array(
		"IS_SEF" => "Y",
		"ID" => $_REQUEST["ID"],
		"IBLOCK_TYPE" => "faculties",
		"IBLOCK_ID" => "8",
		"SECTION_URL" => "",
		"DEPTH_LEVEL" => "3",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"SEF_BASE_URL" => "/company/",
		"SECTION_PAGE_URL" => "#SECTION_CODE#/",
		"DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/"
	),
	false
);
 $aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>