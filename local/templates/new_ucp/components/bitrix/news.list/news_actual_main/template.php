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
<section class="quick-news">
	<div class="m-title"><a href="/novosti/aktualno/">Актуально</a></div>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
		<span>
			<?=$arItem["DISPLAY_ACTIVE_FROM"]?>
			<span><img src="/i/gb2.png" alt=""> <?=intval($arItem['SHOW_COUNTER'])?></span>
		</span>
	</div>
<?endforeach;?>
</section>