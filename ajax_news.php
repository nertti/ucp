<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if (!isset($_REQUEST['ajax']) || $_REQUEST['ajax'] !== 'Y') {
    die();
}

$searchQuery = trim($_REQUEST['search'] ?? '');
$sectionId = intval($_REQUEST['section'] ?? 0);

CModule::IncludeModule('iblock');

$arFilter = array(
    'IBLOCK_ID' => 2,
    'ACTIVE' => 'Y',
);

if (!empty($searchQuery)) {
    $arFilter['%NAME'] = $searchQuery;
}

if ($sectionId > 0) {
    $arFilter['SECTION_ID'] = $sectionId;
    $arFilter['INCLUDE_SUBSECTIONS'] = 'Y';
}

$arSelect = array(
    'ID',
    'NAME',
    'PREVIEW_TEXT',
    'PREVIEW_PICTURE',
    'DETAIL_PAGE_URL',
    'ACTIVE_FROM',
    'PROPERTY_ICON',
    'PROPERTY_HASHTAGS',
    'PROPERTY_TEG'
);

$arSort = array('ACTIVE_FROM' => 'DESC');

$rsElements = CIBlockElement::GetList($arSort, $arFilter, false, array('nPageSize' => 10), $arSelect);

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
    
    $hashtags = array();
    if (!empty($arItem['PROPERTY_HASHTAGS_VALUE'])) {
        if (is_array($arItem['PROPERTY_HASHTAGS_VALUE'])) {
            $hashtags = $arItem['PROPERTY_HASHTAGS_VALUE'];
        } else {
            $hashtags = array($arItem['PROPERTY_HASHTAGS_VALUE']);
        }
    }
    
    $tegValue = '';
    if (!empty($arItem['PROPERTY_TEG_VALUE'])) {
        $tegValue = $arItem['PROPERTY_TEG_VALUE'];
    }
    
    $date = '';
    if (!empty($arItem['ACTIVE_FROM'])) {
        $date = FormatDateFromDB($arItem['ACTIVE_FROM']);
    }
    
    $html .= '<li class="news__list-item">';
    $html .= '<a href="' . $arItem['DETAIL_PAGE_URL'] . '" class="news__list-item-img">';
    if (!empty($imgSrc)) {
        $html .= '<img src="' . $imgSrc . '" alt="' . htmlspecialcharsbx($arItem['NAME']) . '" title="' . htmlspecialcharsbx($arItem['NAME']) . '">';
    }
    if (!empty($iconSrc)) {
        $html .= '<div class="icon"><img src="' . $iconSrc . '" alt="Image"></div>';
    }
    $html .= '</a>';
    $html .= '<div class="news__list-item-info">';
    $html .= '<a href="' . $arItem['DETAIL_PAGE_URL'] . '" class="news__list-item-info-content">';
    $html .= '<div class="date">';
    $html .= '<iconify-icon icon="lsicon:calendar-outline" width="18" height="18" noobserver></iconify-icon>';
    $html .= '<span>' . $date . '</span>';
    $html .= '</div>';
    $html .= '<h5>' . htmlspecialcharsbx($arItem['NAME']) . '</h5>';
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
    if (!empty($tegValue)) {
        if (!is_array($tegValue)) {
            $tegs = explode(',', $tegValue);
        } else {
            $tegs = $tegValue;
        }
        $html .= '<ul class="hashtags">';
        foreach ($tegs as $teg) {
            $teg = trim($teg);
            if (!empty($teg)) {
                $html .= '<li class="hashtags__item"><a href="#">#' . htmlspecialcharsbx($teg) . '</a></li>';
            }
        }
        $html .= '</ul>';
    }
    $html .= '</div>';
    $html .= '</li>';
}

if (empty($html)) {
    $html = '<li class="news__list-item"><div class="news__list-item-info"></div></li>';
}

header('Content-Type: application/json');
echo json_encode(array('html' => $html));
die();
?>