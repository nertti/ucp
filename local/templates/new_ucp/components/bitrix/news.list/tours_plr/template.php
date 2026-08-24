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
$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>16, "PROPERTY_USER_ID"=>$USER->GetID()), false, Array("nTopCount"=>1), Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "PROPERTY_*"));
if (intval($res->SelectedRowsCount())>0)
{
	$ob = $res->GetNextElement();
	$arPFields  = $ob->GetFields();
	$arPProps = $ob->GetProperties();
}else{
	$arPFields=array();
	$arPProps=array();
}

?>
<table class="t-table">
	<tr>
		<th colspan="2">Название турнира</th>
		<th>Категория</th>
		<th>Сроки</th>
		<th>Место проведения</th>
		<th></th>
	</tr>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>36, "PROPERTY_TORNAMENT"=>$arItem['ID'], "ACTIVE"=>"Y"), false, false, Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*"));
	$GRIDS=array();
	while ($ob = $res->GetNextElement())
	{
		$arGFields  = $ob->GetFields();
		$arGProps = $ob->GetProperties();
		$resC = CIBlockElement::GetByID($arGProps['CAT']['VALUE']);
		$arCat = $resC->GetNext();
		$resE = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>35, "PROPERTY_GRID_ID"=>$arGFields['ID'], "ACTIVE"=>"Y"), false, false, Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*"));
		$ob = $resE->GetNextElement();
		$arEFields  = $ob->GetFields();
		$arEProps = $ob->GetProperties();
		?>
		<tr>
			<td><?=$i?>.</td>
			<td><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></td>
			<td>
				<?=$arCat['NAME']?>
			</td>
			<td><?echo $arItem["PROPERTIES"]["DATE_START"]["VALUE"]?> <br> <?echo $arItem["PROPERTIES"]["DATE_END"]["VALUE"]?></td>
			<td>
				<p><?echo $arItem["PROPERTIES"]["PLACE"]["VALUE"]?></p>
				<p><?echo strip_tags($arItem["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"])?>, <?echo $arItem["PROPERTIES"]["ADDR"]["VALUE"]?></p>
				<p><?echo $arItem["PROPERTIES"]["CONT"]["VALUE"]?></p>
				<p><strong><?=implode('<br />',$arItem["PROPERTIES"]["PHONES"]["VALUE"])?></strong></p>
				<?if($arItem["PROPERTIES"]["SITE"]["VALUE"]):?>
					<p><a href="<?=$arItem["PROPERTIES"]["SITE"]["VALUE"]?>" target="_blank"><?=$arItem["PROPERTIES"]["SITE"]["VALUE"]?></a></p>
				<?endif;?>
			</td>
			<td>
			<?if(in_array($arPFields['ID'],$arEProps['ENTRY']['VALUE'])):?>
				<span>Заявка подана</span>
			<?elseif(in_array($arPFields['ID'],$arEProps['APPROVE']['VALUE'])):?>
				<span>Заявка одобрена</span>
			<?else:?>
				<a href="?DECLARE=<?=$arEFields['ID']?>" class="button">Заявить участие</a>
			<?endif;?>
			</td>
		</tr>
		<?$i++;?>
		<?
	}
	?>
<?endforeach;?>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>