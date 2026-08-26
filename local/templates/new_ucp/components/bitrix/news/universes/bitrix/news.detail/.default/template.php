<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
?>
<section class="preview universities__preview">
    <!-- слайдер университета главный -->
    <div class="preview-slider swiper">
        <div class="swiper-wrapper">
            <?php foreach ($arResult['PROPERTIES']['BANNER']['VALUE'] as $idImage):
                $urlImage = CFile::GetPath($idImage);
                ?>
                <div class="swiper-slide">
                    <div class="preview-slider-img-two">
                        <img src="<?=$urlImage?>" alt="Image" title="Превью"/>
                    </div>
                    <div class="preview__info">
                        <div class="preview__container">
                            <h1 class="title-one" data-da=".title-mobile,950, 1">
                                <?=$arResult['NAME']?>
                            </h1>
                            <nav class="breadcrumbs" data-da=".breadcrumbs-mobile,950, 1">
                                <ul class="breadcrumbs__list">
                                    <li class="breadcrumbs__item">
                                        <a href="/" class="breadcrumbs__link">Главная</a>
                                    </li>
                                    <li class="breadcrumbs__item">
                                        <a href="#" class="breadcrumbs__link"><?=$arResult['NAME']?></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <div class="preview-slider-pagination"></div>
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
                    <img src="img/main/servicesBanner1.webp" alt="Image" title="Баннер 1"/>
                </a>
            </li>
            <li class="page__banners-item">
                <img src="img/main/servicesBanner2.webp" alt="Image" title="Баннер 2"/>
            </li>
            <li class="page__banners-item">
                <a href="cart.html">
                    <img src="img/main/servicesBanner3.webp" alt="Image" title="Баннер 3"/>
                </a>
            </li>
            <li class="page__banners-item">
                <a href="cart.html">
                    <img src="img/main/servicesBanner4.webp" alt="Image" title="Баннер 4"/>
                </a>
            </li>
            <li class="page__banners-item">
                <a href="cart.html">
                    <img src="img/main/servicesBanner5.webp" alt="Image" title="Баннер 5"/>
                </a>
            </li>
        </ul>
    </nav>
    <div class="page__content">
        <div class="universities__info-mobile">
            <div class="title-mobile"></div>
            <div class="breadcrumbs-mobile"></div>
            <div class="event-mobile"></div>
        </div>
        <div class="title-block">
            <h2 class="title-two">Новости</h2>
            <a href="/news/?univercity=<?=$arResult['CODE']?>" class="button-all">
                <span>Все новости</span>
                <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
            </a>
        </div>
        <div class="universities__content">
            <?php if(!empty($arResult['PROPERTIES']['NEWS']['VALUE'])):?>
            <section class="universities__news-main">
                <div class="home__feed-news">
                    <?php
                    $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "university_news",
                            [
                                    "IBLOCK_ID" => "2",
                                    "NEWS_COUNT" => "5",
                                    "SORT_BY1" => "SORT",
                                    "SORT_ORDER1" => "ASC",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "3600",
                                    "COMPONENT_TEMPLATE" => "university_news",
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
                                    "PARENT_SECTION" => $arResult['PROPERTIES']['NEWS']['VALUE'],
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
                            false,
                            [
                                    "HIDE_ICONS" => "Y"
                            ]
                    );
                    ?>
                </div>
            </section>
            <?php endif;?>
            <?php $APPLICATION->IncludeComponent(
                    "sprint.editor:blocks",
                    "slider",
                    array(
                            "ELEMENT_ID" => $arResult["ID"],
                            "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                            "PROPERTY_CODE" => 'SLIDER',
                    ),
                    $component,
            ); ?>

            <section class="page__services">
                <div class="title-block">
                    <h2 class="title-two">
                        <a href="">Услуги</a>
                    </h2>
                    <a href="#" class="button-all">
                        <span>Все услуги</span>
                        <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
                    </a>
                </div>
                <ul class="services__main-list">
                    <li class="services__main-list-item">
                        <a href="#">
                            <div class="services__main-list-header">
                                <div class="icon">
                                    <iconify-icon icon="streamline-plump:graduation-cap" width="100%" height="100%"
                                                  noobserver></iconify-icon>
                                </div>
                            </div>
                            <div class="services__main-list-content">
                                <h3>Обучение руководящего состава по программе «Защита от ЧС»</h3>
                                <p>
                                    Обязательное обучение директоров предприятий и уполномоченных лиц в
                                    области гражданской обороны, защиты населения и организации
                                    первичных звеньев....
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="services__main-list-item">
                        <a href="#">
                            <div class="services__main-list-header">
                                <div class="icon">
                                    <iconify-icon icon="lucide:atom" width="100%" height="100%"
                                                  noobserver></iconify-icon>
                                </div>
                                <div class="label">Популярная услуга</div>
                            </div>
                            <div class="services__main-list-content">
                                <h3>Разработка инновационных решений для промышленной безопасности</h3>
                                <p>
                                    Проведение научных исследований, разработка методик и технологий,
                                    направленных на повышение уровня безопасности и эффективности
                                    производственных процессов.
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="services__main-list-item">
                        <a href="#">
                            <div class="services__main-list-header">
                                <div class="icon">
                                    <iconify-icon icon="famicons:flask-outline" width="100%" height="100%"
                                                  noobserver></iconify-icon>
                                </div>
                            </div>
                            <div class="services__main-list-content">
                                <h3>Испытания продукции на соответствие требованиям безопасности</h3>
                                <p>
                                    Комплексные лабораторные испытания материалов,
                                    оборудования и изделий с выдачей официальных протоколов испытаний.
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="services__main-list-item">
                        <a href="#">
                            <div class="services__main-list-header">
                                <div class="icon">
                                    <iconify-icon icon="solar:clipboard-check-linear" width="100%" height="100%"
                                                  noobserver></iconify-icon>
                                </div>
                                <div class="label">Рекомендуем</div>
                            </div>
                            <div class="services__main-list-content">
                                <h3>Экспертная оценка промышленной и пожарной безопасности</h3>
                                <p>
                                    Проведение независимой экспертной оценки объектов, документации и
                                    технических решений в соответствии с действующими нормативными
                                    требованиями.
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</div>
<?php
//echo '<pre>';
//print_r($arResult);
//echo '</pre>';
//?>
