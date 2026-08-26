<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if (!CModule::IncludeModule('iblock')) {
    die('Модуль iblock не подключен');
}

$iblockId = 2;
$sectionId = 3;

$rsElements = CIBlockElement::GetList(
        [],
        [
                'IBLOCK_ID' => $iblockId,
                'SECTION_ID' => $sectionId,
                'INCLUDE_SUBSECTIONS' => 'N',
        ],
        false,
        false,
        ['ID', 'NAME']
);

$el = new CIBlockElement();

while ($element = $rsElements->Fetch()) {

    $result = $el->Update(
            $element['ID'],
            [
                    'IBLOCK_SECTION_ID' => false,
            ]
    );

    if ($result) {
        echo 'Перенесено в корень: ID ' . $element['ID']
                . ' — ' . htmlspecialcharsbx($element['NAME'])
                . '<br>';
    } else {
        echo '<span style="color:red">'
                . 'Ошибка ID ' . $element['ID']
                . ': ' . $el->LAST_ERROR
                . '</span><br>';
    }
}

echo '<br><b>Готово</b>';