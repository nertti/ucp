<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$hashtagsTag = [];

// Теги
if (!empty($arResult['PROPERTIES']['TAGS']['VALUE'])) {
    $tagXmlIds = (array)$arResult['PROPERTIES']['TAGS']['VALUE'];
    foreach ($tagXmlIds as $xmlId) {
        $tags = getHLData(
            'TagsServices',
            ['UF_XML_ID' => $xmlId]
        );
        foreach ($tags as $tag) {
            if (!empty($tag['UF_NAME'])) {
                $arTag = ['NAME' => $tag['UF_NAME'], 'LINK' => 'tag=' . $tag['UF_XML_ID'], 'UF_XML_ID' => $tag['UF_XML_ID']];
                $hashtagsTag[] = $arTag;
            }
        }
    }
}

$arResult['HASHTAGS']['TAGS'] = $hashtagsTag;
$arResult['IMAGE'] = !empty($arResult['DETAIL_PICTURE'])
    ? $arResult['DETAIL_PICTURE']
    : $arResult['PREVIEW_PICTURE'];

// Просмотры

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    return;
}

$elementId = (int)$arResult['ID'];

if ($elementId > 0) {
    CIBlockElement::SetPropertyValuesEx(
        $elementId,
        $arParams['IBLOCK_ID'],
        [
            'VIEWS' => new \Bitrix\Main\DB\SqlExpression(
                'IFNULL(%s, 0) + 1',
                'PROPERTY_VIEWS'
            )
        ]
    );
}