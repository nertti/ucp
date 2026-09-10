<?php
/** @var $block array */
?>
<?php if ($block['type'] == 'h1'): ?>
    <h1 class="title-one"><?=$block['value']?></h1>
<?php elseif ($block['type'] == 'h2'): ?>
    <h2 class="title-two"><?=$block['value']?></h2>
<?php elseif ($block['type'] == 'h3'): ?>
    <h3 class="title-three"><?=$block['value']?></h3>
<?php elseif ($block['type'] == 'h4'): ?>
    <h4 class="title-four"><?=$block['value']?></h4>
<?php endif; ?>
