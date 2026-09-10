<?php /**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */ ?>
<?php
$item = $block['items'][0];
?>
<li class="home__feed-nav-item">
    <a href="<?=htmlspecialcharsbx($item['url'])?>"
            <?php if (!empty($item['image']['ORIGIN_SRC'])): ?>
                style="background: url('<?=htmlspecialcharsbx($item['image']['ORIGIN_SRC'])?>') #d3d3d3 50%/cover no-repeat;"
            <?php else: ?>
                style="background: #d3d3d3;"
            <?php endif; ?>
    >
        <?php if (!empty($item['icon']['ORIGIN_SRC'])): ?>
            <img
                    loading="lazy"
                    src="<?=htmlspecialcharsbx($item['icon']['ORIGIN_SRC'])?>"
                    alt="<?=htmlspecialcharsbx($item['title'])?>"
            >
        <?php endif; ?>

        <p><?=htmlspecialcharsbx($item['title'])?></p>
    </a>
</li>