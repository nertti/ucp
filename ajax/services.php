<?php

define('STOP_STATISTICS', true);
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('DisableEventsCheck', true);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    die();
}


$filterName = 'arrFilter';

$GLOBALS[$filterName] = [];


/**
 * =========================================================
 * ПОИСК ПО НАЗВАНИЮ
 * =========================================================
 */

$search = trim($_POST['search'] ?? '');

if ($search !== '') {

    $GLOBALS[$filterName]['%NAME'] = $search;

}


/**
 * =========================================================
 * КАТЕГОРИИ
 * =========================================================
 */

$sections = $_POST['section'] ?? [];

if (!is_array($sections)) {

    $sections = [
            $sections
    ];

}


$sections = array_filter(
        array_map(
                'intval',
                $sections
        )
);


if (!empty($sections)) {

    $GLOBALS[$filterName]['SECTION_ID'] =
            $sections;

}


/**
 * =========================================================
 * TAG
 * =========================================================
 */

$tag = trim($_POST['tag'] ?? '');

if ($tag !== '') {

    $GLOBALS[$filterName]['PROPERTY_TAGS'] =
            $tag;

}


/**
 * =========================================================
 * СОРТИРОВКА
 * =========================================================
 */
$sort = $_POST['sort'] ?? 'random';

$allowedSorts = [
        'random',
        'popular',
        'name_asc',
        'name_desc',
        'new'
];

if (!in_array($sort, $allowedSorts, true)) {
    $sort = 'random';
}

$sortBy1 = 'SORT';
$sortOrder1 = 'ASC';

$sortBy2 = 'ACTIVE_FROM';
$sortOrder2 = 'DESC';

switch ($sort) {

    /**
     * В случайном порядке
     */
    case 'random':

        $sortBy1 = 'RAND';
        $sortOrder1 = 'ASC';

        $sortBy2 = 'ID';
        $sortOrder2 = 'ASC';

        break;


    /**
     * По популярности
     */
    case 'popular':

        $sortBy1 = 'PROPERTY_VIEWS';
        $sortOrder1 = 'DESC';

        $sortBy2 = 'ACTIVE_FROM';
        $sortOrder2 = 'DESC';

        break;


    /**
     * По названию А-Я
     */
    case 'name_asc':

        $sortBy1 = 'NAME';
        $sortOrder1 = 'ASC';

        $sortBy2 = 'ID';
        $sortOrder2 = 'ASC';

        break;


    /**
     * По названию Я-А
     */
    case 'name_desc':

        $sortBy1 = 'NAME';
        $sortOrder1 = 'DESC';

        $sortBy2 = 'ID';
        $sortOrder2 = 'DESC';

        break;


    /**
     * Сначала новые
     */
    case 'new':

        $sortBy1 = 'ACTIVE_FROM';
        $sortOrder1 = 'DESC';

        $sortBy2 = 'SORT';
        $sortOrder2 = 'ASC';

        break;

}
?>
<div class="services__list-wrapper" id="services-list">
    <?php

    $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "ajax_services",
            [
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "N",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => [
                            "",
                            ""
                    ],
                    "FILTER_NAME" => $filterName,
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "79",
                    "IBLOCK_TYPE" => "services",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "21",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "pagination",
                    "PAGER_TITLE" => "Услуги",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => [
                            "VIEW_ON_MAIN",
                            "TAGS",
                            "TAG"
                    ],
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                /**
                 * СОРТИРОВКА
                 */
                    "SORT_BY1" => $sortBy1,
                    "SORT_BY2" => $sortBy2,
                    "SORT_ORDER1" => $sortOrder1,
                    "SORT_ORDER2" => $sortOrder2,
                    "STRICT_SECTION_CHECK" => "N",
                /**
                 * ПАГИНАЦИЯ
                 */
                    "PAGER_BASE_LINK_ENABLE" => "Y",
                    "PAGER_BASE_LINK" => "/services/",
            ]
    );

    ?>

</div>