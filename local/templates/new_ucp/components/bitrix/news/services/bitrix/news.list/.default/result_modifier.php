<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$rootSectionCache = [];

// Получаем все разделы элементов
$sectionIds = [];

foreach ($arResult["ITEMS"] as $arItem) {
    if (!empty($arItem['IBLOCK_SECTION_ID'])) {
        $sectionIds[] = (int)$arItem['IBLOCK_SECTION_ID'];
    }
}

$sectionIds = array_unique($sectionIds);

if (!empty($sectionIds)) {
    // Получаем все разделы инфоблока одним запросом
    $sections = [];

    $sectionRes = CIBlockSection::GetList(
        ['LEFT_MARGIN' => 'ASC'],
        [
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'ACTIVE' => 'Y',
        ],
        false,
        [
            'ID',
            'IBLOCK_SECTION_ID',
            'UF_ICON',
            'NAME',
        ]
    );

    while ($section = $sectionRes->Fetch()) {
        $sections[(int)$section['ID']] = $section;
    }

    // Определяем корневой раздел для каждого раздела
    foreach ($sectionIds as $sectionId) {
        $currentId = $sectionId;

        while (
            isset($sections[$currentId]) &&
            !empty($sections[$currentId]['IBLOCK_SECTION_ID'])
        ) {
            $currentId = (int)$sections[$currentId]['IBLOCK_SECTION_ID'];
        }

        if (isset($sections[$currentId])) {
            $rootSectionCache[$sectionId] = $sections[$currentId];
        }
    }
}


foreach ($arResult["ITEMS"] as &$arItem) {

    $hashtagsTag = [];

    // Теги
    if (!empty($arItem['PROPERTIES']['TAGS']['VALUE'])) {
        $tagXmlIds = (array)$arItem['PROPERTIES']['TAGS']['VALUE'];

        foreach ($tagXmlIds as $xmlId) {
            $tags = getHLData(
                'TagsServices',
                ['UF_XML_ID' => $xmlId]
            );

            foreach ($tags as $tag) {
                if (!empty($tag['UF_NAME'])) {
                    $hashtagsTag[] = [
                        'NAME' => $tag['UF_NAME'],
                        'LINK' => 'tag=' . $tag['UF_XML_ID'],
                        'UF_XML_ID' => $tag['UF_XML_ID'],
                    ];
                }
            }
        }
    }


    // Превью текст
    $text = !empty($arItem['PREVIEW_TEXT'])
        ? $arItem['PREVIEW_TEXT']
        : $arItem['DETAIL_TEXT'];

    if (
        empty(trim(strip_tags($text))) &&
        !empty($arItem['PROPERTIES']['CONTENT']['VALUE'])
    ) {
        $content = $arItem['PROPERTIES']['CONTENT']['VALUE'] ?? '';

        if (!empty($content)) {
            $content = html_entity_decode(
                $content,
                ENT_QUOTES | ENT_HTML5,
                'UTF-8'
            );

            if (preg_match(
                '/"value"\s*:\s*"((?:\\\\.|[^"\\\\])*)"\s*,\s*"name"\s*:\s*"text"/s',
                $content,
                $matches
            )) {
                $text = json_decode('"' . $matches[1] . '"');

                if ($text === null) {
                    $text = $matches[1];
                }
            }
        }
    }

    $text = preg_replace(
        '/<video\b[^>]*>.*?<\/video>/is',
        '',
        $text
    );

    $text = preg_replace(
        '/<br\s*\/?>/i',
        "\n",
        $text
    );

    $text = preg_replace(
        '/<\/p>/i',
        "\n\n",
        $text
    );

    $text = strip_tags($text);

    $text = html_entity_decode(
        $text,
        ENT_QUOTES | ENT_HTML5,
        'UTF-8'
    );

    $text = preg_replace('/[ \t]+/', ' ', $text);

    $paragraphs = preg_split('/\R\s*\R/', trim($text));

    $text = trim($paragraphs[0] ?? '');

    if (mb_strlen($text) > 100) {
        $text = mb_substr($text, 0, 100) . '...';
    }


    // Иконка корневого раздела
    $sectionId = (int)$arItem['IBLOCK_SECTION_ID'];
    $rootSection = $rootSectionCache[$sectionId] ?? null;

    $rootIcon = $rootSection['UF_ICON'] ?? 0;

    $arItem['HASHTAGS']['TAGS'] = $hashtagsTag;
    $arItem['TEXT'] = $text;
    $arItem['ICON'] = $rootIcon
        ? CFile::GetPath($rootIcon)
        : '';
}

unset($arItem);