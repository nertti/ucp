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
<div class="m-title"><a href="/novosti/intervyu/">Интервью</a></div>
<ul>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	if($arItem['PREVIEW_PICTURE']['ID'])
		$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>170, 'height'=>140), BX_RESIZE_IMAGE_EXACT, true);
	else
		$file['src']='/i/no-photo.jpg';
	?>
	<li>
		<img src="<?=$file['src']?>" alt="<?echo $arItem["NAME"]?>">
		<strong><?echo $arItem["NAME"]?></strong>
		<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?><span><img src="/i/gb2.png" alt=""> <?=intval($arItem['SHOW_COUNTER'])?></span></span>
		<p><?echo $arItem["PREVIEW_TEXT"];?></p>
		<p><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Далее</a></p>
	</li>
<?endforeach;?>
</ul>
<aside>
	<a href="#">Предыдущее интервью</a>
	<a href="#">Следующее интервью</a>
</aside>