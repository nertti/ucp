<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$filterName = $arParams['FILTER_NAME'] ?: 'arrFilter';

/**
 * Сортировка
 */
$sort = $_GET['sort'] ?? 'popular';

$allowedSorts = [
        'popular',
        'name_asc',
        'name_desc',
        'new',
];

if (!in_array($sort, $allowedSorts, true)) {
    $sort = 'popular';
}

$sortBy1 = 'SORT';
$sortOrder1 = 'ASC';
$sortBy2 = 'ACTIVE_FROM';
$sortOrder2 = 'DESC';

switch ($sort) {
    case 'name_asc':
        $sortBy1 = 'NAME';
        $sortOrder1 = 'ASC';
        $sortBy2 = 'ID';
        $sortOrder2 = 'ASC';
        break;

    case 'name_desc':
        $sortBy1 = 'NAME';
        $sortOrder1 = 'DESC';
        $sortBy2 = 'ID';
        $sortOrder2 = 'DESC';
        break;

    case 'new':
        $sortBy1 = 'ACTIVE_FROM';
        $sortOrder1 = 'DESC';
        $sortBy2 = 'SORT';
        $sortOrder2 = 'ASC';
        break;

    case 'popular':
        $sortBy1 = 'PROPERTY_VIEWS';
        $sortOrder1 = 'DESC';
        $sortBy2 = 'ACTIVE_FROM';
        $sortOrder2 = 'DESC';
        break;
    default:
        $sortBy1 = 'SORT';
        $sortOrder1 = 'ASC';
        $sortBy2 = 'ACTIVE_FROM';
        $sortOrder2 = 'DESC';
        break;
}
?>
<main class="page">
    <div class="page__container">
        <nav class="page__sidebar">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/include/services/filter.php'; ?>
            <?php $APPLICATION->IncludeFile(
                    "/include/left/banners.php",
                    array(),
                    array(
                            "MODE" => "html"
                    )
            ); ?>
        </nav>
        <div class="page__content">
            <div class="page__content-header">
                <div class="title-block">
                    <h1 class="title-two">Услуги</h1>
                    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/include/services/sort.php'; ?>
                </div>
                <div class="hashtags-header" data-da=".hashtags-header-mobile,950, 1">
                    <ul>
                    </ul>
                </div>
                <?php $APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "breadcrumb",
                        array(
                                "COMPONENT_TEMPLATE" => "breadcrumb",
                                "PATH" => "",
                                "SITE_ID" => "s1",
                                "START_FROM" => "0"
                        )
                ); ?>
                <div class="page__mobile-action">
                    <button type="button" class="button-filter">
                        <div class="icon">
                            <iconify-icon icon="iconoir:filter" width="100%" height="100%" noobserver></iconify-icon>
                        </div>
                        <span>Фильтр</span>
                    </button>
                    <div class="sort-mobile"></div>
                    <div class="page__mobile-filter">
                        <div class="page__mobile-filter-header">
                            <h4 class="title-four">Фильтр</h4>
                            <button class="filter-close" data-close>
                                <iconify-icon icon="lucide:x" width="24" height="24" noobserver></iconify-icon>
                            </button>
                        </div>

                        <div class="page__mobile-filter-content">
                            <form action="#">
                                <div class="page__sidebar-content-mobile"></div>
                                <div class="page__mobile-filter-action">
                                    <button type="button" class="button-result" data-close>
                                        <span>Показать результат</span>
                                        <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            /**
             * Институт / филиал
             */
            $sections = $_GET['section'] ?? [];

            if (!is_array($sections)) {
                $sections = [$sections];
            }

            $sections = array_filter(
                    array_map('intval', $sections)
            );

            if ($sections) {
                $GLOBALS[$filterName]['SECTION_ID'] = $sections;
            }
            if (!empty($_GET['tag'])) {
                $GLOBALS[$filterName]['PROPERTY_TAGS'] = $_GET['tag'];
            }
            ?>
            <div class="services__list-wrapper" id="services-list">
                <?php
                $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "",
                        [
                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "NEWS_COUNT" => $arParams["NEWS_COUNT"],
                                "SORT_BY1" => $sortBy1,
                                "SORT_ORDER1" => $sortOrder1,
                                "SORT_BY2" => $sortBy2,
                                "SORT_ORDER2" => $sortOrder2,
                                "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                                "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                                "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                                "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
                                "SET_TITLE" => $arParams["SET_TITLE"],
                                "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                                "MESSAGE_404" => $arParams["MESSAGE_404"],
                                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                "SHOW_404" => $arParams["SHOW_404"],
                                "FILE_404" => $arParams["FILE_404"],
                                "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                                "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                                "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                                "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                                "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                                "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                                "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                                "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                                "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                                "FILTER_NAME" => $filterName,
                                "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                                "CHECK_DATES" => $arParams["CHECK_DATES"],
                        ],
                        $component
                );
                ?>
            </div>
        </div>
    </div>
</main>
