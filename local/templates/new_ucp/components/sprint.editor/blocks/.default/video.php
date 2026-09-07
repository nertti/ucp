<?php /** @var $block array */ ?>
<style>
    .page__video {
        width: 100%;
        max-width: 780px;
        height: 480px;
        border-radius: 8px;
        margin-inline: auto;
    }
</style>
<div class="page__video">
    <?= Sprint\Editor\Blocks\Video::getHtml($block) ?>
</div>
