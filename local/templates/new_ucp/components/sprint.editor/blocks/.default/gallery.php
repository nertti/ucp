<?php /**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */ ?>

<?php
$arWaterMark = array(
        array(
                "name" => "watermark",
                "position" => "bottomright",
                "type" => "image",
                "size" => "real",
                "file" => $_SERVER["DOCUMENT_ROOT"] . '/local/templates/new_ucp/dist/img/watermark.png',
                'alpha_level' => 70, //прозрачность
                "fill" => "exact",
        )
);
?>

<?php
$images = Sprint\Editor\Blocks\Gallery::getImages(
        $block, [
        'width' => 300,
        'height' => 300,
        'exact' => 0,
        'filters' => $arWaterMark
], [
                'width' => 1024,
                'height' => 768,
                'exact' => 0,
                'filters' => $arWaterMark
        ]
);
?>
<?php if (!empty($images)): ?>
    <div class="page__image-slider">
        <div class="page__image-slider-main swiper" data-fls-slider>
            <div class="swiper-wrapper">
                <?php foreach ($images as $image) : ?>
                    <div class="swiper-slide">
                        <a href="<?= htmlspecialcharsbx($image['DETAIL_SRC']) ?>"
                           class="page__image-slider-link"
                           data-fancybox="gallery">
                            <img src="<?= htmlspecialcharsbx($image['SRC']) ?>"
                                 alt="<?= htmlspecialcharsbx($image['DESCRIPTION']) ?>"/>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="page__image-slider-action">
                <div class="page__image-slider-prev swiper-button-prev">
                    <iconify-icon icon="ep:arrow-left-bold" width="20" height="20" noobserver></iconify-icon>
                </div>
                <div class="page__image-slider-next swiper-button-next">
                    <iconify-icon icon="ep:arrow-right-bold" width="20" height="20" noobserver></iconify-icon>
                </div>
            </div>
        </div>
        <div class="page__image-slider-thumbs swiper" data-fls-slider>
            <div class="swiper-wrapper">
                <?php foreach ($images as $image) : ?>
                    <div class="swiper-slide">
                        <img src="<?= htmlspecialcharsbx($image['SRC']) ?>"
                             alt="<?= htmlspecialcharsbx($image['DESCRIPTION']) ?>"/>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>