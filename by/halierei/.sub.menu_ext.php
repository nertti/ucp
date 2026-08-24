<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if(CModule::IncludeModule("iblock"))
{

	$IBLOCK_ID = 64;        // указываем

	$arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', 'DEPTH_LEVEL'=>'1'); 
	$db_list = CIBlockSection::GetList(Array('SORT'=> 'ASC'), $arFilter, true);
	while($ar_result = $db_list->GetNext()){
		
	  	$aMenuLinksExt[] = Array(
				$ar_result['NAME'],
				$ar_result['SECTION_PAGE_URL'],
				Array(),
				Array(),
				""
		);
	}

}  

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);

?>

