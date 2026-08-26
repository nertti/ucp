<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

$arPhotos = array();
if (!empty($arResult["PROPERTIES"]["PHOTO"]["VALUE"]) && is_array($arResult["PROPERTIES"]["PHOTO"]["VALUE"])) {
    foreach ($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as $fileId) {
        $file = CFile::GetFileArray($fileId);
        if ($file) {
            $arPhotos[] = $file;
        }
    }
}
?>

<main class="page universities">
    <section class="preview universities__preview">
        <div class="preview-slider swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
            <div class="swiper-wrapper">
                <?php if (!empty($arPhotos)): ?>
                    <?php foreach ($arPhotos as $photo): ?>
                        <div class="swiper-slide">
                            <div class="preview-slider-img-two">
                                <img src="<?php echo $photo["SRC"]; ?>" alt="Image" title="<?php echo $arResult["NAME"]; ?>">
                            </div>
                            <div class="preview__info">
                                <div class="preview__container">
                                    <h1 class="title-one" data-da=".title-mobile,950, 1">
                                        <?php echo $arResult["NAME"]; ?>
                                    </h1>
                                    <nav class="breadcrumbs" data-da=".breadcrumbs-mobile,950, 1">
                                        <ul class="breadcrumbs__list">
                                            <li class="breadcrumbs__item">
                                                <a href="index.html" class="breadcrumbs__link">Главная</a>
                                            </li>
                                            <li class="breadcrumbs__item">
                                                <a href="#" class="breadcrumbs__link"><?php echo $arResult["NAME"]; ?></a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="swiper-slide swiper-slide-active">
                        <div class="preview-slider-img-two">
                            <img src="<?php echo $arResult["DETAIL_PICTURE"]["SRC"]; ?>" alt="Image" title="<?php echo $arResult["NAME"]; ?>">
                        </div>
                        <div class="preview__info">
                            <div class="preview__container">
                                <h1 class="title-one" data-da=".title-mobile,950, 1">
                                    <?php echo $arResult["NAME"]; ?>
                                </h1>
                                <nav class="breadcrumbs" data-da=".breadcrumbs-mobile,950, 1">
                                    <ul class="breadcrumbs__list">
                                        <li class="breadcrumbs__item">
                                            <a href="index.html" class="breadcrumbs__link">Главная</a>
                                        </li>
                                        <li class="breadcrumbs__item">
                                            <a href="#" class="breadcrumbs__link"><?php echo $arResult["NAME"]; ?></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="preview-slider-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"></div>
        </div>
    </section>
    <div class="universities__container">
        <nav class="page__sidebar">
            <div class="page__sidebar-content _event">
                <ul class="page__sidebar-event" data-da=".event-mobile,950, 1">
                    <li class="page__sidebar-event-item"><a href="#">Руководство</a></li>
                    <li class="page__sidebar-event-item"><a href="#">Об институте</a></li>
                    <li class="page__sidebar-event-item">
                        <a href="#">Научно-исследовательские центры и отделы</a>
                    </li>
                    <li class="page__sidebar-event-item"><a href="#">Услуги</a></li>
                    <li class="page__sidebar-event-item">
                        <a href="#">Орган по сертификации продукции</a>
                    </li>
                    <li class="page__sidebar-event-item"><a href="#">Разработки института</a></li>
                    <li class="page__sidebar-event-item">
                        <a href="#">ТНПА и НПА</a>
                    </li>
                    <li class="page__sidebar-event-item">
                        <a href="#">Технический комитет ТК BY 35</a>
                    </li>
                    <li class="page__sidebar-event-item"><a href="#">Контактная информация</a></li>
                </ul>
            </div>
            <ul class="page__banners">
                <li class="page__banners-item">
                    <a href="cart.html">
                        <img src="/local/templates/new_ucp/assets/img/main/servicesBanner1.webp" alt="Image" title="Баннер 1">
                    </a>
                </li>
                <li class="page__banners-item">
                    <img src="/local/templates/new_ucp/assets/img/main/servicesBanner2.webp" alt="Image" title="Баннер 2">
                </li>
                <li class="page__banners-item">
                    <a href="cart.html">
                        <img src="/local/templates/new_ucp/assets/img/main/servicesBanner3.webp" alt="Image" title="Баннер 3">
                    </a>
                </li>
                <li class="page__banners-item">
                    <a href="cart.html">
                        <img src="/local/templates/new_ucp/assets/img/main/servicesBanner4.webp" alt="Image" title="Баннер 4">
                    </a>
                </li>
                <li class="page__banners-item">
                    <a href="cart.html">
                        <img src="/local/templates/new_ucp/assets/img/main/servicesBanner5.webp" alt="Image" title="Баннер 5">
                    </a>
                </li>
            </ul>
        </nav>
        <div class="page__content">
            <div class="title-block">
                <h2 class="title-two">Новости</h2>
                <a href="/news/" class="button-all">
                    <span>Все новости</span>
                    <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
                </a>
            </div>
            
            <?$APPLICATION->IncludeComponent(
                "bitrix:news", 
                "newsinstitut", 
                [
                    "COMPONENT_TEMPLATE" => ".default",
                    "IBLOCK_TYPE" => "news",
                    "IBLOCK_ID" => "2",
                    "NEWS_COUNT" => "5",
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
            );?>

            <?$APPLICATION->IncludeComponent(
                "bitrix:news", 
                "v", 
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
                    "IBLOCK_ID" => "81",
                    "IBLOCK_TYPE" => "education",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "LIST_FIELD_CODE" => [
                        0 => "",
                        1 => "",
                    ],
                    "LIST_PROPERTY_CODE" => [
                        0 => "ST",
                        1 => "TEG",
                        2 => "favorites",
                        3 => "POPULAR",
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
                    "COMPONENT_TEMPLATE" => "v",
                    "VARIABLE_ALIASES" => [
                        "SECTION_ID" => "SECTION_ID",
                        "ELEMENT_ID" => "ELEMENT_ID",
                    ]
                ],
                false
            );?>

            <?$APPLICATION->IncludeComponent(
                "bitrix:news", 
                "institutuslugi", 
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
                    "IBLOCK_ID" => "79",
                    "IBLOCK_TYPE" => "education",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "LIST_FIELD_CODE" => [
                        0 => "",
                        1 => "",
                    ],
                    "LIST_PROPERTY_CODE" => [
                        0 => "ST",
                        1 => "TEG",
                        2 => "favorites",
                        3 => "POPULAR",
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
                    "COMPONENT_TEMPLATE" => "institutuslugi",
                    "VARIABLE_ALIASES" => [
                        "SECTION_ID" => "SECTION_ID",
                        "ELEMENT_ID" => "ELEMENT_ID",
                    ]
                ],
                false
            );?>
        </div>
    </div>
</main>