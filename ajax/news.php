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
 * Поиск по названию
 */
$search = trim($_POST['search'] ?? '');

if ($search !== '') {
    $GLOBALS[$filterName]['%NAME'] = $search;
}

/**
 * Категория
 */
$categories = $_POST['category'] ?? [];

if (!is_array($categories)) {
    $categories = [$categories];
}

$categories = array_filter(array_map('intval', $categories));

if (!empty($categories)) {
    $categoryFilter = [
            'LOGIC' => 'OR',
    ];

    foreach ($categories as $category) {
        $categoryFilter[] = [
                'PROPERTY_CATEGORY' => $category,
        ];
    }

    $GLOBALS[$filterName][] = $categoryFilter;
}

/**
 * Институт / филиал
 */
$sections = $_POST['section'] ?? [];

if (!is_array($sections)) {
    $sections = [$sections];
}

$sections = array_filter(
        array_map('intval', $sections)
);

if ($sections) {
    $GLOBALS[$filterName]['SECTION_ID'] = $sections;
    $GLOBALS[$filterName]['INCLUDE_SUBSECTIONS'] = 'Y';
}

if (!empty($_POST['tag'])) {
    $GLOBALS[$filterName]['PROPERTY_TAGS'] = $_POST['tag'];
}

if (!empty($_POST['project'])) {
    $GLOBALS[$filterName]['PROPERTY_PROJECTS'] = $_POST['project'];
}
?>

<?php if (!empty($_POST['tag']) || !empty($_POST['project'])): ?>
        <div class="hashtags-header" data-da=".hashtags-header-mobile,950,1">
            <ul>
                <?php if (!empty($_POST['tag'])): ?>
                    <?php foreach ((array)$_POST['tag'] as $tag): ?>
                        <li>
                            <a href="#">
                                <span>#<?= htmlspecialcharsbx($tag) ?></span>
                                <button type="button">
                                    <iconify-icon icon="lucide:x" width="16" height="16" noobserver=""></iconify-icon>
                                </button>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if (!empty($_POST['project'])): ?>
                    <?php foreach ((array)$_POST['project'] as $project): ?>
                        <li>
                            <a href="#">
                                <span>#<?= htmlspecialcharsbx($project) ?></span>
                                <button type="button">
                                    <iconify-icon icon="lucide:x" width="16" height="16" noobserver=""></iconify-icon>
                                </button>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
<?php endif; ?>
<div class="news__list-wrapper" id="news-list">
    <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "ajax_news",
            array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "Y",
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
                    "FIELD_CODE" => array("", ""),
                    "FILTER_NAME" => $filterName,
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "2",
                    "IBLOCK_TYPE" => "news",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "N",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "20",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "pagination",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array("VIEW_ON_MAIN", "CATEGORY", "PROJECTS", "TAGS", ""),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N"
            ),
            $component
    ); ?>
</div>

