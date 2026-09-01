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
?>
<main class="page">
    <div class="page__container">
        <nav class="page__sidebar">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/include/news/filter.php'; ?>
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
                    <h1 class="title-two">Новости</h1>
                    <a href="#" class="button-rss" data-da=".button-rss__mobile,950,1">
                        <iconify-icon icon="line-md:rss" width="24" height="24" noobserver></iconify-icon>
                        <span>RSS</span>
                    </a>
                </div>
                <div class="hashtags-header" data-da=".hashtags-header-mobile,950,1">
                    <ul></ul>
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
                    <div class="button-rss__mobile"></div>
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
                                        <iconify-icon icon="lucide:chevron-right" width="24" height="24"
                                                      noobserver></iconify-icon>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            /**
             * Категория
             */
            $categories = $_GET['category'] ?? [];

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
            $sections = $_GET['section'] ?? [];

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
            if (!empty($_GET['tag'])) {
            $GLOBALS[$filterName]['PROPERTY_TAGS'] = $_GET['tag'];
            }

            if (!empty($_GET['project'])) {
            $GLOBALS[$filterName]['PROPERTY_PROJECTS'] = $_GET['project'];
            }

            if (!empty($_GET['is-project'])) {
                $GLOBALS[$filterName]['PROPERTY_IS_PROJECTS'] = $_GET['is-project'];
            }
            ?>
            <div class="news__list-wrapper" id="news-list">
                <?php
                $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "",
                        [
                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "NEWS_COUNT" => $arParams["NEWS_COUNT"],
                                "SORT_BY1" => $arParams["SORT_BY1"],
                                "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                                "SORT_BY2" => $arParams["SORT_BY2"],
                                "SORT_ORDER2" => $arParams["SORT_ORDER2"],
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
