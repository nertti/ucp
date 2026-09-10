<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php if (!empty($arResult)): ?>
    <div class="page__sidebar-content _event">
        <ul class="page__sidebar-event" data-fls-dynamic=".event-mobile,950, 1">
            <?php foreach ($arResult as $arItem): ?>
                <li class="page__sidebar-event-item<?php if(!empty($arItem['SELECTED'])):?> _active<?php endif;?>"><a href="<?= $arItem['LINK'] ?>"><?= $arItem['TEXT'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif ?>