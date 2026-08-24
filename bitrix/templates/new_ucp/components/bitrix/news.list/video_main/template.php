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
$i=1;
?>
<div class="wb main-video">
	<div class="mt">
		<!--div class="m-links">
			<a href="#">Белорусский теннис</a>
			<a href="#">Мировой теннис</a>
			<a href="#">Федерация</a>
			<a href="#">Интервью</a>
		</div-->
		<div class="m-title">
			<img src="/i/mt02.png" alt="">
			Белорусская федерация тенниса ТВ
		</div>
	</div>

	<div class="left">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		if($i==1)
		{
			$url_parts=pathinfo($arItem["PROPERTIES"]["YTUBE"]["~VALUE"]);
			if($arItem['PREVIEW_PICTURE']['ID'])
				$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>630, 'height'=>420), BX_RESIZE_IMAGE_EXACT, true);
			else
				$file['src'] = "https://i.ytimg.com/vi/".$url_parts['filename']."/sddefault.jpg";
			?>
			<aside>
				<div><?echo $arItem["NAME"]?></div>
				<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
				<p><?echo $arItem["PREVIEW_TEXT"];?></p>
				<a href="https://www.youtube.com/channel/UCQ8_vTvj2xEnV1TMTrPIcGg?view_as=subscriber" target="_blank">Официальный канал <br> на Youtube</a>
			</aside>
			<figure>
				<img src="<?=$file['src']?>" alt="<?echo $arItem["NAME"]?>">
				<div>
					<img src="/i/g2.png" alt="<?echo $arItem["NAME"]?>"> <?=intval($arItem['SHOW_COUNTER'])?>
				</div>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"></a>
			</figure>	
			</div>
			<div class="right" id="video-slider">
				<div><ul>
			<?
		}else{
			$url_parts=pathinfo($arItem["PROPERTIES"]["YTUBE"]["~VALUE"]);
			if($arItem['PREVIEW_PICTURE']['ID'])
				$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>110, 'height'=>90), BX_RESIZE_IMAGE_EXACT, true);
			else
				$file['src'] = "https://i.ytimg.com/vi/".$url_parts['filename']."/default.jpg";
			?>
			<li>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$file['src']?>" alt="<?echo $arItem["NAME"]?>"></a>
				<strong><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></strong>
				<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
			</li>	
			<?
		}
		?>
		<?$i++;?>
	<?endforeach;?>
			</ul>
		</div>
		<i></i>
		<em></em>
	</div>

	<div class="clear"></div>
</div>