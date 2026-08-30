<?php /**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */ ?>
<div class="page__info">
    <?php foreach ($block['blocks'] as $itemblock) { ?>
        <?php $this->includeBlock($itemblock) ?>
    <?php } ?>
</div>
