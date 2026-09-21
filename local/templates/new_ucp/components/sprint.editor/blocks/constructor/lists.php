<?php /** @var $block array */

$settings = !empty($block['settings']) ? $block['settings'] : [];
$tag = !empty($settings['type']) ? $settings['type'] : 'ul';

?>
<div class="page__info-block">
    <?= Sprint\Editor\Blocks\Lists::getValue($block, $tag); ?>
</div>
