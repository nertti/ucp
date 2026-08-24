<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<?php foreach($arResult["ITEMS"] as $arItem):?>
	<?php
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
	<div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="universities__slider-content">
			<h2 class="title-two"><?=$arItem["NAME"]?></h2>
			<ul class="universities__slider-list">
				<?php
				$faculties = $arItem["DISPLAY_PROPERTIES"]["FACULTIES"]["VALUE"];
				if(is_array($faculties)):
					foreach($faculties as $faculty):
				?>
					<li class="universities__slider-list-item">
						<a href="#">
							<iconify-icon icon="iconamoon:check-bold" width="24" height="24" noobserver></iconify-icon>
							<p><?=$faculty?></p>
						</a>
					</li>
				<?php 
					endforeach;
				endif;
				?>
			</ul>
		</div>
		<div class="universities__slider-wrapper">
			<div class="universities__slider-img">
				<img src="<?=$arItem["DISPLAY_PROPERTIES"]["IMAGE"]["VALUE"]?>" alt="Image" title="<?=$arItem["NAME"]?>" />
			</div>
			<div class="universities__slider-action">
				<button class="universities__slider-button-prev swiper-button-prev">
					<iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver></iconify-icon>
				</button>
				<button class="universities__slider-button-next swiper-button-next">
					<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
				</button>
			</div>
			<div class="universities__slider-slider-pagination"></div>
		</div>
	</div>
	
<?php endforeach;?>