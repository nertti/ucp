<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if (!isset($_REQUEST['ajax']) || $_REQUEST['ajax'] !== 'Y') {
    die();
}

$searchQuery = trim($_REQUEST['search'] ?? '');

CModule::IncludeModule('iblock');

$arFilter = array(
    'IBLOCK_ID' => 2,
    'ACTIVE' => 'Y',
);

if (!empty($searchQuery)) {
    $arFilter['?NAME'] = $searchQuery;
}

$arSelect = array(
    'ID',
    'NAME',
    'PREVIEW_TEXT',
    'PREVIEW_PICTURE',
    'DETAIL_PAGE_URL',
    'PROPERTY_ICON',
    'PROPERTY_BADGE',
    'PROPERTY_HASHTAGS'
);

$arSort = array('SORT' => 'ASC');

$rsElements = CIBlockElement::GetList($arSort, $arFilter, false, array('nPageSize' => 20), $arSelect);

$html = '';
while ($arItem = $rsElements->GetNext()) {
    $imgSrc = '';
    if (!empty($arItem['PREVIEW_PICTURE'])) {
        $imgSrc = CFile::GetPath($arItem['PREVIEW_PICTURE']);
    }
    
    $iconSrc = '';
    if (!empty($arItem['PROPERTY_ICON_VALUE'])) {
        $iconSrc = CFile::GetPath($arItem['PROPERTY_ICON_VALUE']);
    }
    
    $badge = $arItem['PROPERTY_BADGE_VALUE'] ?? '';
    
    $hashtags = array();
    if (!empty($arItem['PROPERTY_HASHTAGS_VALUE'])) {
        if (is_array($arItem['PROPERTY_HASHTAGS_VALUE'])) {
            $hashtags = $arItem['PROPERTY_HASHTAGS_VALUE'];
        } else {
            $hashtags = array($arItem['PROPERTY_HASHTAGS_VALUE']);
        }
    }
    
    $html .= '<li class="services__list-item">';
    $html .= '<a href="' . $arItem['DETAIL_PAGE_URL'] . '" class="services__list-item-img">';
    if (!empty($imgSrc)) {
        $html .= '<img src="' . $imgSrc . '" alt="' . htmlspecialcharsbx($arItem['NAME']) . '" title="' . htmlspecialcharsbx($arItem['NAME']) . '">';
    }
    $html .= '<div class="services__list-item-badge">';
    if (!empty($iconSrc)) {
        $html .= '<div class="icon"><img src="' . $iconSrc . '" alt="Image"></div>';
    }
    if (!empty($badge)) {
        $html .= '<div class="label">' . htmlspecialcharsbx($badge) . '</div>';
    }
    $html .= '</div>';
    $html .= '</a>';
    $html .= '<div class="services__list-item-info">';
    $html .= '<a href="' . $arItem['DETAIL_PAGE_URL'] . '" class="services__list-item-info-content">';
    $html .= '<h4>' . htmlspecialcharsbx($arItem['NAME']) . '</h4>';
    if (!empty($arItem['PREVIEW_TEXT'])) {
        $html .= '<p>' . htmlspecialcharsbx($arItem['PREVIEW_TEXT']) . '</p>';
    }
    $html .= '</a>';
    if (!empty($hashtags)) {
        $html .= '<ul class="hashtags">';
        foreach ($hashtags as $hashtag) {
            $html .= '<li class="hashtags__item"><a href="#">#' . htmlspecialcharsbx($hashtag) . '</a></li>';
        }
        $html .= '</ul>';
    }
    $html .= '</div>';
    $html .= '</li>';
}

if (empty($html)) {
    $html = '<li class="services__list-item"><div class="services__list-item-info"><p>Ничего не найдено</p></div></li>';
}

header('Content-Type: application/json');
echo json_encode(array('html' => $html));
die();
?>