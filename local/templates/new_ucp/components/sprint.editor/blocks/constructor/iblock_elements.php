<?php /** @var $block array */ ?>

<?php

$elements = Sprint\Editor\Blocks\IblockElements::getList($block);

if (!empty($elements)) {
    $elementIds = array_column($elements, 'ID');

    $res = CIBlockElement::GetList(
            [],
            [
                    'IBLOCK_ID' => 91,
                    'ID' => $elementIds,
            ],
            false,
            false,
            [
                    'ID',
                    'PREVIEW_PICTURE',
            ]
    );

    $previewPictures = [];

    while ($arPicture = $res->GetNext()) {
        $previewPictures[$arPicture['ID']] = CFile::GetPath($arPicture['PREVIEW_PICTURE']);
    }

    foreach ($elements as &$arItem) {
        $arItem['PREVIEW_PICTURE'] = $previewPictures[$arItem['ID']] ?? '';
    }

    unset($arItem);
}

?>

<div class="universities__branches">
    <div class="universities__branches-slider-wrapper">
        <div class="universities__branches-slider swiper">
            <div class="swiper-wrapper">
                <?php foreach ($elements as $arItem): ?>
                    <div class="swiper-slide">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]; ?>">
                            <?php if (!empty($arItem["PREVIEW_PICTURE"])): ?>
                                <img src="<?=$arItem["PREVIEW_PICTURE"]?>" alt="<?= $arItem["NAME"]; ?>">
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