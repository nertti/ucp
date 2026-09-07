<?php /** @var $block array */ ?>
<?php if (!empty($block['title']) && !empty($block['url']) && preg_match('#^(https?:|mailto:|/)#i', (string)$block['url'])): ?>
<div class="button-wrapper">
    <a href="<?= htmlspecialcharsbx($block['url']) ?>" class="button-blue" <?php if (!empty($block['target'])): ?>target="<?= htmlspecialcharsbx($block['target']) ?>" <?php endif; ?>>
        <span><?= htmlspecialcharsbx($block['title']) ?></span>
        <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
    </a>
</div>
<?php endif;?>