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
<?foreach($arResult["ITEMS"] as $arItem):?>
	<tr>
		<td><strong><?=$arItem["PROPERTIES"]["RANK"]["VALUE"]?>.</strong></td>
		<td>
		<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
			<?$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>90, 'height'=>90), BX_RESIZE_IMAGE_EXACT, true); ?>
			<img src="<?=$file['src']?>" alt="<?=$arItem["NAME"]?>">
		<?else:?>
			<img src="/i/no_player.jpg" alt="<?=$arItem["NAME"]?>">
		<?endif;?>
		</td>
		<td><strong><?=$arItem["NAME"]?></strong></td>
		<td><?=$arItem["PROPERTIES"]["SCORE"]["VALUE"]?></td>
		<td>
			<?if($arItem["PROPERTIES"]["DELTA"]["VALUE"]>0):?>
				<i class="up"></i> <?=$arItem["PROPERTIES"]["DELTA"]["VALUE"]?>
			<?elseif($arItem["PROPERTIES"]["DELTA"]["VALUE"]<0):?>
				<i class="dn"></i> <?=$arItem["PROPERTIES"]["DELTA"]["VALUE"]?>
			<?elseif($arItem["PROPERTIES"]["DELTA"]["VALUE"]==0):?>
				<i class="no"></i> н/и
			<?endif;?>
		</td>
		<td><?=$arItem["PROPERTIES"]["PLACE"]["~VALUE"]?></td>
		<td><?=$arItem["PROPERTIES"]["BDAY"]["VALUE"]?></td>
	</tr>
<?endforeach;?>