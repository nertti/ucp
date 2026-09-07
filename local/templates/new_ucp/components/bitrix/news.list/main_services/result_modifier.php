<?php

use Bitrix\Main\Loader;
use Bitrix\Iblock\Model\Section;

foreach ($arResult["ITEMS"] as &$arItem) {
    $text = !empty($arItem['PREVIEW_TEXT'])
        ? $arItem['PREVIEW_TEXT']
        : $arItem['DETAIL_TEXT'];
    if (empty(trim(strip_tags($text))) && !empty($arItem['PROPERTIES']['CONTENT']['VALUE'])) {
        $content = $arItem['PROPERTIES']['CONTENT']['VALUE'] ?? '';

        if (!empty($content)) {

            $content = html_entity_decode(
                $content,
                ENT_QUOTES | ENT_HTML5,
                'UTF-8'
            );

            // Ищем первый блок с name="text" и достаём его value
            if (preg_match('/"value"\s*:\s*"((?:\\\\.|[^"\\\\])*)"\s*,\s*"name"\s*:\s*"text"/s', $content, $matches)) {
                $text = json_decode('"' . $matches[1] . '"');

                if ($text === null) {
                    $text = $matches[1];
                }
            }
        }
    }
    $text = preg_replace('/<video\b[^>]*>.*?<\/video>/is', '', $text);
    $text = preg_replace('/<br\s*\/?>/i', "\n", $text);
    $text = preg_replace('/<\/p>/i', "\n\n", $text);
    $text = strip_tags($text);
    $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $text = preg_replace('/[ \t]+/', ' ', $text);
    $paragraphs = preg_split('/\R\s*\R/', trim($text));
    $text = trim($paragraphs[0] ?? '');
    if (mb_strlen($text) > 100) {
        $text = mb_substr($text, 0, 100) . '...';
    }

    $arItem['TEXT'] = $text;
}

$arResult["PARENT_SECTIONS"] = [];


// Создаем фабричную ORM-сущность именно для нашего инфоблока
$sectionEntity = Section::compileEntityByIblock($arParams["IBLOCK_ID"]);

$sectionsData = $sectionEntity::getList([
    'select' => [
        'ID',
        'NAME',
        'CODE',
        'IBLOCK_SECTION_ID',
        'UF_ICON_MAIN_1' // Теперь поле успешно выберется без ошибок
    ],
    'filter' => [
        '=ACTIVE' => 'Y',
        '=IBLOCK_SECTION_ID' => null // Выбираем только корневые разделы
    ],
    'order' => [
        'SORT' => 'ASC',
        'NAME' => 'ASC'
    ],
    'cache' => [
        'ttl' => 3600 // Кэширование на 1 час
    ]
]);

while ($section = $sectionsData->fetch()) {
    $arResult["PARENT_SECTIONS"][] = $section;
}