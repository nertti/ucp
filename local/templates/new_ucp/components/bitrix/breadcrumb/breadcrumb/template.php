<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @global CMain $arResult
 */
?>

<?php

$result = '<nav class="breadcrumbs">';
$result = '<ul class="breadcrumbs__list">';
foreach ($arResult as $item) {
    $result .= '<li class="breadcrumbs__item"><a href="' . $item['LINK'] . '" class="breadcrumbs__link">' . $item['TITLE'] . '</a></li>';
}
$result .= '</ul>';
$result .= '</nav>';
return $result;
?>
