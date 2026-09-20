<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arPrepItems = [];
if (!empty($arResult)) {
    foreach ($arResult as $key => $item) {
        if ($item['DEPTH_LEVEL'] === 1) {
            $arPrepItems[] = $item;
        } else {
            $array = array_keys($arPrepItems);
            $arPrepItems[end($array)]['CHILDREN'][] = $item;
        }
    }
}
$arResult = $arPrepItems;
