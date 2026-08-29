<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}


if (!empty($arResult['PROPERTIES']['TAGS']['VALUE'])) {
    $tagXmlIds = (array)$arResult['PROPERTIES']['TAGS']['VALUE'];
    foreach ($tagXmlIds as $xmlId) {
        $tags = getHLData(
            'Tags',
            ['UF_XML_ID' => $xmlId]
        );
        foreach ($tags as $tag) {
            if (!empty($tag['UF_NAME'])) {
                $arTag = ['NAME' => $tag['UF_NAME'], 'LINK' => 'tag=' . $tag['UF_NAME']];
                $hashtags[] = $arTag;
            }
        }
    }
}

// Проекты
if (!empty($arResult['PROPERTIES']['PROJECTS']['VALUE'])) {
    $projectXmlIds = (array)$arResult['PROPERTIES']['PROJECTS']['VALUE'];

    foreach ($projectXmlIds as $xmlId) {
        $projects = getHLData(
            'projects',
            ['UF_XML_ID' => $xmlId]
        );
        foreach ($projects as $project) {
            if (!empty($project['UF_NAME'])) {
                $arProject = ['NAME' => $project['UF_NAME'], 'LINK' => 'project=' . $project['UF_NAME']];
                $hashtags[] = $arProject;
            }
        }
    }
}
$arResult['HASHTAGS'] = $hashtags;
