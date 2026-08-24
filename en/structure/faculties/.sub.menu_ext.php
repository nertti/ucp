<?
/*
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if(CModule::IncludeModule("iblock"))
{

	$IBLOCK_ID = 8;        // указываем    

	$SectList = CIBlockSection::GetList($arSort, array("IBLOCK_ID"=>$IBLOCK_ID,"ACTIVE"=>"Y") ,false, array("ID","IBLOCK_ID","IBLOCK_TYPE_ID","IBLOCK_SECTION_ID","CODE","SECTION_ID","NAME","SECTION_PAGE_URL"));
	while ($SectListGet = $SectList->GetNext())
	{
		$aMenuLinksExt[] = Array(
				$SectListGet['NAME'],
				$SectListGet['SECTION_PAGE_URL'],
				Array(),
				Array(),
				""
		);
	} 



}  

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
*/
?>

<? /*
  if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
  global $APPLICATION; 
  $aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array( 
  "IS_SEF" => "Y", 
  "SEF_BASE_URL" => "/structure/faculties/", 
  "SECTION_PAGE_URL" => "#SECTION_CODE#/", 
  "DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#",   
  "IBLOCK_TYPE" => "faculties", 
  "IBLOCK_ID" => "8", 
  "DEPTH_LEVEL" => "4",  
  "CACHE_TYPE" => "N",  
  "CACHE_TIME" => "36000000" 
  ), 
false 
); 
  $aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks); */
  
?>

<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent(
	"custom:menu.sections.elements",
	 "", 
	 array(
		"IBLOCK_TYPE" => "faculties",
		"IBLOCK_ID" => "45",  
		"DEPTH_LEVEL" => "1",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000"
	),	false ); 
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>