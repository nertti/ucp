<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
$hashtags = [];

foreach ($arResult["ITEMS"] as &$arItem){

// TAGS
    if (!empty($arItem['PROPERTIES']['TAGS']['VALUE'])) {
        $tags = getHLData(
            'Tags',
            ['UF_XML_ID', 'UF_NAME'],
            ['UF_XML_ID' => (array)$arItem['PROPERTIES']['TAGS']['VALUE']]
        );
        foreach ($tags as $tag) {
            if (!empty($tag['UF_NAME'])) {
                $hashtags[] = $tag['UF_NAME'];
            }
        }
    }

// PROJECTS
    if (!empty($arItem['PROPERTIES']['PROJECTS']['VALUE'])) {
        $projects = getHLData(
            'Projects',
            ['UF_XML_ID', 'UF_NAME'],
            ['UF_XML_ID' => (array)$arItem['PROPERTIES']['PROJECTS']['VALUE']]
        );

        foreach ($projects as $project) {
            if (!empty($project['UF_NAME'])) {
                $hashtags[] = $project['UF_NAME'];
            }
        }
    }
    $arItem['HASHTAGS'] = $hashtags;
}