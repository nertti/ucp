<?php
/**
 * @var $block array
 * @var $this SprintEditorBlocksComponent
 */
?>

<?php
//echo '<pre>';
//print_r($block);
//echo '</pre>';
//?>
<div class="swiper-slide _center">
    <div class="universities__slider-content">
        <div class="universities__slider-info">
            <h2 class="title-two">
                <a href="<?= $block['button_link']['url'] ?>"><?= $block['htag']['value'] ?></a>
            </h2>

            <?= $block['text']['value'] ?>

            <a href="<?= $block['button_link']['url'] ?>" class="button-detail">
                <span><?= $block['button_link']['title'] ?></span>
                <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
            </a>
        </div>
    </div>
    <div class="universities__slider-wrapper">
        <a href="#" class="universities__slider-img">
            <img src="<?= $block['image']['file']['SRC'] ?>" alt="<?= $block['image']['htag']['value'] ?>"
                 title="<?= $block['image']['htag']['value'] ?>"/>
        </a>
        <div class="universities__slider-action">
            <button class="universities__slider-button-prev swiper-button-prev">
                <iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver></iconify-icon>
            </button>
            <button class="universities__slider-button-next swiper-button-next">
                <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
            </button>
        </div>
        <div class="universities__slider-slider-pagination"></div>
    </div>
</div>


