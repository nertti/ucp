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

<section class="universities__info">
    <div class="universities__slider swiper">
        <div class="swiper-wrapper">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <?php
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                
                $imgSrc = "";
                if (is_array($arItem["PREVIEW_PICTURE"])) {
                    $imgSrc = $arItem["PREVIEW_PICTURE"]["SRC"];
                } elseif (is_array($arItem["DETAIL_PICTURE"])) {
                    $imgSrc = $arItem["DETAIL_PICTURE"]["SRC"];
                }
                
                $title = $arItem["NAME"];
                $text = $arItem["PREVIEW_TEXT"];
                ?>
                <div class="swiper-slide _center" id="<?php echo $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="universities__slider-wrapper">
                        <div class="universities__slider-img">
                            <?php if (!empty($imgSrc)): ?>
                                <img src="<?php echo $imgSrc; ?>" alt="<?php echo $arItem["PREVIEW_PICTURE"]["ALT"] ?: $title; ?>" title="<?php echo $arItem["PREVIEW_PICTURE"]["TITLE"] ?: $title; ?>">
                            <?php endif; ?>
                        </div>
                        <div class="universities__slider-action">
                            <button class="universities__slider-button-prev swiper-button-prev">
                                <iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver></iconify-icon>
                                <svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"></path></svg>
                            </button>
                            <button class="universities__slider-button-next swiper-button-next">
                                <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
                                <svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"></path></svg>
                            </button>
                        </div>
                        <div class="universities__slider-slider-pagination"></div>
                    </div>
                    <div class="universities__slider-content">
                        <div class="universities__slider-info">
                            <h2 class="title-two"><?php echo $title; ?></h2>
                            <?php if (!empty($text)): ?>
                                <p><?php echo $text; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper !== 'undefined') {
        new Swiper('.universities__slider', {
            slidesPerView: 1,
            spaceBetween: 60,
            loop: true,
            navigation: {
                nextEl: '.universities__slider-button-next',
                prevEl: '.universities__slider-button-prev',
            },
            pagination: {
                el: '.universities__slider-slider-pagination',
                clickable: true,
            },
            effect: 'slide',
            speed: 600,
        });
    }
});
</script>