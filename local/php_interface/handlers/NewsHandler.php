<?php
function onAfterIBlockElementAddHandler(&$arFields)
{
    // Только инфоблок 83
    if ((int)$arFields['IBLOCK_ID'] !== 83) {
        return;
    }

    // Элемент должен быть успешно создан
    if ((int)$arFields['RESULT'] <= 0) {
        return;
    }

    // Получаем SHORT_NAME
    $property = CIBlockElement::GetProperty(
        83,
        $arFields['ID'],
        [],
        ['CODE' => 'SHORT_NAME']
    )->Fetch();

    if (!$property) {
        return;
    }

    $shortName = trim((string)$property['VALUE']);

    if ($shortName === '') {
        return;
    }

    // Транслитерация SHORT_NAME
    $xmlId = CUtil::translit(
        $shortName,
        'ru',
        [
            'max_len' => 255,
            'change_case' => 'L',
            'replace_space' => '-',
            'replace_other' => '-',
            'delete_repeat_replace' => true,
        ]
    );

    // Создаём запись в HL-блоке 2
    setHLData('projects', [
        'UF_NAME'   => $shortName,
        'UF_XML_ID' => $xmlId,
    ]);

    // Сохраняем английскую версию в TAG
    CIBlockElement::SetPropertyValuesEx(
        $arFields['ID'],
        83,
        [
            'TAG' => $xmlId,
        ]
    );
}