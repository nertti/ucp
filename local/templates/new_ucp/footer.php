    <footer class="footer">
        <div class="footer__container">
            <div class="footer__top">
                <?php $APPLICATION->IncludeFile(
                        "/include/footer/logo.php",
                        array(),
                        array(
                                "MODE" => "html"
                        )
                ); ?>
                <?php
                $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "slider_partners",
                        [
                                "IBLOCK_ID" => "88",
                                "NEWS_COUNT" => "10",
                                "SORT_BY1" => "SORT",
                                "SORT_ORDER1" => "ASC",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "3600",
                                "COMPONENT_TEMPLATE" => "slider_partners",
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
                <?php
                $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "social_links_footer",
                        [
                                "IBLOCK_ID" => "87",
                                "NEWS_COUNT" => "8",
                                "SORT_BY1" => "SORT",
                                "SORT_ORDER1" => "ASC",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "3600",
                                "COMPONENT_TEMPLATE" => "social_links_footer",
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
            </div>

            <div class="footer__nav">
                <div data-spollers="1024,max" class="spollers">
                    <details class="spollers__item">
                        <summary class="spollers__title"><a href="/university/">Университет</a></summary>
                        <div class="spollers__body">
                            <ul>
                                <li><a href="/university/history/">История</a></li>
                                <li><a href="/university/presentation/">Презентация университета</a></li>
                                <li><a href="/university/licenses/">Лицензии, сертификаты и аттестаты</a></li>
                                <li><a href="/university/quality-management-system/">Система менеджмента качества</a>
                                </li>
                                <li><a href="/university/sistema-upravleniya-okhranoy-truda/">Система управления охраной
                                        труда</a></li>
                                <li><a href="/university/informatsionnye-resursy/">Информационные ресурсы</a></li>
                                <li><a href="/university/numeratsiya-korpusov-i-uchebnykh-auditoriy/">Нумерация корпусов
                                        и учебных аудиторий</a></li>
                                <li><a href="/university/politika-v-otnoshenii-obrabotki-personalnykh-dannykh/">Политика
                                        в отношении обработки персональных данных</a></li>
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
                                <li><a href="/structure/institut-professionalnogo-obrazovaniya/">Институт
                                        профессионального образования</a></li>
                                <li><a href="/structure/institut-perepodgotovki-i-povysheniya-kvalifikatsii/">Институт
                                        переподготовки и повышения квалификации</a></li>
                                <li>
                                    <a href="/structure/nauchno-issledovatelskiy-institut-pozharnoy-bezopasnosti-i-problem-chrezvychaynykh-situatsiy/">Научно
                                        - исследовательский институт пожарной безопасности и проблем чрезвычайных
                                        ситуаций</a></li>
                                <li><a href="/structure/institut-teorii-i-praktiki-bezopasnosti-zhiznedeyatelnosti/">Институт
                                        теории и практики безопасности жизнедеятельности</a></li>
                                <li><a href="/structure/litsey-mchs/">Лицей МЧС</a></li>
                                <li><a href="/structure/otdely/">Отделы и центры</a></li>
                            </ul>
                        </div>
                    </details>
                    <details class="spollers__item">
                        <summary class="spollers__title"><a href="/services/">Услуги</a></summary>
                        <div class="spollers__body">
                            <ul>
                                <li><a href="/services/erip/">ЕРИП</a></li>
                                <li><a href="/services/obrazovatelnye/">Образовательные и просветительские услуги</a>
                                </li>
                                <li><a href="/services/nauchnye/">Наука и инновационная продукция</a></li>
                                <li><a href="/services/provedenie-ispytaniy/">Испытательная деятельность</a></li>
                                <li><a href="/services/ekspertno-konsultatsionnye/">Экспертная деятельность</a></li>
                                <li><a href="/services/organ-po-sertifikatsii-produktsii/">Орган по сертификации
                                        продукции</a></li>
                                <li><a href="/services/poligraficheskie/">Полиграфические и сервисные услуги</a></li>
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
                <ul class="footer__contacts">
                    <li class="footer__contacts-item">
                        <?php $APPLICATION->IncludeFile(
                                "/include/footer/adress.php",
                                array(),
                                array(
                                        "MODE" => "html"
                                )
                        ); ?>
                    </li>
                    <li class="footer__contacts-item">
                        <?php $APPLICATION->IncludeFile(
                                "/include/footer/phone.php",
                                array(),
                                array(
                                        "MODE" => "html"
                                )
                        ); ?>
                    </li>
                    <li class="footer__contacts-item">
                        <?php $APPLICATION->IncludeFile(
                                "/include/footer/fax.php",
                                array(),
                                array(
                                        "MODE" => "html"
                                )
                        ); ?>
                    </li>
                    <li class="footer__contacts-item">
                        <?php $APPLICATION->IncludeFile(
                                "/include/footer/email.php",
                                array(),
                                array(
                                        "MODE" => "html"
                                )
                        ); ?>
                    </li>
                </ul>
            </div>

            <div class="footer__bottom">
                <p class="footer__copyright">
                    <?php $APPLICATION->IncludeFile(
                            "/include/footer/copyright.php",
                            array(),
                            array(
                                    "MODE" => "text"
                            )
                    ); ?>
                </p>
                <div class="footer__developer">
                    <?php $APPLICATION->IncludeFile(
                            "/include/footer/developer.php",
                            array(),
                            array(
                                    "MODE" => "html"
                            )
                    ); ?>
                </div>
            </div>
        </div>
    </footer>
    <button class="up-button" id="upButton">
        <iconify-icon icon="lucide:chevron-up" width="24" height="24" noobserver></iconify-icon>
    </button>
    </div>
    <script>
        Fancybox.defaults.l10n = {
            CLOSE: "Закрыть",
            NEXT: "Следующий",
            PREV: "Предыдущий",
            MODAL: "Вы можете закрыть это окно клавишей ESC",
            ERROR: "Не удалось загрузить контент. <br> Пожалуйста, попробуйте позже.",
            IMAGE_ERROR: "Не удалось загрузить изображение.",
            ELEMENT_NOT_FOUND: "Элемент не найден.",
            AJAX_NOT_FOUND: "Ошибка (404). Не удалось загрузить файл.",
            AJAX_FORBIDDEN: "Ошибка (403). Доступ запрещён.",
            IFRAME_ERROR: "Ошибка загрузки страницы.",
            TOGGLE_ZOOM: "Масштаб",
            TOGGLE_THUMBS: "Миниатюры",
            TOGGLE_SLIDESHOW: "Слайд-шоу",
            TOGGLE_FULLSCREEN: "Полноэкранный режим",
            DOWNLOAD: "Скачать",
            SHARE: "Поделиться",
        };

        Fancybox.defaults.Toolbar = {
            display: {
                left: [],
                middle: ["zoom", "slideshow", "fullscreen", "thumbs"],
                right: ["close"],
            },
            items: {
                zoom: {
                    tpl: `
                    <button class="f-button" title="Масштаб" data-fancybox-zoom>
                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11" cy="11" r="7.5" fill="none" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M8 11h6M11 8v6" stroke="currentColor" stroke-width="1.5"/>
                            <path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                    </button>
                `,
                },
            },
        };

        Fancybox.bind("[data-fancybox^='gallery']", {
            Thumbs: {
                type: "classic",
            },
            Images: {
                zoom: true,
                panzoom: {
                    zoomFactor: 1.5,
                    maxScale: 4,
                },
            },
        });
    </script>

<?php $APPLICATION->IncludeFile(
        "/include/footer/cookies.php",
        array(),
        array(
                "MODE" => "html"
        )
); ?>
<?php $APPLICATION->IncludeFile(
        "/include/footer/translate.php",
        array(),
        array(
                "MODE" => "html"
        )
); ?>
</body>

</html>