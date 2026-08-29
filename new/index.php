<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Университет гражданской защиты");
$APPLICATION->SetTitle("Университет гражданской защиты");
?>
<main class="home">
    <!-- Секция: превью -->
    <?php
    $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "banner_slider",
            [
                    "IBLOCK_ID" => 2,
                    "NEWS_COUNT" => 5,
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600"
            ],
            false
    );
    ?>
    <div class="home__wrapper">
        <nav class="home__subnav">
            <?php
            $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "main_links_left",
                    [
                            "IBLOCK_ID" => "85",
                            "NEWS_COUNT" => "8",
                            "SORT_BY1" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "COMPONENT_TEMPLATE" => "main_links_left",
                            "IBLOCK_TYPE" => "news",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "",
                            "FIELD_CODE" => [
                                    0 => "",
                                    1 => "",
                            ],
                            "PROPERTY_CODE" => [
                                    0 => "LINK",
                                    1 => "ICON_MOBILE",
                            ],
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "STRICT_SECTION_CHECK" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "PAGER_TITLE" => "Новости",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => ""
                    ],
                    false
            );
            ?>
            <?php
            $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "main_links_right",
                    [
                            "IBLOCK_ID" => "86",
                            "NEWS_COUNT" => "8",
                            "SORT_BY1" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "COMPONENT_TEMPLATE" => "main_links_right",
                            "IBLOCK_TYPE" => "news",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "",
                            "FIELD_CODE" => [
                                    0 => "",
                                    1 => "",
                            ],
                            "PROPERTY_CODE" => [
                                    0 => "LINK",
                                    1 => "ICON",
                            ],
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "STRICT_SECTION_CHECK" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "PAGER_TITLE" => "Новости",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => ""
                    ],
                    false
            );
            ?>
        </nav>

        <div class="home__content">
            <!-- Секция: новости и события -->
            <section class="home__feed">
                <div class="home__container">
                    <nav class="home__feed-nav">
                        <?php
                        $APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "main_links",
                                [
                                        "IBLOCK_ID" => "85",
                                        "NEWS_COUNT" => "8",
                                        "SORT_BY1" => "SORT",
                                        "SORT_ORDER1" => "ASC",
                                        "CACHE_TYPE" => "A",
                                        "CACHE_TIME" => "3600",
                                        "COMPONENT_TEMPLATE" => "main_links",
                                        "IBLOCK_TYPE" => "news",
                                        "SORT_BY2" => "SORT",
                                        "SORT_ORDER2" => "ASC",
                                        "FILTER_NAME" => "",
                                        "FIELD_CODE" => [
                                                0 => "",
                                                1 => "",
                                        ],
                                        "PROPERTY_CODE" => [
                                                0 => "LINK",
                                                1 => "BACKGROUND",
                                                2 => "ICON_DESKTOP",
                                        ],
                                        "CHECK_DATES" => "Y",
                                        "DETAIL_URL" => "",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "CACHE_FILTER" => "N",
                                        "CACHE_GROUPS" => "Y",
                                        "PREVIEW_TRUNCATE_LEN" => "",
                                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "SET_TITLE" => "N",
                                        "SET_BROWSER_TITLE" => "N",
                                        "SET_META_KEYWORDS" => "N",
                                        "SET_META_DESCRIPTION" => "N",
                                        "SET_LAST_MODIFIED" => "N",
                                        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                        "ADD_SECTIONS_CHAIN" => "N",
                                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                        "PARENT_SECTION" => "",
                                        "PARENT_SECTION_CODE" => "",
                                        "INCLUDE_SUBSECTIONS" => "Y",
                                        "STRICT_SECTION_CHECK" => "N",
                                        "PAGER_TEMPLATE" => ".default",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "DISPLAY_BOTTOM_PAGER" => "Y",
                                        "PAGER_TITLE" => "Новости",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "SET_STATUS_404" => "N",
                                        "SHOW_404" => "N",
                                        "MESSAGE_404" => ""
                                ],
                                false
                        );
                        ?>
                    </nav>


                    <div class="home__feed-content">
                        <? $APPLICATION->IncludeComponent(
                                "bitrix:news",
                                "template_news",
                                [
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "IBLOCK_TYPE" => "news",
                                        "IBLOCK_ID" => "2",
                                        "NEWS_COUNT" => "20",
                                        "USE_SEARCH" => "N",
                                        "USE_RSS" => "N",
                                        "USE_RATING" => "N",
                                        "USE_CATEGORIES" => "N",
                                        "USE_REVIEW" => "N",
                                        "USE_FILTER" => "N",
                                        "SORT_BY1" => "ACTIVE_FROM",
                                        "SORT_ORDER1" => "DESC",
                                        "SORT_BY2" => "SORT",
                                        "SORT_ORDER2" => "ASC",
                                        "CHECK_DATES" => "Y",
                                        "SEF_MODE" => "Y",
                                        "SEF_FOLDER" => "/new/news/",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "CACHE_TYPE" => "A",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_FILTER" => "N",
                                        "CACHE_GROUPS" => "Y",
                                        "SET_LAST_MODIFIED" => "N",
                                        "SET_TITLE" => "Y",
                                        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                        "ADD_SECTIONS_CHAIN" => "Y",
                                        "ADD_ELEMENT_CHAIN" => "N",
                                        "USE_PERMISSIONS" => "N",
                                        "STRICT_SECTION_CHECK" => "N",
                                        "DISPLAY_DATE" => "Y",
                                        "DISPLAY_PICTURE" => "Y",
                                        "DISPLAY_PREVIEW_TEXT" => "Y",
                                        "USE_SHARE" => "N",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                                        "PREVIEW_TRUNCATE_LEN" => "",
                                        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "LIST_FIELD_CODE" => [
                                                0 => "",
                                                1 => "",
                                        ],
                                        "LIST_PROPERTY_CODE" => [
                                                0 => "",
                                                1 => "",
                                        ],
                                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                        "DISPLAY_NAME" => "Y",
                                        "META_KEYWORDS" => "-",
                                        "META_DESCRIPTION" => "-",
                                        "BROWSER_TITLE" => "-",
                                        "DETAIL_SET_CANONICAL_URL" => "N",
                                        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "DETAIL_FIELD_CODE" => [
                                                0 => "",
                                                1 => "",
                                        ],
                                        "DETAIL_PROPERTY_CODE" => [
                                                0 => "",
                                                1 => "",
                                        ],
                                        "DETAIL_DISPLAY_TOP_PAGER" => "N",
                                        "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                                        "DETAIL_PAGER_TITLE" => "Страница",
                                        "DETAIL_PAGER_TEMPLATE" => "",
                                        "DETAIL_PAGER_SHOW_ALL" => "Y",
                                        "PAGER_TEMPLATE" => ".default",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "DISPLAY_BOTTOM_PAGER" => "Y",
                                        "PAGER_TITLE" => "Новости",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "SET_STATUS_404" => "N",
                                        "SHOW_404" => "N",
                                        "MESSAGE_404" => "",
                                        "SEF_URL_TEMPLATES" => [
                                                "news" => "",
                                                "section" => "",
                                                "detail" => "#ELEMENT_CODE#/",
                                        ]
                                ],
                                false
                        ); ?>

                        <? $APPLICATION->IncludeComponent(
                                "bitrix:news",
                                "sob_hom",
                                [
                                        "ADD_ELEMENT_CHAIN" => "N",
                                        "ADD_SECTIONS_CHAIN" => "Y",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "BROWSER_TITLE" => "-",
                                        "CACHE_FILTER" => "N",
                                        "CACHE_GROUPS" => "Y",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_TYPE" => "A",
                                        "CHECK_DATES" => "Y",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                                        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                                        "DETAIL_DISPLAY_TOP_PAGER" => "N",
                                        "DETAIL_FIELD_CODE" => [
                                                0 => "",
                                                1 => "",
                                        ],
                                        "DETAIL_PAGER_SHOW_ALL" => "Y",
                                        "DETAIL_PAGER_TEMPLATE" => "",
                                        "DETAIL_PAGER_TITLE" => "Страница",
                                        "DETAIL_PROPERTY_CODE" => [
                                                0 => "",
                                                1 => "",
                                        ],
                                        "DETAIL_SET_CANONICAL_URL" => "N",
                                        "DISPLAY_BOTTOM_PAGER" => "Y",
                                        "DISPLAY_DATE" => "Y",
                                        "DISPLAY_NAME" => "Y",
                                        "DISPLAY_PICTURE" => "Y",
                                        "DISPLAY_PREVIEW_TEXT" => "Y",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                        "IBLOCK_ID" => "82",
                                        "IBLOCK_TYPE" => "news",
                                        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "LIST_FIELD_CODE" => [
                                                0 => "",
                                                1 => "",
                                        ],
                                        "LIST_PROPERTY_CODE" => [
                                                0 => "favorites",
                                                1 => "POPULAR",
                                                2 => "ST",
                                                3 => "TEG",
                                                4 => "ELEMENTS_IN_ROW",
                                                5 => "DISTACE",
                                                6 => "SLIDING_ANIMATION",
                                                7 => "OPEN_ANIMATION",
                                                8 => "SPEED_ANIMATION",
                                                9 => "",
                                        ],
                                        "MESSAGE_404" => "",
                                        "META_DESCRIPTION" => "-",
                                        "META_KEYWORDS" => "-",
                                        "NEWS_COUNT" => "5",
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => ".default",
                                        "PAGER_TITLE" => "Новости",
                                        "PREVIEW_TRUNCATE_LEN" => "",
                                        "SEF_MODE" => "N",
                                        "SET_LAST_MODIFIED" => "N",
                                        "SET_STATUS_404" => "N",
                                        "SET_TITLE" => "Y",
                                        "SHOW_404" => "N",
                                        "SORT_BY1" => "ACTIVE_FROM",
                                        "SORT_BY2" => "SORT",
                                        "SORT_ORDER1" => "DESC",
                                        "SORT_ORDER2" => "ASC",
                                        "STRICT_SECTION_CHECK" => "N",
                                        "USE_CATEGORIES" => "N",
                                        "USE_FILTER" => "N",
                                        "USE_PERMISSIONS" => "N",
                                        "USE_RATING" => "N",
                                        "USE_REVIEW" => "N",
                                        "USE_RSS" => "N",
                                        "USE_SEARCH" => "N",
                                        "USE_SHARE" => "N",
                                        "COMPONENT_TEMPLATE" => "sob_hom",
                                        "VARIABLE_ALIASES" => [
                                                "SECTION_ID" => "SECTION_ID",
                                                "ELEMENT_ID" => "ELEMENT_ID",
                                        ]
                                ],
                                false
                        ); ?>
                    </div>
                </div>
            </section>
            <!-- Секция: о нас -->
            <section class="home__about">
                <div class="home__container">
                    <?php
                    $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "about_company",
                            [
                                    "IBLOCK_ID" => "84",
                                    "NEWS_COUNT" => "7",
                                    "SORT_BY1" => "SORT",
                                    "SORT_ORDER1" => "ASC",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "3600",
                                    "COMPONENT_TEMPLATE" => "about_company",
                                    "IBLOCK_TYPE" => "news",
                                    "SORT_BY2" => "SORT",
                                    "SORT_ORDER2" => "ASC",
                                    "FILTER_NAME" => "",
                                    "FIELD_CODE" => [
                                            0 => "",
                                            1 => "",
                                    ],
                                    "PROPERTY_CODE" => [
                                            0 => "TEXT",
                                            1 => "",
                                    ],
                                    "CHECK_DATES" => "Y",
                                    "DETAIL_URL" => "",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "Y",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "SET_TITLE" => "Y",
                                    "SET_BROWSER_TITLE" => "Y",
                                    "SET_META_KEYWORDS" => "Y",
                                    "SET_META_DESCRIPTION" => "Y",
                                    "SET_LAST_MODIFIED" => "N",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                    "ADD_SECTIONS_CHAIN" => "Y",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "PARENT_SECTION" => "",
                                    "PARENT_SECTION_CODE" => "",
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "STRICT_SECTION_CHECK" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "DISPLAY_BOTTOM_PAGER" => "Y",
                                    "PAGER_TITLE" => "Новости",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SHOW_404" => "N",
                                    "MESSAGE_404" => ""
                            ],
                            false
                    );
                    ?>
                </div>
            </section>

            <!-- Секция: университеты -->
            <section class="home__universities">
                <div class="home__container">
                    <div class="universities__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="universities__slider-content">
                                    <h2 class="title-two">Факультеты</h2>
                                    <ul class="universities__slider-list">
                                        <li class="universities__slider-list-item">
                                            <a href="/structure/faculties/fakultet-preduprezhdeniya-i-likvidatsii-chs/">
                                                <iconify-icon icon="iconamoon:check-bold" width="24" height="24"
                                                              noobserver></iconify-icon>
                                                <p>Факультет предупреждения и ликвидации ЧС</p>
                                            </a>
                                        </li>
                                        <li class="universities__slider-list-item">
                                            <a href="/structure/faculties/fakultet-tekhnosfernoy-bezopasnosti/">
                                                <iconify-icon icon="iconamoon:check-bold" width="24" height="24"
                                                              noobserver></iconify-icon>
                                                <p>Факультет техносферной безопасности</p>
                                            </a>
                                        </li>
                                        <li class="universities__slider-list-item">
                                            <a href="/structure/faculties/fakultet-zaochnogo-obucheniya/">
                                                <iconify-icon icon="iconamoon:check-bold" width="24" height="24"
                                                              noobserver></iconify-icon>
                                                <p>Факультет заочного обучения</p>
                                            </a>
                                        </li>
                                        <li class="universities__slider-list-item">
                                            <a href="/structure/faculties/fakultet-bezopasnosti-zhiznedeyatelnosti/">
                                                <iconify-icon icon="iconamoon:check-bold" width="24" height="24"
                                                              noobserver></iconify-icon>
                                                <p>Факультет безопасности жизнедеятельности</p>
                                            </a>
                                        </li>
                                        <li class="universities__slider-list-item">
                                            <a href="/structure/faculties/fakultet-podgotovki-nauchnykh-kadrov/">
                                                <iconify-icon icon="iconamoon:check-bold" width="24" height="24"
                                                              noobserver></iconify-icon>
                                                <p>Факультет подготовки научных кадров</p>
                                            </a>
                                        </li>
                                        <li class="universities__slider-list-item">
                                            <a href="/structure/faculties/fakultet-podgotovki-rukovodyashchikh-kadrov/">
                                                <iconify-icon icon="iconamoon:check-bold" width="24" height="24"
                                                              noobserver></iconify-icon>
                                                <p>Факультет подготовки руководящих кадров</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="universities__slider-wrapper">
                                    <div class="universities__slider-img">
                                        <img src="/dist/img/main/universities.webp" alt="Image" title="Факультеты"/>
                                    </div>
                                    <div class="universities__slider-action">
                                        <button class="universities__slider-button-prev swiper-button-prev">
                                            <iconify-icon icon="lucide:chevron-left" width="24" height="24"
                                                          noobserver></iconify-icon>
                                        </button>
                                        <button class="universities__slider-button-next swiper-button-next">
                                            <iconify-icon icon="lucide:chevron-right" width="24" height="24"
                                                          noobserver></iconify-icon>
                                        </button>
                                    </div>
                                    <div class="universities__slider-slider-pagination"></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="universities__slider-content">
                                    <h2 class="title-two">Факультеты</h2>
                                    <ul class="universities__slider-list">
                                        <li class="universities__slider-list-item">
                                            <a href="/structure/faculties/fakultet-preduprezhdeniya-i-likvidatsii-chs/">
                                                <div class="icon">
                                                    <iconify-icon icon="iconamoon:check-bold" width="100%" height="100%"
                                                                  noobserver></iconify-icon>
                                                </div>
                                                <p>Факультет предупреждения и ликвидации ЧС</p>
                                            </a>
                                        </li>
                                        <li class="universities__slider-list-item">
                                            <a href="/structure/faculties/fakultet-tekhnosfernoy-bezopasnosti/">
                                                <div class="icon">
                                                    <iconify-icon icon="iconamoon:check-bold" width="100%" height="100%"
                                                                  noobserver></iconify-icon>
                                                </div>
                                                <p>Факультет техносферной безопасности</p>
                                            </a>
                                        </li>
                                        <li class="universities__slider-list-item">
                                            <a href="/structure/faculties/fakultet-zaochnogo-obucheniya/">
                                                <div class="icon">
                                                    <iconify-icon icon="iconamoon:check-bold" width="100%" height="100%"
                                                                  noobserver></iconify-icon>
                                                </div>
                                                <p>Факультет заочного обучения</p>
                                            </a>
                                        </li>
                                        <li class="universities__slider-list-item">
                                            <a href="/structure/faculties/fakultet-bezopasnosti-zhiznedeyatelnosti/">
                                                <div class="icon">
                                                    <iconify-icon icon="iconamoon:check-bold" width="100%" height="100%"
                                                                  noobserver></iconify-icon>
                                                </div>
                                                <p>Факультет безопасности жизнедеятельности</p>
                                            </a>
                                        </li>
                                        <li class="universities__slider-list-item">
                                            <a href="/structure/faculties/fakultet-podgotovki-nauchnykh-kadrov/">
                                                <div class="icon">
                                                    <iconify-icon icon="iconamoon:check-bold" width="100%" height="100%"
                                                                  noobserver></iconify-icon>
                                                </div>
                                                <p>Факультет подготовки научных кадров</p>
                                            </a>
                                        </li>
                                        <li class="universities__slider-list-item">
                                            <a href="/structure/faculties/fakultet-podgotovki-rukovodyashchikh-kadrov/">
                                                <div class="icon">
                                                    <iconify-icon icon="iconamoon:check-bold" width="100%" height="100%"
                                                                  noobserver></iconify-icon>
                                                </div>
                                                <p>Факультет подготовки руководящих кадров</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="universities__slider-wrapper">
                                    <div class="universities__slider-img">
                                        <img src="/dist/img/main/universities.webp" alt="Image" title="Факультеты"/>
                                    </div>
                                    <div class="universities__slider-action">
                                        <button class="universities__slider-button-prev swiper-button-prev">
                                            <iconify-icon icon="lucide:chevron-left" width="24" height="24"
                                                          noobserver></iconify-icon>
                                        </button>
                                        <button class="universities__slider-button-next swiper-button-next">
                                            <iconify-icon icon="lucide:chevron-right" width="24" height="24"
                                                          noobserver></iconify-icon>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <? $APPLICATION->IncludeComponent(
                            "bitrix:news",
                            "institut",
                            [
                                    "ADD_ELEMENT_CHAIN" => "N",
                                    "ADD_SECTIONS_CHAIN" => "Y",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "BROWSER_TITLE" => "-",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_TYPE" => "A",
                                    "CHECK_DATES" => "Y",
                                    "COMPOSITE_FRAME_MODE" => "A",
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                                    "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                                    "DETAIL_DISPLAY_TOP_PAGER" => "N",
                                    "DETAIL_FIELD_CODE" => [
                                            0 => "",
                                            1 => "",
                                    ],
                                    "DETAIL_PAGER_SHOW_ALL" => "Y",
                                    "DETAIL_PAGER_TEMPLATE" => "",
                                    "DETAIL_PAGER_TITLE" => "Страница",
                                    "DETAIL_PROPERTY_CODE" => [
                                            0 => "",
                                            1 => "",
                                    ],
                                    "DETAIL_SET_CANONICAL_URL" => "N",
                                    "DISPLAY_BOTTOM_PAGER" => "Y",
                                    "DISPLAY_DATE" => "Y",
                                    "DISPLAY_NAME" => "Y",
                                    "DISPLAY_PICTURE" => "Y",
                                    "DISPLAY_PREVIEW_TEXT" => "Y",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "IBLOCK_ID" => "80",
                                    "IBLOCK_TYPE" => "education",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                    "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "LIST_FIELD_CODE" => [
                                            0 => "",
                                            1 => "",
                                    ],
                                    "LIST_PROPERTY_CODE" => [
                                            0 => "",
                                            1 => "",
                                    ],
                                    "MESSAGE_404" => "",
                                    "META_DESCRIPTION" => "-",
                                    "META_KEYWORDS" => "-",
                                    "NEWS_COUNT" => "20",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "PAGER_TITLE" => "Новости",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "SEF_MODE" => "Y",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "Y",
                                    "SHOW_404" => "N",
                                    "SORT_BY1" => "ACTIVE_FROM",
                                    "SORT_BY2" => "SORT",
                                    "SORT_ORDER1" => "DESC",
                                    "SORT_ORDER2" => "ASC",
                                    "STRICT_SECTION_CHECK" => "N",
                                    "USE_CATEGORIES" => "N",
                                    "USE_FILTER" => "N",
                                    "USE_PERMISSIONS" => "N",
                                    "USE_RATING" => "N",
                                    "USE_REVIEW" => "N",
                                    "USE_RSS" => "N",
                                    "USE_SEARCH" => "N",
                                    "USE_SHARE" => "N",
                                    "COMPONENT_TEMPLATE" => "institut",
                                    "SEF_FOLDER" => "/new/instituty/",
                                    "SEF_URL_TEMPLATES" => [
                                            "news" => "",
                                            "section" => "",
                                            "detail" => "#ELEMENT_CODE#/",
                                    ]
                            ],
                            false
                    ); ?>
                </div>
            </section>

            <? $APPLICATION->IncludeComponent(
                    "bitrix:news",
                    "home_uslugi",
                    array(
                            "ADD_ELEMENT_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "Y",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "BROWSER_TITLE" => "-",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "COMPONENT_TEMPLATE" => "home_uslugi",
                            "COMPOSITE_FRAME_MODE" => "A",
                            "COMPOSITE_FRAME_TYPE" => "AUTO",
                            "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                            "DETAIL_DISPLAY_TOP_PAGER" => "N",
                            "DETAIL_FIELD_CODE" => [0 => "", 1 => "",],
                            "DETAIL_PAGER_SHOW_ALL" => "Y",
                            "DETAIL_PAGER_TEMPLATE" => "",
                            "DETAIL_PAGER_TITLE" => "Страница",
                            "DETAIL_PROPERTY_CODE" => [0 => "", 1 => "",],
                            "DETAIL_SET_CANONICAL_URL" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "79",
                            "IBLOCK_TYPE" => "education",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "LIST_FIELD_CODE" => [0 => "", 1 => "",],
                            "LIST_PROPERTY_CODE" => [0 => "", 1 => "",],
                            "MESSAGE_404" => "",
                            "META_DESCRIPTION" => "-",
                            "META_KEYWORDS" => "-",
                            "NEWS_COUNT" => "20",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "SEF_FOLDER" => "/new/uslugi/",
                            "SEF_MODE" => "Y",
                            "SEF_URL_TEMPLATES" => ["news" => "", "section" => "", "detail" => "#ELEMENT_CODE#/",],
                            "SET_LAST_MODIFIED" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "Y",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N",
                            "USE_CATEGORIES" => "N",
                            "USE_FILTER" => "N",
                            "USE_PERMISSIONS" => "N",
                            "USE_RATING" => "N",
                            "USE_REVIEW" => "N",
                            "USE_RSS" => "N",
                            "USE_SEARCH" => "N",
                            "USE_SHARE" => "N"
                    )
            ); ?>

            <!-- Секция: новости -->
            <section class="home__news">
                <div class="home__container">
                    <div class="news__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="news__slider-wrapper">
                                    <a href="https://ucp.by/university/news/novosti-universiteta/zhenshchina-i-vremya-soyuz-zhenshchin-ugz-i-kommunarki-obedinilis-na-dialogovoy-ploshchadke/"
                                       class="news__slider-img">
                                        <img src="https://ucp.by/upload/iblock/5bb/itg1bhm7qomjf0bffczyomho3tb85rxr.jpg"
                                             alt="Image"
                                             title="Проект к Году белорусской женщины: «Женщины МЧС. Профессия добрых дел»"/>
                                    </a>
                                    <div class="news__slider-action">
                                        <button class="news__slider-button-prev swiper-button-prev">
                                            <iconify-icon icon="lucide:chevron-left" width="24" height="24"
                                                          noobserver></iconify-icon>
                                        </button>
                                        <button class="news__slider-button-next swiper-button-next">
                                            <iconify-icon icon="lucide:chevron-right" width="24" height="24"
                                                          noobserver></iconify-icon>
                                        </button>
                                    </div>
                                </div>
                                <div class="news__slider-content">
                                    <div class="news__slider-info">
                                        <h2 class="title-two">
                                            <a href="https://ucp.by/university/news/novosti-universiteta/zhenshchina-i-vremya-soyuz-zhenshchin-ugz-i-kommunarki-obedinilis-na-dialogovoy-ploshchadke/">
                                                Женщина и время: Союз женщин УГЗ и «Коммунарки» объединились на
                                                диалоговой площадке</a>
                                        </h2>
                                        <p class="text">
                                            лены первичной организации Союза женщин Университета гражданской защиты МЧС
                                            побывали на кондитерской фабрике «Коммунарка», где в рамках диалоговой
                                            площадки «Женщина и время: от идей к действиям» встретились с
                                            представителями первичной организации Белорусского союза женщин предприятия.
                                        </p>
                                        <a href="https://ucp.by/university/news/novosti-universiteta/zhenshchina-i-vremya-soyuz-zhenshchin-ugz-i-kommunarki-obedinilis-na-dialogovoy-ploshchadke/"
                                           class="button-detail">
                                            <span>Подробне</span>
                                            <iconify-icon icon="lucide:chevron-right" width="24" height="24"
                                                          noobserver></iconify-icon>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="news__slider-wrapper">
                                    <a href="https://ucp.by/university/news/novosti-universiteta/rol-zhenshchiny-v-sisteme-bezopasnosti-itogi-otchetno-vybornoy-konferentsii-soyuza-zhenshchin-mchs/"
                                       class="news__slider-img">
                                        <img src="https://ucp.by/upload/iblock/eae/nkxo11eo2iuub9al5ync8cvlemdpno14.JPG"
                                             alt="Image"
                                             title="Проект к Году белорусской женщины: «Женщины МЧС. Профессия добрых дел»"/>
                                    </a>
                                    <div class="news__slider-action">
                                        <button class="news__slider-button-prev swiper-button-prev">
                                            <iconify-icon icon="lucide:chevron-left" width="24" height="24"
                                                          noobserver></iconify-icon>
                                        </button>
                                        <button class="news__slider-button-next swiper-button-next">
                                            <iconify-icon icon="lucide:chevron-right" width="24" height="24"
                                                          noobserver></iconify-icon>
                                        </button>
                                    </div>
                                </div>
                                <div class="news__slider-content">
                                    <div class="news__slider-info">
                                        <h2 class="title-two">
                                            <a href="https://ucp.by/university/news/novosti-universiteta/rol-zhenshchiny-v-sisteme-bezopasnosti-itogi-otchetno-vybornoy-konferentsii-soyuza-zhenshchin-mchs/">
                                                Роль женщины в системе безопасности: итоги отчетно-выборной конференции
                                                Союза женщин МЧС</a>
                                        </h2>
                                        <p class="text">
                                            В Университете гражданской защиты МЧС состоялась III Республиканская
                                            отчетно-выборная конференция Объединенной организации Министерства по
                                            чрезвычайным ситуациям Республики Беларусь ОО «Белорусский союз женщин».
                                            Мероприятие объединило председателей первичных организаций со всей страны,
                                            представителей областных структур и почетных гостей.
                                        </p>
                                        <a href="https://ucp.by/university/news/novosti-universiteta/rol-zhenshchiny-v-sisteme-bezopasnosti-itogi-otchetno-vybornoy-konferentsii-soyuza-zhenshchin-mchs/"
                                           class="button-detail">
                                            <span>Подробне</span>
                                            <iconify-icon icon="lucide:chevron-right" width="24" height="24"
                                                          noobserver></iconify-icon>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="news__recent-content">
                        <a href="#" class="button-all">
                            <span>Все проекты</span>
                            <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
                        </a>
                        <ul class="news__recent">
                            <li class="news__recent-item">
                                <a href="/new/sobytiya/?ELEMENT_ID=29112">
                                    <img src="/dist/img/main/newsRecent1.webp" alt="Image"
                                         title="Электронный журнал UCP LIVE"/>
                                    <p>Электронный журнал UCP LIVE</p>
                                </a>
                            </li>
                            <li class="news__recent-item">
                                <a href="/new/sobytiya/?ELEMENT_ID=29112">
                                    <img src="/dist/img/main/newsRecent2.webp" alt="Image"
                                         title="Жизнь посвященная службе"/>
                                    <p>Жизнь посвященная службе</p>
                                </a>
                            </li>
                            <li class="news__recent-item">
                                <a href="/new/sobytiya/?ELEMENT_ID=29112">
                                    <img src="/dist/img/main/newsRecent3.webp" alt="Image"
                                         title="Инновации в мире науки"/>
                                    <p>Инновации в мире науки</p>
                                </a>
                            </li>
                            <li class="news__recent-item">
                                <a href="/new/sobytiya/?ELEMENT_ID=29112">
                                    <img src="/dist/img/main/newsRecent4.webp" alt="Image"
                                         title="Инновации в мире науки"/>
                                    <p>Инновации в мире науки</p>
                                </a>
                            </li>
                            <li class="news__recent-item">
                                <a href="/new/sobytiya/?ELEMENT_ID=29112">
                                    <img src="/dist/img/main/newsRecent5.webp" alt="Image"
                                         title="Инновации в мире науки"/>
                                    <p>Инновации в мире науки</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>
