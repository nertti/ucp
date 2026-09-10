<?php /**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */ ?>
<div data-fls-slider="" class="universities__slider swiper" style="padding-inline: 20px;">
    <div class="swiper-wrapper">
        <?php foreach ($block['blocks'] as $itemblock) { ?>
            <?php $this->includeBlock($itemblock) ?>
        <?php } ?>
    </div>
</div>
