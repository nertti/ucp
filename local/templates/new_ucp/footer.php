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
                        <p>Адрес</p>
                        <a href="#">
                            <iconify-icon icon="mdi:map-marker" width="24" height="24" noobserver></iconify-icon>
                            <span>Республика Беларусь, г. Минск, 220118, ул. Машиностроителей, 25</span>
                        </a>
                    </li>
                    <li class="footer__contacts-item">
                        <p>Телефон</p>
                        <a href="tel:+375173403557">
                            <iconify-icon icon="carbon:phone-filled" width="24" height="24" noobserver></iconify-icon>
                            <span>+375 (17) 340-35-57</span>
                        </a>
                    </li>
                    <li class="footer__contacts-item">
                        <p>Факс</p>
                        <a href="tel:+375173403557">
                            <iconify-icon icon="fluent:fax-16-filled" width="24" height="24" noobserver></iconify-icon>
                            <span>+375 (17) 340-35-57</span>
                        </a>
                    </li>
                    <li class="footer__contacts-item">
                        <p>Электронная почта</p>
                        <a href="mailto:mail@ucp.by">
                            <iconify-icon icon="ic:baseline-mail" width="24" height="24" noobserver></iconify-icon>
                            <span>mail@ucp.by</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="footer__bottom">
                <p class="footer__copyright">&copy; Университет гражданской защиты МЧС Беларуси, 2016–2026</p>
                <div class="footer__developer">
                    <p class="footer__developer-text">Разработка и дизайн</p>
                    <a href="https://itg-soft.by/" target="_blank" class="footer__developer-link" rel="nofollow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="30" viewBox="0 0 100 30"
                             fill="none">
                            <rect x="1.875" y="10.625" width="96.25" height="17.5" rx="1.25" fill="white"
                                  fill-opacity="0.1"/>
                            <path d="M57.4142 25.625C56.5928 25.625 55.9549 25.5556 55.5007 25.4168C55.0562 25.2781 54.7469 25.06 54.573 24.7626C54.399 24.4652 54.312 24.0786 54.312 23.6028V21.3129C54.312 20.9957 54.2395 20.7429 54.0946 20.5546C53.9593 20.3662 53.7563 20.2324 53.4857 20.1531C53.2248 20.0639 52.8962 20.0193 52.5 20.0193V18.2796C52.8962 18.2796 53.2248 18.2399 53.4857 18.1606C53.7563 18.0714 53.9593 17.9326 54.0946 17.7443C54.2395 17.546 54.312 17.2932 54.312 16.9859V14.6812C54.312 14.3243 54.3555 14.017 54.4425 13.7593C54.5391 13.5016 54.7034 13.2934 54.9354 13.1348C55.1673 12.9762 55.4814 12.8572 55.8776 12.7779C56.2835 12.6986 56.7957 12.659 57.4142 12.659V14.2946C57.1629 14.2946 56.9455 14.3243 56.7619 14.3838C56.5783 14.4433 56.4333 14.5474 56.327 14.6961C56.2304 14.8349 56.182 15.043 56.182 15.3206V17.4915C56.182 17.9475 56.0419 18.3093 55.7616 18.577C55.4814 18.8446 55.0707 19.0181 54.5295 19.0974V19.1866C55.0707 19.2659 55.4814 19.4394 55.7616 19.707C56.0419 19.9747 56.182 20.3365 56.182 20.7925V22.9634C56.182 23.241 56.2304 23.4491 56.327 23.5879C56.4333 23.7366 56.5783 23.8357 56.7619 23.8853C56.9455 23.9448 57.1629 23.9795 57.4142 23.9894V25.625Z"
                                  fill="white"/>
                            <path d="M62.5086 24.0237C61.6291 24.0237 60.9043 23.8601 60.3341 23.533C59.7736 23.196 59.4402 22.8639 59.3339 22.5368V21.5257H60.972C61.0009 21.6843 61.1604 21.8676 61.4503 22.0758C61.7403 22.284 62.1027 22.3881 62.5375 22.3881C63.2913 22.3881 63.6682 22.1502 63.6682 21.6743C63.6682 21.4464 63.5764 21.2778 63.3928 21.1688C63.2092 21.0597 62.9289 20.9705 62.552 20.9011L61.6243 20.7822C60.165 20.5839 59.4354 19.8355 59.4354 18.5369C59.4354 17.8133 59.706 17.2235 60.2471 16.7675C60.7883 16.3016 61.5131 16.0686 62.4216 16.0686C63.214 16.0686 63.8519 16.2025 64.3351 16.4701C64.8183 16.7377 65.142 17.0797 65.3063 17.4961V18.5072H63.6537C63.6151 18.3486 63.4895 18.1751 63.2768 17.9868C63.0642 17.7984 62.7647 17.7042 62.3781 17.7042C61.7209 17.7042 61.3923 17.9422 61.3923 18.418C61.3923 18.7947 61.7016 19.0375 62.3201 19.1466L63.2479 19.2804C64.8328 19.4985 65.6252 20.232 65.6252 21.481C65.6252 22.2344 65.345 22.849 64.7845 23.3248C64.2336 23.7907 63.475 24.0237 62.5086 24.0237Z"
                                  fill="white"/>
                            <path d="M73.3345 22.8788C72.6387 23.642 71.7012 24.0237 70.5222 24.0237C69.3432 24.0237 68.4009 23.642 67.6955 22.8788C66.9997 22.1155 66.6517 21.1638 66.6517 20.0239C66.6517 18.8938 66.9997 17.9521 67.6955 17.1987C68.4009 16.4453 69.3432 16.0686 70.5222 16.0686C71.7012 16.0686 72.6387 16.4453 73.3345 17.1987C74.04 17.9521 74.3927 18.8938 74.3927 20.0239C74.3927 21.1638 74.04 22.1155 73.3345 22.8788ZM69.2611 21.4959C69.551 21.8825 69.9714 22.0758 70.5222 22.0758C71.0731 22.0758 71.4886 21.8825 71.7689 21.4959C72.0588 21.1093 72.2038 20.6186 72.2038 20.0239C72.2038 19.4489 72.0588 18.9731 71.7689 18.5964C71.479 18.2098 71.0634 18.0165 70.5222 18.0165C69.981 18.0165 69.5655 18.2098 69.2755 18.5964C68.9856 18.9731 68.8407 19.4489 68.8407 20.0239C68.8407 20.6186 68.9808 21.1093 69.2611 21.4959Z"
                                  fill="white"/>
                            <path d="M78.6058 23.8007H76.4168V18.1206H75.1847V16.2917H76.4168V15.459C76.4168 14.5569 76.6778 13.8382 77.1996 13.3029C77.7312 12.7676 78.456 12.5 79.3741 12.5C80.5917 12.5 81.36 12.951 81.679 13.8531V14.8642H80.0554C80.0554 14.7651 80.0022 14.666 79.8959 14.5668C79.7896 14.4578 79.6205 14.4033 79.3886 14.4033C78.8667 14.4033 78.6058 14.7502 78.6058 15.4441V16.2917H80.9397V18.1206H78.6058V23.8007Z"
                                  fill="white"/>
                            <path d="M85.3969 24.0237C84.5078 24.0237 83.812 23.7709 83.3094 23.2654C82.8166 22.7499 82.5701 22.0411 82.5701 21.1391V18.1206H81.4829V16.2917H82.5991L82.7151 14.3884H84.7591V16.2917H87.6583V18.1206H84.7591V21.0647C84.7591 21.7983 85.0297 22.165 85.5709 22.165C85.8221 22.165 86.0009 22.1006 86.1072 21.9717C86.2135 21.8429 86.2667 21.714 86.2667 21.5851H87.8323V22.5962C87.465 23.5479 86.6532 24.0237 85.3969 24.0237Z"
                                  fill="white"/>
                            <path d="M89.4608 23.9894C89.7121 23.9795 89.9295 23.9448 90.1131 23.8853C90.2967 23.8357 90.4369 23.7366 90.5335 23.5879C90.6398 23.4491 90.693 23.241 90.693 22.9634V20.7925C90.693 20.3365 90.8331 19.9747 91.1134 19.707C91.4033 19.4394 91.814 19.2659 92.3455 19.1866V19.0974C91.814 19.0181 91.4033 18.8446 91.1134 18.577C90.8331 18.3093 90.693 17.9475 90.693 17.4915V15.3206C90.693 15.043 90.6398 14.8349 90.5335 14.6961C90.4369 14.5474 90.2967 14.4433 90.1131 14.3838C89.9295 14.3243 89.7121 14.2946 89.4608 14.2946V12.659C90.0793 12.659 90.5867 12.6986 90.9829 12.7779C91.3888 12.8572 91.7077 12.9762 91.9396 13.1348C92.1716 13.2934 92.331 13.5016 92.418 13.7593C92.5147 14.017 92.563 14.3243 92.563 14.6812V16.9859C92.563 17.2932 92.6306 17.546 92.7659 17.7443C92.9109 17.9326 93.1187 18.0714 93.3893 18.1606C93.6599 18.2399 93.9884 18.2796 94.375 18.2796V20.0193C93.9884 20.0193 93.6599 20.0639 93.3893 20.1531C93.1187 20.2324 92.9109 20.3662 92.7659 20.5546C92.6306 20.7429 92.563 20.9957 92.563 21.3129V23.6028C92.563 24.0786 92.476 24.4652 92.302 24.7626C92.1281 25.06 91.8188 25.2781 91.3743 25.4168C90.9297 25.5556 90.2919 25.625 89.4608 25.625V23.9894Z"
                                  fill="white"/>
                            <path d="M10.6041 25.1683H5.625V2.33173H10.6041V25.1683Z" fill="white"/>
                            <path d="M23.6639 25.1683H18.6848V6.625H12.2659V2.33173H30.1128V6.625H23.6639V25.1683Z"
                                  fill="white"/>
                            <path d="M41.4215 25.625C37.8421 25.625 35.0126 24.5288 32.933 22.3365C30.8534 20.1442 29.8136 17.2821 29.8136 13.75C29.8136 10.2788 30.8534 7.43697 32.933 5.22436C35.0326 2.99145 37.8222 1.875 41.3015 1.875C43.8411 1.875 45.8607 2.38248 47.3605 3.39744C48.8602 4.41239 49.7001 5.46795 49.88 6.5641V8.84776H45.9807C45.7807 8.25908 45.3008 7.67041 44.541 7.08173C43.7811 6.47276 42.7113 6.16827 41.3315 6.16827C39.3119 6.16827 37.7122 6.87874 36.5324 8.29968C35.3726 9.70032 34.7927 11.5069 34.7927 13.7196C34.7927 15.9322 35.3926 17.7489 36.5924 19.1699C37.7922 20.5908 39.4219 21.3013 41.4815 21.3013C42.8613 21.3013 44.151 21.0475 45.3508 20.5401V16.5817H40.7016V12.6843H50V22.5497C49.5601 23.2195 48.5503 23.8996 46.9705 24.5897C45.4108 25.2799 43.5611 25.625 41.4215 25.625Z"
                                  fill="white"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <button class="up-button" id="upButton">
        <iconify-icon icon="lucide:chevron-up" width="24" height="24" noobserver></iconify-icon>
    </button>
    </div>
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/app.js"></script>
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