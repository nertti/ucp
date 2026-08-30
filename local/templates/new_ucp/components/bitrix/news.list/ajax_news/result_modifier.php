<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult["ITEMS"] as &$arItem) {
    $hashtagsTag = [];

// Теги
    if (!empty($arItem['PROPERTIES']['TAGS']['VALUE'])) {
        $tagXmlIds = (array)$arItem['PROPERTIES']['TAGS']['VALUE'];
        foreach ($tagXmlIds as $xmlId) {
            $tags = getHLData(
                'Tags',
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
    $hashtagsProject = [];

// Проекты
    if (!empty($arItem['PROPERTIES']['PROJECTS']['VALUE'])) {
        $projectXmlIds = (array)$arItem['PROPERTIES']['PROJECTS']['VALUE'];

        foreach ($projectXmlIds as $xmlId) {
            $projects = getHLData(
                'projects',
                ['UF_XML_ID' => $xmlId]
            );
            foreach ($projects as $project) {
                if (!empty($project['UF_NAME'])) {
                    $arProject = ['NAME' => $project['UF_NAME'], 'LINK' => 'project=' . $project['UF_XML_ID'], 'UF_XML_ID' => $project['UF_XML_ID']];
                    $hashtagsProject[] = $arProject;
                }
            }
        }
    }
    $iconSRC = '';
    // иконки
    if (!empty($arItem['PROPERTIES']['ICON']['VALUE'])) {
        $icon = getHLData(
            'IconsNews',
            ['UF_XML_ID' => $arItem['PROPERTIES']['ICON']['VALUE']]
        );
        $iconSRC = $icon[0]['UF_ICON'];
    }

//превью текст
    $text = !empty($arItem['PREVIEW_TEXT'])
        ? $arItem['PREVIEW_TEXT']
        : $arItem['DETAIL_TEXT'];
    $text = preg_replace('/<video\b[^>]*>.*?<\/video>/is', '', $text);
    $text = strip_tags($text);
    $paragraphs = preg_split('/\R\s*\R/', trim($text));
    $text = trim($paragraphs[0] ?? '');
    if (mb_strlen($text) > 100) {
        $text = mb_substr($text, 0, 100) . '...';
    }

    $arItem['HASHTAGS']['TAGS'] = $hashtagsTag;
    $arItem['HASHTAGS']['PROJECTS'] = $hashtagsProject;
    $arItem['ICON'] = $iconSRC;
    $arItem['TEXT'] = $text;
}