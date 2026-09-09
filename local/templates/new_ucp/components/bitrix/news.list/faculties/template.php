<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<?php if (!empty($arResult['ITEMS'])): ?>
<div class="universities__slider swiper" data-fls-slider>
    <div class="swiper-wrapper">
    <?php foreach ($arResult['ITEMS'] as $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="swiper-slide">
            <?php $APPLICATION->IncludeComponent(
                    "sprint.editor:blocks",
                    "slider",
                    array(
                            "ELEMENT_ID" => $arItem["ID"],
                            "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                            "PROPERTY_CODE" => 'EDITOR',
                    ),
                    $component,
                    array(
                            "HIDE_ICONS" => "Y"
                    )
            ); ?>
        </div>
    <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>