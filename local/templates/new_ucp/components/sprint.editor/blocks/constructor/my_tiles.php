<?php /**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */ ?>
<nav class="home__feed-nav">
    <ul class="home__feed-nav-list">
        <?php foreach ($block['blocks'] as $itemblock) { ?>
            <?php $this->includeBlock($itemblock) ?>
        <?php } ?>
    </ul>
</nav>