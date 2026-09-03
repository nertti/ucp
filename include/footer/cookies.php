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