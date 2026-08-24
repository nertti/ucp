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
	if($arItem['PREVIEW_PICTURE']['ID'])
		$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>110, 'height'=>90), BX_RESIZE_IMAGE_EXACT, true);
	else
		$file['src']='/i/no-photo.jpg';
	?>
	<li>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$file['src']?>" alt="<?echo $arItem["NAME"]?>"></a>
		<h2><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h2>
		<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<p><?echo $arItem["PREVIEW_TEXT"];?></p>
	</li>
<?endforeach;?>