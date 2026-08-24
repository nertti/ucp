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
	$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>367, 'height'=>300), BX_RESIZE_IMAGE_EXACT, true);
	?>
	<li>
		<img src="<?=$file['src']?>" alt="<?echo $arItem["NAME"]?>">
		<strong><?echo $arItem["NAME"]?></strong>
		<div>
			<img src="/i/g1.png" alt=""> <?=count($arItem['PROPERTIES']['PHOTOS']['VALUE'])?>
			<img src="/i/g2.png" alt=""> <?=intval($arItem['SHOW_COUNTER'])?>
		</div>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"></a>
	</li>
<?endforeach;?>