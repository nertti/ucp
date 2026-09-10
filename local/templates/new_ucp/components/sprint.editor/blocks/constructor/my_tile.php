<?php /**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */ ?>
<?php
$item = $block['items'][0];
?>
<li id="bx_3099439860_29135" class="home__feed-nav-item">
    <a href="<?=$item['url']?>"
       style="background: url(<?=$item['image']['ORIGIN_SRC']?>) #d3d3d3 50%/cover no-repeat;">
        <img loading="lazy" src="<?=$item['icon']['ORIGIN_SRC']?>"
             alt="<?=$item['title']?>">
        <p><?=$item['title']?></p>
    </a>
</li>