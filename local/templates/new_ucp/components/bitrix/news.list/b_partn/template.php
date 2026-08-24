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
<div id="partners-slider">
	<div>
		<ul>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?if($arItem["PROPERTIES"]["F"]["VALUE"] == "ДА"):?>
			<li>
				<a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" target="_blank">
					<i><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?echo $arItem["NAME"]?>"></i>
					<?=$arItem["PROPERTIES"]["TYPE"]["VALUE"]?>
				</a>
			</li>
<?endif;?>
		<?endforeach;?>
		</ul>
	</div>
	<i></i>
	<em></em>
</div>
