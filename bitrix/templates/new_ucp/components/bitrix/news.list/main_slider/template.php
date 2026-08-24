<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="home__feed-news-content">
<div class="home__feed-news-slider swiper">
<div class="swiper-wrapper">
<?php foreach($arResult["ITEMS"] as $arItem):?>
	<?php
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
	<div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<div class="home__feed-news-slider-img">
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="Image" title="<?=$arItem["NAME"]?>" />
				<?php if($arItem["DISPLAY_PROPERTIES"]["IS_MAIN"]["VALUE"] == "Y"):?>
					<div class="label">
						<span>Главная новость</span>
					</div>
				<?php endif;?>
			</div>
			<div class="home__feed-news-slider-info">
				<div class="date">
					<iconify-icon icon="lsicon:calendar-outline" width="18" height="18" noobserver></iconify-icon>
					<span><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
				</div>
				<h4 class="title-four">
					<?=$arItem["NAME"]?>
				</h4>
				<p class="text-caption">
					<?=$arItem["PREVIEW_TEXT"]?>
				</p>
			</div>
		</a>
	</div>

<?php endforeach;?>
</div>
<div class="home__feed-news-slider-action-mobile"></div>
<div class="home__feed-news-slider-action" data-da=".home__feed-news-slider-action-mobile,1024, 1">
<button class="home__feed-news-slider-button-prev swiper-button-prev">
<iconify-icon icon="lucide:chevron-left" width="30" height="30" noobserver></iconify-icon>
</button>
<div class="home__feed-news-slider-pagination"></div>
<button class="home__feed-news-slider-button-next swiper-button-next">
<iconify-icon icon="lucide:chevron-right" width="30" height="30" noobserver></iconify-icon>
</button>
</div>
</div>