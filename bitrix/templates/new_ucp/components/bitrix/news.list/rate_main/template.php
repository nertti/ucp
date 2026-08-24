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
<ul>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<li>
		<span><?=$arItem["PROPERTIES"]["RANK"]["VALUE"]?></span>
		<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
			<?$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>90, 'height'=>90), BX_RESIZE_IMAGE_EXACT, true); ?>
			<img src="<?=$file['src']?>" alt="<?=$arItem["NAME"]?>">
		<?else:?>
			<img src="/i/no_player.jpg" alt="<?=$arItem["NAME"]?>">
		<?endif;?>
		<strong><?=$arItem["NAME"]?></strong>
		<p><?=FormatDate('Q', MakeTimeStamp($arItem["PROPERTIES"]["BDAY"]["VALUE"]));?><i></i> Итоговые очки <?=$arItem["PROPERTIES"]["SCORE"]["VALUE"]?></p>
	</li>
<?endforeach;?>
</ul>
