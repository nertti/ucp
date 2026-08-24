<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<?php foreach($arResult["ITEMS"] as $arItem):?>
	<?php
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
	<div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="news__slider-wrapper">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__slider-img">
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="Image" title="<?=$arItem["NAME"]?>" />
			</a>
			<div class="news__slider-action">
				<button class="news__slider-button-prev swiper-button-prev">
					<iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver></iconify-icon>
				</button>
				<button class="news__slider-button-next swiper-button-next">
					<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
				</button>
			</div>
		</div>
		<div class="news__slider-content">
			<div class="news__slider-info">
				<h2 class="title-two">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
				</h2>
				<p class="text">
					<?=$arItem["PREVIEW_TEXT"]?>
				</p>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="button-detail">
					<span>Подробне</span>
					<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
				</a>
			</div>
		</div>
	</div>
	
<?php endforeach;?>