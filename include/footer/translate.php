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
        lang: "ru", // Язык оригинала сайта
    };

    function TranslateInit() {
        let code = TranslateGetCode();

        // 2. Находим выбранный язык, подсвечиваем его и скрываем из списка
        const activeOption = document.querySelector(`[data-google-lang="${code}"]`);
        if (activeOption) {
            activeOption.remove();
        }

        // 1. Показываем все языки и убираем старые классы активности
        const langOptions = document.querySelectorAll('.header__lang-dropdown .header__lang-option');
        langOptions.forEach(option => {
            option.style.display = '';
            option.classList.remove('language__img_active', 'active');
        });

        // 3. Синхронизируем текст на главной кнопке (RU или EN)
        const currentLangBtn = document.querySelector('.header__lang-current');
        if (currentLangBtn) {
            currentLangBtn.textContent = code.toUpperCase();
        }

        // Инициализация виджета Google Translate
        new google.translate.TranslateElement({
            pageLanguage: googleTranslateConfig.lang,
        });

        // 4. Логика клика по языкам
        langOptions.forEach(option => {
            option.addEventListener('click', function (e) {
                e.preventDefault();
                let selectedLang = this.getAttribute("data-google-lang");

                // Вместо удаления куки, мы всегда ЗАПИСЫВАЕМ её.
                // Для RU запишется /auto/ru, что сбросит перевод у Google.
                TranslateSetCookie(selectedLang);

                window.location.reload();
            });
        });
    }

    // Чтение куки на чистом JS
    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches) : undefined;
    }

    function TranslateGetCode() {
        let googtrans = getCookie('googtrans');
        // Если куки нет или она указывает на дефолтный язык (ru), возвращаем "ru"
        if (!googtrans || googtrans === "null" || googtrans === `/${googleTranslateConfig.lang}/${googleTranslateConfig.lang}` || googtrans === `/auto/${googleTranslateConfig.lang}`) {
            return googleTranslateConfig.lang;
        }
        return lang = googtrans.substring(googtrans.lastIndexOf('/') + 1).toLowerCase();
    }

    // Универсальная и жесткая запись куки для всех уровней домена
    function TranslateSetCookie(code) {
        const value = "/auto/" + code;
        const domain = window.location.hostname;
        const baseDomain = domain.split('.').slice(-2).join('.'); // Выделяет site.com из ://site.com

        // Очищаем кэш сессий браузера
        sessionStorage.removeItem('googtrans');
        localStorage.removeItem('googtrans');

        // Перезаписываем куки на всех возможных путях и доменах
        document.cookie = `googtrans=${value}; path=/;`;
        document.cookie = `googtrans=${value}; path=/; domain=${domain};`;
        document.cookie = `googtrans=${value}; path=/; domain=.${domain};`;

        if (baseDomain !== domain) {
            document.cookie = `googtrans=${value}; path=/; domain=.${baseDomain};`;
            document.cookie = `googtrans=${value}; path=/; domain=${baseDomain};`;
        }
    }
</script>

<!-- Скрипт Google, который автоматически вызовет функцию TranslateInit -->
<script src="//translate.google.com/translate_a/element.js?cb=TranslateInit"></script>
