<style>
    /* Скрываем верхнюю панель Google Translate */
    .goog-te-banner-frame,
    .skiptranslate,
    #goog-gt-tt,
    .goog-te-balloon-frame {
        display: none !important;
    }

    body {
        top: 0 !important;
    }

    .goog-text-highlight {
        background: transparent !important;
        box-shadow: none !important;
    }
</style>

<script>
    const googleTranslateConfig = {
        lang: "ru",
    };

    let googleTranslateLoaded = false;
    let googleTranslateLoading = false;

    /**
     * Инициализация Google Translate
     */
    function TranslateInit() {
        googleTranslateLoaded = true;
        googleTranslateLoading = false;

        const code = TranslateGetCode();

        // Показываем все языки
        const langOptions = document.querySelectorAll(
            '.header__lang-dropdown .header__lang-option'
        );

        langOptions.forEach(option => {
            option.style.display = '';
            option.classList.remove(
                'language__img_active',
                'active'
            );
        });

        // Скрываем текущий язык
        const activeOption = document.querySelector(
            `[data-google-lang="${code}"]`
        );

        if (activeOption) {
            activeOption.style.display = 'none';
        }

        // Текущий язык
        const currentLangBtn = document.querySelector(
            '.header__lang-current'
        );

        if (currentLangBtn) {
            currentLangBtn.textContent = code.toUpperCase();
        }

        // Инициализация Google Translate
        new google.translate.TranslateElement({
            pageLanguage: googleTranslateConfig.lang,
        });

        // Обработчики языков
        langOptions.forEach(option => {
            // Чтобы обработчик не добавлялся несколько раз
            if (option.dataset.translateInitialized) {
                return;
            }

            option.dataset.translateInitialized = 'true';

            option.addEventListener('click', function (e) {
                e.preventDefault();

                const selectedLang = this.getAttribute(
                    'data-google-lang'
                );

                TranslateSetCookie(selectedLang);

                window.location.reload();
            });
        });
    }


    /**
     * Загружает Google Translate только при необходимости
     */
    function loadGoogleTranslate() {
        // Уже загружен
        if (googleTranslateLoaded) {
            return;
        }

        // Уже идёт загрузка
        if (googleTranslateLoading) {
            return;
        }

        googleTranslateLoading = true;

        // callback Google
        window.TranslateInit = TranslateInit;

        const script = document.createElement('script');

        script.src =
            'https://translate.google.com/translate_a/element.js?cb=TranslateInit';

        script.async = true;

        script.onerror = function () {
            googleTranslateLoading = false;

            console.warn(
                'Google Translate недоступен'
            );
        };

        document.head.appendChild(script);
    }


    /**
     * Чтение cookie
     */
    function getCookie(name) {
        const matches = document.cookie.match(
            new RegExp(
                "(?:^|; )" +
                name.replace(
                    /([\.$?*|{}\(\)\[\]\\\/\+^])/g,
                    '\\$1'
                ) +
                "=([^;]*)"
            )
        );

        return matches
            ? decodeURIComponent(matches[1])
            : undefined;
    }


    /**
     * Получение текущего языка
     */
    function TranslateGetCode() {
        const googtrans = getCookie('googtrans');

        if (
            !googtrans ||
            googtrans === "null" ||
            googtrans === `/${googleTranslateConfig.lang}/${googleTranslateConfig.lang}` ||
            googtrans === `/auto/${googleTranslateConfig.lang}`
        ) {
            return googleTranslateConfig.lang;
        }

        return googtrans
            .substring(googtrans.lastIndexOf('/') + 1)
            .toLowerCase();
    }


    /**
     * Установка cookie Google Translate
     */
    function TranslateSetCookie(code) {
        const value = "/auto/" + code;
        const domain = window.location.hostname;
        const baseDomain = domain
            .split('.')
            .slice(-2)
            .join('.');

        sessionStorage.removeItem('googtrans');
        localStorage.removeItem('googtrans');

        document.cookie =
            `googtrans=${value}; path=/;`;

        document.cookie =
            `googtrans=${value}; path=/; domain=${domain};`;

        document.cookie =
            `googtrans=${value}; path=/; domain=.${domain};`;

        if (baseDomain !== domain) {
            document.cookie =
                `googtrans=${value}; path=/; domain=.${baseDomain};`;

            document.cookie =
                `googtrans=${value}; path=/; domain=${baseDomain};`;
        }
    }
</script>