<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$arHomeItems = array();
$arHomeIds = array(); 

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE", "SHOW_COUNTER", "IBLOCK_SECTION_ID");
$arFilter = Array(
    "IBLOCK_ID" => Array(2, 6, 42, 3, 4,45),
    "ACTIVE_DATE" => "Y", 
    "ACTIVE" => "Y",
    "PROPERTY_HOME_VALUE" => "ДА"
);
$res = CIBlockElement::GetList(
    Array("SORT" => "ASC"),
    $arFilter, 
    false, 
    Array(), 
    $arSelect
);

while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arHomeItems[] = $arFields;
    $arHomeIds[] = $arFields['ID'];
}
?>
<?foreach($arHomeItems as $arItem):?>
	<?
	$res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
	$arSect = $res->GetNext();
	if($arItem['PREVIEW_PICTURE'])
		$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>367, 'height'=>300), BX_RESIZE_IMAGE_EXACT, true);
	else
		$file['src']='/i/no-photo.jpg';
	?>
	<li>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<img src="<?=$file['src']?>" alt="<?echo $arItem["NAME"]?>">
			<strong><?echo $arItem["NAME"]?></strong>
			<span><img src="/i/g2.png" alt=""> <?=intval($arItem['SHOW_COUNTER'])?></span>
		</a>
	</li>
<?endforeach;?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	if(in_array($arItem["ID"], $arHomeIds)) continue;
	
	$res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
	$arSect = $res->GetNext();
	if($arItem['PREVIEW_PICTURE']['ID'])
		$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>367, 'height'=>300), BX_RESIZE_IMAGE_EXACT, true);
	else
		$file['src']='/i/no-photo.jpg';
	?>
	<li>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<img src="<?=$file['src']?>" alt="<?echo $arItem["NAME"]?>">
			<strong><?echo $arItem["NAME"]?></strong>
			<span><img src="/i/g2.png" alt=""> <?=intval($arItem['SHOW_COUNTER'])?></span>
		</a>
	</li>
<?endforeach;?>