<?php

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    return;
}

$iblockId = (int)$arParams['IBLOCK_ID'];

// Получаем ID свойства CATEGORY
$categoryPropertyId = 0;

$propertyRes = CIBlockProperty::GetList(
        [],
        [
                'IBLOCK_ID' => $iblockId,
                'CODE' => 'CATEGORY',
        ]
);

if ($property = $propertyRes->Fetch()) {
    $categoryPropertyId = (int)$property['ID'];
}

// Получаем значения CATEGORY
$categories = [];

if ($categoryPropertyId) {
    $enumRes = CIBlockPropertyEnum::GetList(
            ['SORT' => 'ASC'],
            ['PROPERTY_ID' => $categoryPropertyId]
    );

    while ($enum = $enumRes->GetNext()) {
        $categories[] = $enum;
    }
}

// Получаем разделы первого уровня
$sections = [];

$sectionRes = CIBlockSection::GetList(
        ['SORT' => 'ASC', 'NAME' => 'ASC'],
        [
                'IBLOCK_ID' => $iblockId,
                'ACTIVE' => 'Y',
                'DEPTH_LEVEL' => 1,
        ],
        false,
        [
                'ID',
                'NAME',
                'SORT',
        ]
);

while ($section = $sectionRes->GetNext()) {
    $sections[] = $section;
}
?>

<div class="page__sidebar-content" data-da=".page__sidebar-content-mobile,950, 1">

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
                        name="news_search"
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

        <!-- Категории -->
        <details class="spollers__item" data-open>
            <summary class="spollers__title">
                Категории новостей
            </summary>

            <div class="spollers__body">
                <ul>
                    <?php foreach ($categories as $category): ?>
                        <li>
                            <a
                                    href="/"
                                    class="news-filter-category"
                                    data-category="<?= (int)$category['ID'] ?>"
                            >
                                <span><?= htmlspecialcharsbx($category['VALUE']) ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>
        </details>


        <!-- Институты и филиалы -->
        <details class="spollers__item">
            <summary class="spollers__title">
                Институты и филиалы
            </summary>

            <div class="spollers__body">
                <ul>
                    <?php foreach ($sections as $section): ?>
                        <li>
                            <a
                                    href="#"
                                    class="news-filter-section"
                                    data-section="<?= (int)$section['ID'] ?>"
                            >
                                <span><?= htmlspecialcharsbx($section['NAME']) ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>
        </details>

    </div>
</div>