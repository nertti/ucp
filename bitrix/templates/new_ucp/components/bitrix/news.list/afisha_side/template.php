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
<div class="m-title"><a href="/novosti/afisha/">Афиша</a></div>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>450, 'height'=>620), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
	<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$file["src"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"></a>
<?endforeach;?>