<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<?php foreach($arResult["ITEMS"] as $arItem):?>
	<?php
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
	<li class="services__main-list-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<div class="services__main-list-header">
				<div class="icon">
					<iconify-icon icon="<?=$arItem["DISPLAY_PROPERTIES"]["ICON"]["VALUE"]?>" width="100%" height="100%" noobserver></iconify-icon>
				</div>
				<?php if($arItem["DISPLAY_PROPERTIES"]["IS_POPULAR"]["VALUE"] == "Y"):?>
					<div class="label">Популярная услуга</div>
				<?php endif;?>
				<?php if($arItem["DISPLAY_PROPERTIES"]["IS_RECOMMENDED"]["VALUE"] == "Y"):?>
					<div class="label">Рекомендуем</div>
				<?php endif;?>
			</div>
			<div class="services__main-list-content">
				<h3><?=$arItem["NAME"]?></h3>
				<p>
					<?=$arItem["PREVIEW_TEXT"]?>
				</p>
			</div>
		</a>
	</li>
	
<?php endforeach;?>