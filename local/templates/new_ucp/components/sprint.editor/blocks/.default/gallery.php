<?php /**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */ ?>

<?php if (!empty($block['images'])): ?>
    <div class="page__image-slider">
        <div class="page__image-slider-main swiper">
            <div class="swiper-wrapper">
                <?php foreach ($block['images'] as $image) : ?>
                    <div class="swiper-slide">
                        <a href="<?= htmlspecialcharsbx($image['file']['ORIGIN_SRC']) ?>"
                           class="page__image-slider-link"
                           data-fancybox="gallery">
                            <img src="<?= htmlspecialcharsbx($image['file']['ORIGIN_SRC']) ?>"
                                 alt="<?= htmlspecialcharsbx($image['DESCRIPTION']) ?>" title="Новость"/>
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
        <div class="page__image-slider-thumbs swiper">
            <div class="swiper-wrapper">
                <?php foreach ($block['images'] as $image) : ?>
                    <div class="swiper-slide">
                        <img src="<?= htmlspecialcharsbx($image['file']['ORIGIN_SRC']) ?>"
                             alt="<?= htmlspecialcharsbx($image['DESCRIPTION']) ?>"/>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
