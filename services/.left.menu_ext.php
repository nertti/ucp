<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
    "IS_SEF" => "Y",
    "SEF_BASE_URL" => "/services/",
    "SECTION_PAGE_URL" => "?section[]=#SECTION_ID#",
    "DETAIL_PAGE_URL" => "#ELEMENT_CODE#/",
    "IBLOCK_TYPE" => "services",
    "IBLOCK_ID" => "79",
    "DEPTH_LEVEL" => "1",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "36000000",
    "SORT_BY" => "SORT",
    "SORT_ORDER" => "DESK",
),
    false
);
//
//pr($aMenuLinksExt);
$aMenuLinks = $aMenuLinksExt;
//$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>