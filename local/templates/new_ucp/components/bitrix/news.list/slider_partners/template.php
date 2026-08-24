<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
    <div class="footer__slider-wrapper">
        <div class="footer__slider swiper">
            <div class="swiper-wrapper">
                <?php foreach ($arResult['ITEMS'] as $arItem):
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="swiper-slide">
                        <a href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>">
                            <img src="<?= CFile::GetPath($arItem['PROPERTIES']['IMAGE']['VALUE']) ?>"
                                 alt="<?= $arItem['NAME'] ?>"/>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="footer__slider-action">
                <button class="footer__slider-button-prev swiper-button-prev">
                    <iconify-icon icon="lucide:chevron-left" width="100%" height="100%"
                                  noobserver></iconify-icon>
                </button>
                <button class="footer__slider-button-next swiper-button-next">
                    <iconify-icon icon="lucide:chevron-right" width="100%" height="100%"
                                  noobserver></iconify-icon>
                </button>
            </div>
        </div>
    </div>
<?php endif; ?>

