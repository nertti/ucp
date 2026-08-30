<?php
/**
 * @var $block array
 * @var $this SprintEditorBlocksComponent
 */

?>
<div class="page__banner">
    <div class="page__banner-img">
        <img src="<?= $block['image']['file']['ORIGIN_SRC'] ?>" alt="<?= $block['htag']['value'] ?>"
             title="<?= $block['htag']['value'] ?>">
    </div>
    <div class="page__banner-content">
        <h1 class="title-two">
            <?= $block['htag']['value'] ?>
        </h1>
    </div>
</div>