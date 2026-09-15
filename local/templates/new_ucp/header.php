<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><!doctype html>

<?php
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Loader;

/** @var \CMain $APPLICATION */
/** @var \CMain $USER */

$isMainPage = $APPLICATION->GetCurPage(false) === '/';
?>
<html lang="ru">
<head>
   <title><?php $APPLICATION->ShowTitle()?></title>
	<?php $APPLICATION->ShowHead();?>
    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/assets/img/icons/favicon.svg" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/dist/css/app.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/dist/css/bvi.min.css', true, ['defer' => 'defer']);
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/dist/css/fancybox.min.css', true, ['defer' => 'defer']);

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/dist/js/fancybox.min.js', true, ['defer' => 'defer']);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/dist/js/iconify-icon.min.js', true, ['defer' => 'defer']);
    ?>

    <script type="module" crossorigin="" src="/local/templates/new_ucp/dist/js/app9.min.js"></script>
</head>

<body>

<?php $APPLICATION->IncludeFile(
        "/include/header/preloader.php",
        array(),
        array(
                "MODE" => "html"
        )
); ?>

	<div id="panel"><?php $APPLICATION->ShowPanel();?></div>
    <div class="wrapper">
        <header class="header" data-fls-header="">
            <div class="header__container">
                <?php $APPLICATION->IncludeFile(
                        "/include/header/logo.php",
                        array(),
                        array(
                                "MODE" => "html"
                        )
                ); ?>
                <nav class="header__nav">
                    <?php
                    $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "top",
                            Array(
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "CHILD_MENU_TYPE" => "left",
                                    "COMPOSITE_FRAME_MODE" => "A",
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                                    "DELAY" => "N",
                                    "MAX_LEVEL" => "2",
                                    "MENU_CACHE_GET_VARS" => array(""),
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "Y",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "ROOT_MENU_TYPE" => "top",
                                    "USE_EXT" => "Y"
                            )
                    );
                    ?>
                </nav>
                <?php $APPLICATION->IncludeFile(
                        "/include/header/search.php",
                        array(),
                        array(
                                "MODE" => "html"
                        )
                ); ?>
                <div class="header__accessibility" data-fls-dynamic=".header__accessibility-mobile,1200, 1">
                    <div class="socials__item">
                        <a href="#" class="bvi-open">
                            <iconify-icon icon="mdi:eye" width="20.4" height="20.4" noobserver></iconify-icon>
                        </a>
                    </div>
                    <div class="header__lang">
                        <div class="header__lang-pill">
                            <button class="header__lang-btn" type="button">
                                <span class="header__lang-current">RU</span>
                            </button>

                            <div class="header__lang-dropdown">
                                <a href="#" class="header__lang-option language__img" data-lang="ru" data-google-lang="ru">RU</a>
                                <a href="#" class="header__lang-option language__img" data-lang="en" data-google-lang="en">EN</a>
                                <a href="#" class="header__lang-option language__img" data-lang="be" data-google-lang="be">BE</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "social_links_header",
                        [
                                "IBLOCK_ID" => "87",
                                "NEWS_COUNT" => "8",
                                "SORT_BY1" => "SORT",
                                "SORT_ORDER1" => "ASC",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "3600",
                                "COMPONENT_TEMPLATE" => "social_links_header",
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
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
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
                <div class="header__mobile-action">
                    <div class="header__search-mobile"></div>
                    <button type="button" class="header__search-btn-mobile">
                        <iconify-icon icon="lucide:search" width="18" height="18" noobserver></iconify-icon>
                    </button>
                    <div class="icon-menu-block">
                        <button type="button" class="menu__icon icon-menu"><span></span></button>
                    </div>
                </div>
            </div>
        </header>

        <div class="mobile-search">
            <div class="mobile-search__container">
                <div class="mobile-search__input-wrapper">
                    <button class="mobile-search__btn mobile-search__btn--search">
                        <iconify-icon icon="lucide:search" width="20" height="20" noobserver></iconify-icon>
                    </button>
                    <input type="text" class="mobile-search__input" placeholder="Поиск" />
                    <button class="mobile-search__btn mobile-search__btn--clear">
                        <iconify-icon icon="lucide:x" width="20" height="20" noobserver></iconify-icon>
                    </button>
                </div>
                <div class="mobile-search__content">
                    <ul class="mobile-search__list">
                        <li class="mobile-search__item">
                            <p class="text-caption">Факультет предупреждения и ликвидации ЧС</p>
                        </li>
                        <li class="mobile-search__item">
                            <p class="text-caption">Факультет техносферной безопасности</p>
                        </li>
                        <li class="mobile-search__item">
                            <p class="text-caption">Факультет заочного обучения</p>
                        </li>
                        <li class="mobile-search__item">
                            <p class="text-caption">Факультет безопасности жизнедеятельности</p>
                        </li>
                        <li class="mobile-search__item">
                            <p class="text-caption">Факультет предупреждения и ликвидации ЧС</p>
                        </li>
                        <li class="mobile-search__item">
                            <p class="text-caption">Факультет техносферной безопасности</p>
                        </li>
                        <li class="mobile-search__item">
                            <p class="text-caption">Факультет заочного обучения</p>
                        </li>
                        <li class="mobile-search__item">
                            <p class="text-caption">Факультет безопасности жизнедеятельности</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="header-mobile">
            <div class="header__container">
                <div class="spollers" data-fls-spollers="">
                    <details class="spollers__item">
                        <summary class="spollers__title"><a href="/university/">Университет</a></summary>
                        <div class="spollers__body">
                            <ul>
                                <li><a href="/university/history/">История</a></li>
                                <li><a href="/university/presentation/">Презентация университета</a></li>
                                <li><a href="/university/licenses/">Лицензии, сертификаты и аттестаты</a></li>
                                <li><a href="/university/quality-management-system/">Система менеджмента качества</a></li>
                                <li><a href="/university/sistema-upravleniya-okhranoy-truda/">Система управления охраной труда</a></li>
                                <li><a href="/university/informatsionnye-resursy/">Информационно-образовательная платформа/</a></li>
                                <li><a href="/university/numeratsiya-korpusov-i-uchebnykh-auditoriy/">Нумерация корпусов и учебных аудиторий</a></li>
                                <li><a href="/university/politika-v-otnoshenii-obrabotki-personalnykh-dannykh/">Политика в отношении обработки персональных данных</a></li>
                                <li><a href="/university/vakansii/">Вакансии</a></li>
                                <li><a href="/events/">События</a></li>
                            </ul>
                        </div>
                    </details>
                    <details class="spollers__item">
                        <summary class="spollers__title"><a href="/structure/">Структура</a></summary>
                        <div class="spollers__body">
                            <ul>
                                <li><a href="/structure/leaders/">Руководство</a></li>
                                <li><a href="/structure/faculties/">Факультеты</a></li>
                                <li><a href="/structure/institut-professionalnogo-obrazovaniya/">Институт профессионального образования</a></li>
                                <li><a href="/structure/institut-perepodgotovki-i-povysheniya-kvalifikatsii/">Институт переподготовки и повышения квалификации</a></li>
                                <li><a href="/structure/nauchno-issledovatelskiy-institut-pozharnoy-bezopasnosti-i-problem-chrezvychaynykh-situatsiy/">Научно - исследовательский институт пожарной безопасности и проблем чрезвычайных ситуаций</a></li>
                                <li><a href="/structure/institut-teorii-i-praktiki-bezopasnosti-zhiznedeyatelnosti/">Институт теории и практики безопасности жизнедеятельности</a></li>
                                <li><a href="/structure/litsey-mchs/">Лицей МЧС</a></li>
                                <li><a href="/structure/otdely/">Отделы и центры</a></li>
                            </ul>
                        </div>
                    </details>
                    <details class="spollers__item">
                        <summary class="spollers__title"><a href="/activity/">Деятельность</a></summary>
                        <div class="spollers__body">
                            <ul>
                                <li><a href="/activity/obrazovatelnaya/">Образовательная и просветительская</a></li>
                                <li><a href="/activity/nauchnaya/">Научная и инновационная</a></li>
                                <li><a href="/activity/formirovanie-kultury-bezopasnosti-zhiznedeyatelnosti/">Формирование культуры безопасности жизнедеятельности</a></li>
                                <li><a href="/activity/ideologicheskaya/">Идеологическая</a></li>
                                <li><a href="/activity/mezhdunarodnaya/">Международная</a></li>
                                <li><a href="/activity/izdatelskaya/">Издательская</a></li>
                                <li><a href="/activity/sportivnaya/">Спортивная</a></li>
                                <li><a href="/activity/tekhnicheskiy-komitet-tk-by-35/">Технический комитет ТК ВУ 35</a></li>
                                <li><a href="/activity/tnpa-i-npa/">ТНПА и НПА</a></li>
                            </ul>
                        </div>
                    </details>
                    <details class="spollers__item">
                        <summary class="spollers__title"><a href="/services/">Услуги</a></summary>
                        <div class="spollers__body">
                            <ul>
                                <li><a href="/services/erip/">ЕРИП</a></li>
                                <li><a href="/services/obrazovatelnye/">Образовательные и просветительские услуги</a></li>
                                <li><a href="/services/nauchnye/">Наука и инновационная продукция</a></li>
                                <li><a href="/services/provedenie-ispytaniy/">Испытательная деятельность</a></li>
                                <li><a href="/services/ekspertno-konsultatsionnye/">Экспертная деятельность</a></li>
                                <li><a href="/services/organ-po-sertifikatsii-produktsii/">Орган по сертификации продукции</a></li>
                                <li><a href="/services/poligraficheskie/">Полиграфические и сервисные услуги</a></li>
                            </ul>
                        </div>
                    </details>
                    <details class="spollers__item">
                        <summary class="spollers__title"><a href="/abiturientu/">Абитуриенту</a></summary>
                        <div class="spollers__body">
                            <ul>
                                <li><a href="/abiturientu/priemnaya-kampaniya/">Приемная кампания</a></li>
                                <li><a href="/abiturientu/obshchee-vysshee-obrazovanie-bakalavriat/">Общее высшее образование (бакалавриат)</a></li>
                                <li><a href="/abiturientu/uglublennoe-vysshee-obrazovanie-magistratura/">Углубленное высшее образование (магистратура)</a></li>
                                <li><a href="/abiturientu/adyunktura/">Адъюнктура</a></li>
                                <li><a href="/abiturientu/dopolnitelnoe-obrazovanie-vzroslykh">Переподготовка руководящих работников и специалистов, имеющих высшее образование</a></li>
                            </ul>
                        </div>
                    </details>
                    <details class="spollers__item">
                        <summary class="spollers__title"><a href="/contacts/">Контакты</a></summary>
                        <div class="spollers__body">
                            <ul>
                                <li><a href="/contacts/kontakty/">Контактная информация</a></li>
                                <li><a href="/contacts/administrativnye-procedury/">Административные процедуры</a></li>
                                <li><a href="/contacts/priem/">Прием граждан</a></li>
                                <li><a href="/contacts/telefon-doveriya/">Телефон доверия</a></li>
                                <li><a href="/electronic-forms/">Обращения граждан</a></li>
                            </ul>
                        </div>
                    </details>
                </div>
                <div class="socials-mobile"></div>
                <div class="header__accessibility-mobile"></div>
            </div>
        </div>