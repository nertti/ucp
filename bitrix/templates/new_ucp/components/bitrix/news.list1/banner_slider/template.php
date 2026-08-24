<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<?php foreach($arResult["ITEMS"] as $arItem):?>
	<?php
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
	<?php if($arItem["DISPLAY_PROPERTIES"]["SLIDE_TYPE"]["VALUE"] == "video"):?>
		<div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="preview-slider-video">
				<video src="<?=$arItem["DISPLAY_PROPERTIES"]["VIDEO_URL"]["VALUE"]?>" autoplay playsinline loop></video>
			</div>
			<div class="preview-slider-logo-wrapper">
				<div class="home__container">
					<img src="<?=$arItem["DISPLAY_PROPERTIES"]["LOGO"]["VALUE"]?>" alt="image" title="<?=$arItem["NAME"]?>" class="preview-slider-logo" />
				</div>
			</div>
			<div class="preview-slider-video-mute-wrapper">
				<div class="home__container">
					<button class="preview-slider-video-mute" type="button">
						<iconify-icon icon="octicon:unmute-16" width="24" height="24" noobserver></iconify-icon>
					</button>
				</div>
			</div>
		</div>
	<?php elseif($arItem["DISPLAY_PROPERTIES"]["SLIDE_TYPE"]["VALUE"] == "image"):?>
		<div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="preview-slider-img">
				<img src="<?=$arItem["DISPLAY_PROPERTIES"]["IMAGE"]["VALUE"]?>" alt="Image" title="<?=$arItem["NAME"]?>" />
			</div>
			<div class="preview-slider-logo-wrapper">
				<div class="home__container">
					<img src="<?=$arItem["DISPLAY_PROPERTIES"]["LOGO"]["VALUE"]?>" alt="image" title="<?=$arItem["NAME"]?>" class="preview-slider-logo" />
				</div>
			</div>
		</div>
	<?php else:?>
		<div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="preview-slider-img">
				<img src="<?=$arItem["DISPLAY_PROPERTIES"]["IMAGE"]["VALUE"]?>" alt="Image" title="<?=$arItem["NAME"]?>" />
			</div>
			<div class="preview-slider-content">
				<div class="preview__container">
					<h1 class="title-one">
						<?=$arItem["DISPLAY_PROPERTIES"]["TITLE"]["VALUE"]?>
					</h1>
					<div class="preview-slider-content__action">
						<a href="<?=$arItem["DISPLAY_PROPERTIES"]["BUTTON_ENTER_LINK"]["VALUE"]?>" class="button-blue">
							<span><?=$arItem["DISPLAY_PROPERTIES"]["BUTTON_ENTER_TEXT"]["VALUE"]?></span>
							<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
						</a>
						<a href="<?=$arItem["DISPLAY_PROPERTIES"]["BUTTON_ABOUT_LINK"]["VALUE"]?>" class="button-white">
							<span><?=$arItem["DISPLAY_PROPERTIES"]["BUTTON_ABOUT_TEXT"]["VALUE"]?></span>
							<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php endif;?>
	
<?php endforeach;?>