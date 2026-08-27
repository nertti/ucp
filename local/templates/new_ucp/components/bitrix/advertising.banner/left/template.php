<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<?php
CAdvBanner::Click($arResult['BANNER_PROPERTIES']['ID']);
?>
<ul class="page__banners">
    <li class="page__banners-item">
        <?= $arResult["BANNER"];?>
    </li>
</ul>

