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
<div class="wb main-video">
	<div class="mt">
		<div class="m-title">
			<img src="/i/mt02.png" alt="">
			Белорусская федерация тенниса ТВ
		</div>
	</div>

	<div id="vs">
		<div>
			<ul>
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$url_parts=pathinfo($arItem["PROPERTIES"]["YTUBE"]["~VALUE"]);
				if($arItem['PREVIEW_PICTURE']['ID'])
					$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>450, 'height'=>330), BX_RESIZE_IMAGE_EXACT, true);
				else
					$file['src'] = "https://i.ytimg.com/vi/".$url_parts['filename']."/sddefault.jpg";
				?>
				<li>
					<img src="<?=$file['src']?>" alt="<?echo $arItem["NAME"]?>">
					<div>
						<img src="/i/g2.png" alt=""> <?=intval($arItem['SHOW_COUNTER'])?>
					</div>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"></a>
				</li>
			<?endforeach;?>
			</ul>
		</div>
		<i></i>
		<em></em>
		<section></section>
	</div>
</div>