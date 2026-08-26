<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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

<div class="universities__branches">
    <h2 class="title-two">Институты и филиалы</h2>
    <div class="universities__branches-slider-wrapper">
        <div class="universities__branches-slider swiper">
            <div class="swiper-wrapper">
                <?php foreach ($arResult["ITEMS"] as $arItem):
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="swiper-slide">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]; ?>">
                            <?php if (!empty($arItem["PREVIEW_PICTURE"]['SRC'])): ?>
                                <img src="<?=$arItem["PREVIEW_PICTURE"]['SRC']?>" alt="<?= $arItem["NAME"]; ?>">
                            <?php endif; ?>
                            <p><?= $arItem["NAME"]; ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="universities__branches-slider-action">
                <button class="universities__branches-slider-button-prev swiper-button-prev">
                    <iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver></iconify-icon>
                </button>
                <button class="universities__branches-slider-button-next swiper-button-next">
                    <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swiper !== 'undefined') {
            new Swiper('.universities__branches-slider', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                navigation: {
                    nextEl: '.universities__branches-slider-button-next',
                    prevEl: '.universities__branches-slider-button-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1280: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                }
            });
        }
    });
</script>