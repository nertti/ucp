<?php

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    return;
}

$iblockId = (int)$arParams['IBLOCK_ID'];

$sections = [];

/**
 * Получаем все активные разделы
 */
$res = CIBlockSection::GetList(
    [
        'LEFT_MARGIN' => 'ASC',
    ],
    [
        'IBLOCK_ID' => $iblockId,
        'ACTIVE' => 'Y',
    ],
    false,
    [
        'ID',
        'IBLOCK_SECTION_ID',
        'NAME',
        'SORT',
        'DEPTH_LEVEL',
    ]
);

while ($section = $res->GetNext()) {
    $section['ID'] = (int)$section['ID'];
    $section['IBLOCK_SECTION_ID'] = (int)$section['IBLOCK_SECTION_ID'];
    $section['DEPTH_LEVEL'] = (int)$section['DEPTH_LEVEL'];

    $sections[$section['ID']] = $section;
}

/**
 * Формируем дерево
 */
$sectionTree = [];

foreach ($sections as $id => &$section) {

    if ($section['IBLOCK_SECTION_ID'] > 0) {

        $parentId = $section['IBLOCK_SECTION_ID'];

        if (isset($sections[$parentId])) {
            $sections[$parentId]['CHILDREN'][] = &$section;
        }

    } else {

        $sectionTree[] = &$section;
    }
}

unset($section);


/**
 * Вывод дерева разделов
 */
function renderServiceSections(array $sections): void
{
    foreach ($sections as $section):

        $children = $section['CHILDREN'] ?? [];
        $hasChildren = !empty($children);
        ?>

        <li>

            <?php if ($hasChildren): ?>

                <div data-spollers class="spollers">

                    <details class="spollers__item">

                        <summary class="spollers__title">

                            <a
                                href="#"
                                class="spoller-link services-filter-section"
                                data-section="<?= (int)$section['ID'] ?>"
                            >
                                <span>
                                    <?= htmlspecialcharsbx($section['NAME']) ?>
                                </span>
                            </a>

                        </summary>

                        <div class="spollers__body">

                            <ul>
                                <?php renderServiceSections($children); ?>
                            </ul>

                        </div>

                    </details>

                </div>

            <?php else: ?>

                <a
                    href="#"
                    class="spoller-link services-filter-section"
                    data-section="<?= (int)$section['ID'] ?>"
                >
                    <span>
                        <?= htmlspecialcharsbx($section['NAME']) ?>
                    </span>
                </a>

            <?php endif; ?>

        </li>

    <?php
    endforeach;
}
?>

<div
    class="page__sidebar-content"
    data-da=".page__sidebar-content-mobile,950,1"
>

    <div class="page__sidebar-search-content">

        <p>Быстрый поиск</p>

        <div class="page__sidebar-search">

            <div class="page__sidebar-search-input">

                <button
                    type="button"
                    class="page__sidebar-search-btn page__sidebar-search-btn--search"
                >
                    <div class="page__sidebar-search-btn-icon">
                        <iconify-icon
                            icon="lucide:search"
                            width="100%"
                            height="100%"
                            noobserver
                        ></iconify-icon>
                    </div>
                </button>

                <input
                    type="text"
                    name="service_search"
                    placeholder="Введите запрос..."
                    autocomplete="off"
                />

                <button
                    type="button"
                    class="page__sidebar-search-btn page__sidebar-search-btn--clear"
                >
                    <div class="page__sidebar-search-btn-icon">
                        <iconify-icon
                            icon="lucide:x"
                            width="100%"
                            height="100%"
                            noobserver
                        ></iconify-icon>
                    </div>
                </button>

            </div>

        </div>

    </div>


    <div data-spollers class="spollers">

        <details class="spollers__item" data-open>

            <summary class="spollers__title">
                Услуги
            </summary>

            <div class="spollers__body">

                <ul>

                    <?php renderServiceSections($sectionTree); ?>

                </ul>

            </div>

        </details>

    </div>

</div>