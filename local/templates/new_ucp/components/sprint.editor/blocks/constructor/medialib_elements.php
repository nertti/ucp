<?php /** @var $block array */
/** @var $this SprintEditorBlocksComponent */ ?><?php

if (empty($block['medialib_type']) || $block['medialib_type'] === 'image') {
    $this->includeBlock($block, 'medialib_images.php');
    return;
}

$elements = Sprint\Editor\Blocks\MedialibElements::getElements($block);
?>
<div class="sp-medialib-elements">
    <ul>
        <?php foreach ($elements as $aItem) { ?>
            <li><a href="<?= $aItem['SRC'] ?>"><?= $aItem['NAME'] ?></a></li>
        <?php } ?>
    </ul>
</div>