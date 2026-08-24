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

$arSections = array();
$rsSections = CIBlockSection::GetList(
    array('SORT' => 'ASC', 'NAME' => 'ASC'),
    array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1),
    false,
    array('ID', 'NAME', 'CODE', 'SECTION_PAGE_URL', 'DESCRIPTION', 'PICTURE')
);
while ($arSection = $rsSections->GetNext()) {
    $arSections[] = $arSection;
}

$items = !empty($arSections) ? $arSections : $arResult["ITEMS"];
?>

<div class="universities__branches">
    <h2 class="title-two">Институты и филиалы</h2>
    <div class="universities__branches-slider-wrapper">
        <div class="universities__branches-slider swiper">
            <div class="swiper-wrapper">
                <?php foreach ($items as $arItem): ?>
                    <div class="swiper-slide">
                        <a href="<?php echo $arItem["SECTION_PAGE_URL"] ?: $arItem["DETAIL_PAGE_URL"]; ?>">
                            <?php 
                            $imgSrc = "";
                            if (!empty($arItem["PICTURE"])) {
                                $imgSrc = CFile::GetPath($arItem["PICTURE"]);
                            } elseif (!empty($arItem["PREVIEW_PICTURE"])) {
                                if (is_array($arItem["PREVIEW_PICTURE"])) {
                                    $imgSrc = $arItem["PREVIEW_PICTURE"]["SRC"];
                                } else {
                                    $imgSrc = CFile::GetPath($arItem["PREVIEW_PICTURE"]);
                                }
                            }
                            ?>
                            <?php if (!empty($imgSrc)): ?>
                                <img src="<?php echo $imgSrc; ?>" alt="<?php echo $arItem["NAME"]; ?>">
                            <?php endif; ?>
                            <p><?php echo $arItem["NAME"]; ?></p>
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