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
   <title><?$APPLICATION->ShowTitle()?></title>
	<?$APPLICATION->ShowHead();?>
    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/assets/img/icons/favicon.svg" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/css/style.css');
    ?>
    <?php //выгрузить ?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css?_v=20260818155058" />
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js?_v=20260818155058"></script>
	<script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js?_v=20260818155058"></script>
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
        <header class="header">
            <div class="header__container">
                <?php $APPLICATION->IncludeFile(
                        "/include/header/logo.php",
                        array(),
                        array(
                                "MODE" => "html"
                        )
                ); ?>
                <nav class="header__nav">
                    <!-- Меню обернуть в компонент -->
                    <ul class="menu">
                        <li class="menu__item menu__item--has-dropdown">
                            <a href="/university/" class="menu__link">
                                <span>Университет</span>
                                <span class="menu__arrow">
                                    <iconify-icon icon="lucide:chevron-down" width="100%" height="100%" noobserver></iconify-icon>
                                </span>
                            </a>
                            <div class="menu__dropdown">
                                <ul class="menu__dropdown-list">
                                    <li class="menu__dropdown-item"><a href="/university/history/" class="menu__dropdown-link">История</a></li>
                                    <li class="menu__dropdown-item"><a href="/university/presentation/" class="menu__dropdown-link">Презентация университета</a></li>
                                    <li class="menu__dropdown-item"><a href="/university/licenses/" class="menu__dropdown-link">Лицензии, сертификаты и аттестаты</a></li>
                                    <li class="menu__dropdown-item"><a href="/university/quality-management-system/" class="menu__dropdown-link">Система менеджмента качества</a></li>
                                    <li class="menu__dropdown-item"><a href="/university/sistema-upravleniya-okhranoy-truda/" class="menu__dropdown-link">Система управления охраной труда</a></li>
                                    <li class="menu__dropdown-item"><a href="/university/informatsionnye-resursy/" class="menu__dropdown-link">Информационные ресурсы</a></li>
                                    <li class="menu__dropdown-item"><a href="/university/numeratsiya-korpusov-i-uchebnykh-auditoriy/" class="menu__dropdown-link">Нумерация корпусов и учебных аудиторий</a></li>
                                    <li class="menu__dropdown-item"><a href="/university/politika-v-otnoshenii-obrabotki-personalnykh-dannykh/" class="menu__dropdown-link">Политика в отношении обработки персональных данных</a></li>
                                    <li class="menu__dropdown-item"><a href="/university/vakansii/" class="menu__dropdown-link">Вакансии</a></li>
                                    <li class="menu__dropdown-item"><a href="/university/notification" class="menu__dropdown-link">Объявления</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu__item menu__item--has-dropdown">
                            <a href="/structure/" class="menu__link">
                                <span>Структура</span>
                                <span class="menu__arrow">
                                    <iconify-icon icon="lucide:chevron-down" width="100%" height="100%" noobserver></iconify-icon>
                                </span>
                            </a>
                            <div class="menu__dropdown">
                                <ul class="menu__dropdown-list">
                                    <li class="menu__dropdown-item"><a href="/structure/leaders/" class="menu__dropdown-link">Руководство</a></li>
                                    <li class="menu__dropdown-item"><a href="/structure/faculties/" class="menu__dropdown-link">Факультеты</a></li>
                                    <li class="menu__dropdown-item"><a href="/structure/institut-professionalnogo-obrazovaniya/" class="menu__dropdown-link">Институт профессионального образования</a></li>
                                    <li class="menu__dropdown-item"><a href="/structure/institut-perepodgotovki-i-povysheniya-kvalifikatsii/" class="menu__dropdown-link">Институт переподготовки и повышения квалификации</a></li>
                                    <li class="menu__dropdown-item"><a href="/structure/nauchno-issledovatelskiy-institut-pozharnoy-bezopasnosti-i-problem-chrezvychaynykh-situatsiy/" class="menu__dropdown-link">Научно - исследовательский институт пожарной безопасности и проблем чрезвычайных ситуаций</a></li>
                                    <li class="menu__dropdown-item"><a href="/structure/institut-teorii-i-praktiki-bezopasnosti-zhiznedeyatelnosti/" class="menu__dropdown-link">Институт теории и практики безопасности жизнедеятельности</a></li>
                                    <li class="menu__dropdown-item"><a href="/structure/litsey-mchs/" class="menu__dropdown-link">Лицей МЧС</a></li>
                                    <li class="menu__dropdown-item"><a href="/structure/otdely/" class="menu__dropdown-link">Отделы и центры</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu__item menu__item--has-dropdown">
                            <a href="/activity/" class="menu__link">
                                <span>Деятельность</span>
                                <span class="menu__arrow">
                                    <iconify-icon icon="lucide:chevron-down" width="100%" height="100%" noobserver></iconify-icon>
                                </span>
                            </a>
                            <div class="menu__dropdown">
                                <ul class="menu__dropdown-list">
                                    <li class="menu__dropdown-item"><a href="/activity/obrazovatelnaya/" class="menu__dropdown-link">Образовательная и просветительская</a></li>
                                    <li class="menu__dropdown-item"><a href="/activity/nauchnaya/" class="menu__dropdown-link">Научная и инновационная</a></li>
                                    <li class="menu__dropdown-item"><a href="/activity/formirovanie-kultury-bezopasnosti-zhiznedeyatelnosti/" class="menu__dropdown-link">Формирование культуры безопасности жизнедеятельности</a></li>
                                    <li class="menu__dropdown-item"><a href="/activity/ideologicheskaya/" class="menu__dropdown-link">Идеологическая</a></li>
                                    <li class="menu__dropdown-item"><a href="/activity/mezhdunarodnaya/" class="menu__dropdown-link">Международная</a></li>
                                    <li class="menu__dropdown-item"><a href="/activity/izdatelskaya/" class="menu__dropdown-link">Издательская</a></li>
                                    <li class="menu__dropdown-item"><a href="/activity/sportivnaya/" class="menu__dropdown-link">Спортивная</a></li>
                                    <li class="menu__dropdown-item"><a href="/activity/tekhnicheskiy-komitet-tk-by-35/" class="menu__dropdown-link">Технический комитет ТК ВУ 35</a></li>
                                    <li class="menu__dropdown-item"><a href="/activity/tnpa-i-npa/" class="menu__dropdown-link">ТНПА и НПА</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu__item menu__item--has-dropdown">
                            <a href="/services/" class="menu__link">
                                <span>Услуги</span>
                                <span class="menu__arrow">
                                    <iconify-icon icon="lucide:chevron-down" width="100%" height="100%" noobserver></iconify-icon>
                                </span>
                            </a>
                            <div class="menu__dropdown">
                                <ul class="menu__dropdown-list">
                                    <li class="menu__dropdown-item"><a href="/services/erip/" class="menu__dropdown-link">ЕРИП</a></li>
                                    <li class="menu__dropdown-item"><a href="/services/obrazovatelnye/" class="menu__dropdown-link">Образовательные и просветительские услуги</a></li>
                                    <li class="menu__dropdown-item"><a href="/services/nauchnye/" class="menu__dropdown-link">Наука и инновационная продукция</a></li>
                                    <li class="menu__dropdown-item"><a href="/services/provedenie-ispytaniy/" class="menu__dropdown-link">Испытательная деятельность</a></li>
                                    <li class="menu__dropdown-item"><a href="/services/ekspertno-konsultatsionnye/" class="menu__dropdown-link">Экспертная деятельность</a></li>
                                    <li class="menu__dropdown-item"><a href="/services/organ-po-sertifikatsii-produktsii/" class="menu__dropdown-link">Орган по сертификации продукции</a></li>
                                    <li class="menu__dropdown-item"><a href="/services/poligraficheskie/" class="menu__dropdown-link">Полиграфические и сервисные услуги</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu__item menu__item--has-dropdown">
                            <a href="/abiturientu/" class="menu__link">
                                <span>Абитуриенту</span>
                                <span class="menu__arrow">
                                    <iconify-icon icon="lucide:chevron-down" width="100%" height="100%" noobserver></iconify-icon>
                                </span>
                            </a>
                            <div class="menu__dropdown">
                                <ul class="menu__dropdown-list">
                                    <li class="menu__dropdown-item"><a href="/abiturientu/priemnaya-kampaniya/" class="menu__dropdown-link">Приемная кампания</a></li>
                                    <li class="menu__dropdown-item"><a href="/abiturientu/obshchee-vysshee-obrazovanie-bakalavriat/" class="menu__dropdown-link">Общее высшее образование (бакалавриат)</a></li>
                                    <li class="menu__dropdown-item"><a href="/abiturientu/uglublennoe-vysshee-obrazovanie-magistratura/" class="menu__dropdown-link">Углубленное высшее образование (магистратура)</a></li>
                                    <li class="menu__dropdown-item"><a href="/abiturientu/adyunktura/" class="menu__dropdown-link">Адъюнктура</a></li>
                                    <li class="menu__dropdown-item"><a href="/abiturientu/dopolnitelnoe-obrazovanie-vzroslykh" class="menu__dropdown-link">Переподготовка руководящих работников и специалистов, имеющих высшее образование</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu__item">
                            <a href="/contacts/" class="menu__link">
                                <span>Контакты</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="header__search" data-da=".header__search-mobile,1200, 1">
                    <!-- Поиск обернуть в компонент -->
                    <div class="header__search-input">
                        <button class="header__search-btn header__search-btn--search">
                            <div class="header__search-btn-icon">
                                <iconify-icon icon="lucide:search" width="100%" height="100%" noobserver></iconify-icon>
                            </div>
                        </button>
                        <input type="text" placeholder="Поиск" />
                        <button class="header__search-btn header__search-btn--clear">
                            <div class="header__search-btn-icon">
                                <iconify-icon icon="lucide:x" width="100%" height="100%" noobserver></iconify-icon>
                            </div>
                        </button>
                    </div>
                    <div class="header__search-content">
                        <ul class="header__search-list">
                            <li class="header__search-item">
                                <p class="text-caption">Факультет предупреждения и ликвидации ЧС</p>
                            </li>
                            <li class="header__search-item">
                                <p class="text-caption">Факультет техносферной безопасности</p>
                            </li>
                            <li class="header__search-item">
                                <p class="text-caption">Факультет заочного обучения</p>
                            </li>
                            <li class="header__search-item">
                                <p class="text-caption">Факультет безопасности жизнедеятельности</p>
                            </li>
                            <li class="header__search-item">
                                <p class="text-caption">Факультет предупреждения и ликвидации ЧС</p>
                            </li>
                            <li class="header__search-item">
                                <p class="text-caption">Факультет техносферной безопасности</p>
                            </li>
                            <li class="header__search-item">
                                <p class="text-caption">Факультет заочного обучения</p>
                            </li>
                            <li class="header__search-item">
                                <p class="text-caption">Факультет безопасности жизнедеятельности</p>
                            </li>
                            <li class="header__search-item">
                                <p class="text-caption">Факультет предупреждения и ликвидации ЧС</p>
                            </li>
                            <li class="header__search-item">
                                <p class="text-caption">Факультет техносферной безопасности</p>
                            </li>
                            <li class="header__search-item">
                                <p class="text-caption">Факультет заочного обучения</p>
                            </li>
                            <li class="header__search-item">
                                <p class="text-caption">Факультет безопасности жизнедеятельности</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="header__accessibility" data-da=".header__accessibility-mobile,1200, 1">
                    <div class="socials__item">
                        <a href="?special_version=Y">
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
                <div class="spollers" data-spollers>
                    <details class="spollers__item">
                        <summary class="spollers__title"><a href="/university/">Университет</a></summary>
                        <div class="spollers__body">
                            <ul>
                                <li><a href="/university/history/">История</a></li>
                                <li><a href="/university/presentation/">Презентация университета</a></li>
                                <li><a href="/university/licenses/">Лицензии, сертификаты и аттестаты</a></li>
                                <li><a href="/university/quality-management-system/">Система менеджмента качества</a></li>
                                <li><a href="/university/sistema-upravleniya-okhranoy-truda/">Система управления охраной труда</a></li>
                                <li><a href="/university/informatsionnye-resursy/">Информационные ресурсы</a></li>
                                <li><a href="/university/numeratsiya-korpusov-i-uchebnykh-auditoriy/">Нумерация корпусов и учебных аудиторий</a></li>
                                <li><a href="/university/politika-v-otnoshenii-obrabotki-personalnykh-dannykh/">Политика в отношении обработки персональных данных</a></li>
                                <li><a href="/university/vakansii/">Вакансии</a></li>
                                <li><a href="/university/notification">Объявления</a></li>
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

