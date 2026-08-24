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
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
	$arSect = $res->GetNext();
	if($arItem['PREVIEW_PICTURE']['ID'])
		$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>734, 'height'=>601), BX_RESIZE_IMAGE_EXACT, true);
	else
		$file['src']='/i/no-photo.jpg';
	?>
	<li>
<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
	<img src="<?=$file['src']?>" alt="<?echo $arItem["NAME"]?>">
		<div>
			<strong><?echo $arItem["NAME"]?></strong>
			
			<p><?echo $arItem["PREVIEW_TEXT"];?></p>

			<span><img src="/i/g2.png" alt=""> <?=intval($arItem['SHOW_COUNTER'])?></span>
		</div></a>
	</li>
<?endforeach;?>