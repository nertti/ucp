<style>
    .warning-cookie {
        display: none;
    }
    .warning-cookie {
        position:fixed;
        left:0;
        right:0;
        bottom:20px;
        z-index:320;
        transition:opacity .3s ease,-webkit-transform .3s ease;
        transition:opacity .3s ease,transform .3s ease;
        transition:opacity .3s ease,transform .3s ease,-webkit-transform .3s ease
    }
    .warning-cookie.hidden {
        opacity:0;
        -webkit-transform:translateY(20px);
        transform:translateY(20px);
        pointer-events:none
    }
    .warning-cookie__content {
        padding-block:20px;
        padding-inline:40px;
        display:flex;
        align-items:center;
        gap:60px;
        border-radius:5px;
        background-color:#fff;
        max-width:1205px;
        margin-inline:auto
    }
    .warning-cookie__info {
        display:flex;
        align-items:flex-start;
        flex-direction:column;
        gap:10px
    }
    .warning-cookie__info .text {
        color:#535658;
        font-family:Montserrat,sans-serif;
        font-size:16px;
        font-style:normal;
        font-weight:400;
        line-height:22px;
        text-align:left
    }
    .warning-cookie__btn {
        color:#0d2660;
        font-family:Montserrat-Medium,sans-serif;
        font-size:16px;
        font-style:normal;
        font-weight:500;
        line-height:22px;
        border-bottom:1px solid #0d2660;
        transition:all .3s ease
    }
    .warning-cookie .button-accept,
    .warning-cookie .button-reject {
        display:flex;
        align-items:center;
        justify-content:center;
        padding:12px 50px;
        border-radius:8px;
        transition:all .3s ease
    }
    .warning-cookie .button-accept span,
    .warning-cookie .button-reject span {
        font-family:Montserrat-Medium,sans-serif;
        font-size:16px;
        font-style:normal;
        font-weight:500;
        line-height:22px;
        transition:color .3s ease
    }
    .warning-cookie .button-accept {
        background-color:#0d2660;
        color:#fff
    }
    .warning-cookie .button-reject {
        color:#0d2660;
        background-color:#fff;
        border:1px solid #0d2660
    }
    .warning-cookie__action {
        display:flex;
        gap:20px
    }
    .wrapper.cookie-active::before {
        content:"";
        position:fixed;
        top:0;
        left:0;
        right:0;
        bottom:0;
        background:rgba(17,17,17,.2);
        z-index:310;
        opacity:1;
        visibility:visible;
        transition:opacity .3s ease
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cookieBlock = document.querySelector('.warning-cookie');
        const acceptBtn = document.querySelector('.button-accept');
        const rejectBtn = document.querySelector('.button-reject');
        const cookieName = 'cookie_consent';

        // Функция для получения значения куки по имени
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        // Функция для установки куки (время в секундах)
        function setCookie(name, value, seconds) {
            const date = new Date();
            date.setTime(date.getTime() + (seconds * 1000));
            const expires = `expires=${date.toUTCString()}`;
            document.cookie = `${name}=${value}; ${expires}; path=/; SameSite=Lax`;
        }

        // Проверяем, есть ли уже сохраненный выбор пользователя
        const consent = getCookie(cookieName);

        if (!consent) {
            // Если куки нет, показываем блок (делаем его видимым)
            cookieBlock.style.display = 'block';
        } else {
            // Если кука есть, скрываем блок
            cookieBlock.style.display = 'none';
        }

        // Обработчик кнопки "Принять"
        acceptBtn.addEventListener('click', () => {
            const oneYearInSeconds = 365 * 24 * 60 * 60; // 31,536,000 секунд
            setCookie(cookieName, 'accepted', oneYearInSeconds);
            cookieBlock.style.display = 'none';
        });

        // Обработчик кнопки "Отклонить"
        rejectBtn.addEventListener('click', () => {
            const fiveMinutesInSeconds = 5 * 60; // 300 секунд
            setCookie(cookieName, 'rejected', fiveMinutesInSeconds);
            cookieBlock.style.display = 'none';
        });
    });

</script>
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