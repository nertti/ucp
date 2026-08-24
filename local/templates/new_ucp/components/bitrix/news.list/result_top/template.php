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
<div id="champs" class="wrap">
	<ul>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$res_1=explode(':',$arItem["PROPERTIES"]["RESULT_1"]["VALUE"]);
		$res_2=explode(':',$arItem["PROPERTIES"]["RESULT_2"]["VALUE"]);
		$res_3=explode(':',$arItem["PROPERTIES"]["RESULT_3"]["VALUE"]);
		array_walk($res_1,'clear_bracket');
		array_walk($res_2,'clear_bracket');
		array_walk($res_3,'clear_bracket');
		$с1_1=array();
		$с1_2=array();
		$с2_1=array();
		$с2_2=array();
		if($arItem["PROPERTIES"]["COUNTRY_1_1"]["VALUE"])
		{
			$res = CIBlockElement::GetByID($arItem["PROPERTIES"]["COUNTRY_1_1"]["VALUE"]);
			$с1_1 = $res->GetNext();
		}
		if($arItem["PROPERTIES"]["COUNTRY_2_1"]["VALUE"])
		{
			$res = CIBlockElement::GetByID($arItem["PROPERTIES"]["COUNTRY_2_1"]["VALUE"]);
			$с2_1 = $res->GetNext();
		}
		if($arItem["PROPERTIES"]["COUNTRY_2_1"]["VALUE"])
		{
			$res = CIBlockElement::GetByID($arItem["PROPERTIES"]["COUNTRY_1_2"]["VALUE"]);
			$с1_2 = $res->GetNext();
		}
		if($arItem["PROPERTIES"]["COUNTRY_2_1"]["VALUE"])
		{
			$res = CIBlockElement::GetByID($arItem["PROPERTIES"]["COUNTRY_2_2"]["VALUE"]);
			$с2_2 = $res->GetNext();
		}
		?>
		<li>
			<a<?if($arItem["PROPERTIES"]["LINK"]["VALUE"]):?> href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>"<?endif;?>><?echo $arItem["NAME"]?></a>
			<div>
				<aside><span><?=$arItem["PROPERTIES"]["ETAP"]["VALUE"]?></span></aside>
				<section<?if($arItem["PROPERTIES"]["NAME_1_2"]["VALUE"]):?> class="two"<?endif;?>>
					<span><i><?=$res_3[0]?></i><i><?=$res_2[0]?></i><i><?=$res_1[0]?></i><?if($arItem["PROPERTIES"]["WIN"]["VALUE"]=='Да'):?><em></em><?endif;?></span>
					<img src="<?=CFile::GetPath($с1_1['PREVIEW_PICTURE']);?>" alt="<?=$с1_1['NAME']?>">
					<?=$arItem["PROPERTIES"]["NAME_1_1"]["VALUE"]?>
					<?if($arItem["PROPERTIES"]["NAME_1_2"]["VALUE"]):?>
						<br>
						<img src="<?=CFile::GetPath($с1_2['PREVIEW_PICTURE']);?>" alt="<?=$с1_2['NAME']?>">
						<?=$arItem["PROPERTIES"]["NAME_1_2"]["VALUE"]?>
					<?endif;?>
				</section>
				<section<?if($arItem["PROPERTIES"]["NAME_2_2"]["VALUE"]):?> class="two"<?endif;?>>
					<span><i><?=$res_3[1]?></i><i><?=$res_2[1]?></i><i><?=$res_1[1]?></i><?if($arItem["PROPERTIES"]["WIN"]["VALUE"]=='Нет'):?><em></em><?endif;?></span>
					<img src="<?=CFile::GetPath($с2_1['PREVIEW_PICTURE']);?>" alt="<?=$с2_1['NAME']?>">
					<?=$arItem["PROPERTIES"]["NAME_2_1"]["VALUE"]?>
					<?if($arItem["PROPERTIES"]["NAME_2_2"]["VALUE"]):?>
						<br>
						<img src="<?=CFile::GetPath($с2_2['PREVIEW_PICTURE']);?>" alt="<?=$с2_2['NAME']?>">
						<?=$arItem["PROPERTIES"]["NAME_2_2"]["VALUE"]?>
					<?endif;?>
				</section>
			</div>
			<p><span><?=$arItem["PROPERTIES"]["MATCH_TIME"]["VALUE"]?></span> <i></i> <?=$arItem["PROPERTIES"]["DATE"]["VALUE"]?></p>
		</li>
	<?endforeach;?>
	</ul>
	<i></i>
	<em></em>
</div>