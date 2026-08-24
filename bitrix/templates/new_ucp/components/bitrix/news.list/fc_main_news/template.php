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
<div id="top-slider" class="left">
<ul>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
	$arSect = $res->GetNext();
	if($arItem['PREVIEW_PICTURE']['ID'])
		$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>1080, 'height'=>601), BX_RESIZE_IMAGE_EXACT, true);
	else
		$file['src']='/i/no-photo.jpg';
	?>
	<li>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<img src="<?=$file['src']?>" alt="<?echo $arItem["NAME"]?>">
			<span>
				<strong><?echo $arItem["NAME"]?></strong>
				<?echo $arItem["NAME"]?>
			</span>
		</a>
	</li>
<?endforeach;?>
</ul>
<i></i>
<em></em>
<section></section>
</div>