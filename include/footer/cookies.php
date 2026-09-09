<?php if ($_COOKIE['cookie_consent'] != 'accepted'): ?>
<div class="warning-cookie">
    <div class="warning-cookie__container">
        <div class="warning-cookie__content">
            <div class="warning-cookie__info">
                <p class="text">Сайт использует файлы cookie для обеспечения удобства пользователей сайта, его улучшения, предоставления персонализированных рекомендаций.</p>
                <button type="button" class="warning-cookie__btn" data-popup="#cookie">Подробнее о настройках файлов Cookie</button>
            </div>
            <div class="warning-cookie__action">
                <button type="button" class="button-accept">
                    <span>Принять</span>
                </button>
                <button type="button" class="button-reject">
                    <span>отклонить</span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const cookie = document.querySelector(".warning-cookie");
        const wrapper = document.querySelector(".wrapper");
        const popup = document.querySelector("#cookie");

        if (!cookie || !wrapper) return;

        const acceptBtn = cookie.querySelector(".button-accept");
        const declineBtn = cookie.querySelector(".button-reject");
        const cookieName = "cookie_consent";

        // Получение cookie
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);

            if (parts.length === 2) {
                return parts.pop().split(";").shift();
            }

            return null;
        }

        // Установка cookie
        function setCookie(name, value, seconds) {
            const date = new Date();
            date.setTime(date.getTime() + seconds * 1000);

            document.cookie =
                `${name}=${value}; ` +
                `expires=${date.toUTCString()}; ` +
                `path=/; ` +
                `SameSite=Lax`;
        }

        // Скрытие cookie-блока
        function closeCookie() {
            wrapper.classList.remove("cookie-active");
            cookie.remove();
        }

        // Показываем cookie только если пользователь еще не сделал выбор
        const consent = getCookie(cookieName);

        if (consent) {
            closeCookie();
        } else {
            cookie.classList.remove("hidden");
            wrapper.classList.add("cookie-active");
        }

        // Принять
        if (acceptBtn) {
            acceptBtn.addEventListener("click", () => {
                const oneYearInSeconds = 365 * 24 * 60 * 60;

                setCookie(
                    cookieName,
                    "accepted",
                    oneYearInSeconds
                );

                closeCookie();
            });
        }

        // Отклонить
        if (declineBtn) {
            declineBtn.addEventListener("click", () => {
                const fiveMinutesInSeconds = 5 * 60;

                setCookie(
                    cookieName,
                    "rejected",
                    fiveMinutesInSeconds
                );

                closeCookie();
            });
        }

        // Если открывается popup #cookie — скрываем cookie-баннер
        if (popup) {
            const observer = new MutationObserver(() => {
                if (popup.classList.contains("popup_show")) {
                    cookie.classList.add("hidden");
                } else if (!getCookie(cookieName)) {
                    cookie.classList.remove("hidden");
                }
            });

            observer.observe(popup, {
                attributes: true,
                attributeFilter: ["class"]
            });
        }
    });
</script>
