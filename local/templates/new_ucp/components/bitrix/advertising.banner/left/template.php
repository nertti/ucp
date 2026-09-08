<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<ul class="page__banners">
    <?php foreach ($arResult['BANNERS'] as $index => $arBanner): ?>
        <?php
        CAdvBanner::Click($arResult['BANNERS_PROPERTIES'][$index]['ID']);
        ?>
        <li class="page__banners-item">
            <?= $arBanner; ?>
        </li>
    <?php endforeach; ?>
</ul>

