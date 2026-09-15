<footer data-fls-footer="" class="footer">
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
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "STRICT_SECTION_CHECK" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
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
            <?php
            $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "bottom",
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
                            "ROOT_MENU_TYPE" => "bottom",
                            "USE_EXT" => "Y"
                    )
            );
            ?>
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
    function initFancybox() {
        const galleryElements = document.querySelectorAll("[data-fancybox='gallery']");

        if (galleryElements.length === 0) {
            console.log(' Элементы [data-fancybox="gallery"] не найдены');
            return;
        }

        //   Fancybox v4/v5
        if (typeof window.Fancybox !== 'undefined' && typeof Fancybox.bind === 'function') {
            // Уничтожаем предыдущий экземпляр (если есть)
            if (window.fancyboxInstance) {
                try {
                    window.fancyboxInstance.destroy();
                } catch (e) {
                }
            }

            window.fancyboxInstance = Fancybox.bind("[data-fancybox='gallery']", {
                groupAll: true,
                Thumbs: {type: "classic"},
                on: {
                    init: (instance) => console.log(' Fancybox v4/v5 инициализирован:', instance),
                    error: (err) => console.error(' Ошибка Fancybox:', err)
                }
            });

            console.log(' Fancybox v4/v5 инициализирован для', galleryElements.length, 'элементов');
            return;
        }

        //   Fancybox v3 (jQuery или без)
        if (typeof window.Fancybox !== 'undefined' && typeof Fancybox.open === 'function') {
            // v3 без jQuery
            galleryElements.forEach(el => {
                el.addEventListener('click', function (e) {
                    e.preventDefault();
                    const src = this.href || this.dataset.src;
                    Fancybox.open([{src: src, type: 'image'}], {
                        loop: true,
                        thumbs: {autoStart: true}
                    });
                });
            });
            console.log(' Fancybox v3 инициализирован для', galleryElements.length, 'элементов');
            return;
        }

        //   Fancybox v3 с jQuery
        if (typeof jQuery !== 'undefined' && jQuery.fn.fancybox) {
            jQuery("[data-fancybox='gallery']").fancybox({
                loop: true,
                thumbs: {autoStart: true}
            });
            console.log(' Fancybox v3 (jQuery) инициализирован');
            return;
        }

        console.warn(' Не удалось определить версию Fancybox или библиотека не загружена');
    }

    // Инициализация после полной загрузки страницы + отложенных скриптов
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFancybox);
    } else {
        // Если DOM уже готов, ждём немного для загрузки скрипта с defer
        setTimeout(initFancybox, 100);
    }
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
<script>
    let bodyLockStatus = true;
    let bodyLockToggle = (delay = 500) => {
        if (document.documentElement.classList.contains("lock")) bodyUnlock(delay); else bodyLock(delay);
    };
    let bodyUnlock = (delay = 500) => {
        if (bodyLockStatus) {
            const lockPaddingElements = document.querySelectorAll("[data-lp]");
            setTimeout(() => {
                lockPaddingElements.forEach(lockPaddingElement => {
                    lockPaddingElement.style.paddingRight = "";
                });
                document.body.style.paddingRight = "";
                document.documentElement.classList.remove("lock");
            }, delay);
            bodyLockStatus = false;
            setTimeout(function () {
                bodyLockStatus = true;
            }, delay);
        }
    };
    let bodyLock = (delay = 500) => {
        if (bodyLockStatus) {
            const lockPaddingElements = document.querySelectorAll("[data-lp]");
            const lockPaddingValue = window.innerWidth - document.body.offsetWidth + "px";
            lockPaddingElements.forEach(lockPaddingElement => {
                lockPaddingElement.style.paddingRight = lockPaddingValue;
            });
            document.body.style.paddingRight = lockPaddingValue;
            document.documentElement.classList.add("lock");
            bodyLockStatus = false;
            setTimeout(function () {
                bodyLockStatus = true;
            }, delay);
        }
    };

    function menuInit() {
        if (document.querySelector(".icon-menu")) document.addEventListener("click", function (e) {
            if (bodyLockStatus && e.target.closest(".icon-menu")) {
                bodyLockToggle();
                document.documentElement.classList.toggle("menu-open");
            }
        });
    }

    menuInit();
</script>
<script src="/local/templates/new_ucp/dist/js/bvi.min.js"></script>
<script>
    new isvek.Bvi();
</script>
</body>
</html>