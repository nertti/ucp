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
<ul class="players">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>210, 'height'=>240), BX_RESIZE_IMAGE_EXACT, true);
	?>
	<li>
		<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$file['src']?>" alt="<?echo $arItem["NAME"]?>"></a>
		<h2><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h2>
		<?if($arItem["PROPERTIES"]["STATUS"]["VALUE_ENUM_ID"]==110):?>
			<p><strong>Капитан</strong></p>
		<?else:?>
			<p>Дата рождения: <strong><?=$arItem["PROPERTIES"]["BDAY"]["VALUE"];?></strong></p>
			<p>Одиночный рейтинг: <strong><?=$arItem["PROPERTIES"]["RATING_SINGLE"]["VALUE"];?></strong></p>
			<p>Парный рейтинг: <strong><?=$arItem["PROPERTIES"]["RATING_DOUBLE"]["VALUE"];?></strong></p>
		<?endif;?>
	</li>
<?endforeach;?>
</ul>