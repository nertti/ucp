<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>

<div class="page__content-block">
    <div class="page__banner">
        <?php if (!empty($arResult["IMAGE"])): ?>
            <div class="page__banner-img">
                <img src="<?= $arResult['IMAGE']['SRC']; ?>"
                     alt="<?= $arResult["NAME"]; ?>"
                     title="<?= $arResult["NAME"]; ?>">
            </div>
        <?php endif; ?>
        <div class="page__banner-content">
            <h1 class="title-two"><?= $arResult["NAME"]; ?></h1>
        </div>
    </div>
    <div class="page__info">
        <?php if (!empty($arResult["PROPERTIES"]["CONTENT"]["VALUE"])): ?>
            <div class="page__info-block">
                <? $APPLICATION->IncludeComponent(
                        "sprint.editor:blocks",
                        ".default",
                        array(
                                "ELEMENT_ID" => $arResult["ID"],
                                "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                                "PROPERTY_CODE" => "CONTENT",
                        ),
                        $component,
                        array(
                                "HIDE_ICONS" => "Y"
                        )
                ); ?>
            </div>
        <?php endif; ?>
        <?php if ($arResult['PROPERTIES']['REQUEST']['VALUE_XML_ID'] == 'Y'): ?>
            <button type="button" class="button-blue" data-popup="#popup">
                <span>Зарегистрироваться</span>
                <iconify-icon
                        icon="lucide:chevron-right"
                        width="24"
                        height="24"
                        noobserver
                ></iconify-icon>
            </button>
            <div id="popup" aria-hidden="true" class="popup">
                <div class="popup__wrapper">
                    <div class="popup__content">
                        <button
                                data-close-popup
                                type="button"
                                class="popup__close"
                                aria-label="Закрыть"
                        >
                            <iconify-icon
                                    icon="lucide:x"
                                    width="100%"
                                    height="100%"
                                    noobserver
                            ></iconify-icon>
                        </button>
                        <!-- ========================= -->
                        <!-- ФОРМА -->
                        <!-- ========================= -->
                        <div class="popup__form-content">
                            <div class="popup__form">
                                <h3 class="title-three">
                                    Заявка на услугу "<?= $arResult['NAME'] ?>"
                                </h3>
                                <!-- Ошибка отправки -->
                                <div
                                        class="popup__error"
                                        hidden
                                        role="alert"
                                ></div>
                                <form
                                        action="/ajax/send-course-form.php"
                                        method="POST"
                                        class="course-form"
                                        novalidate
                                >
                                    <!-- Email получателя -->
                                    <input
                                            type="hidden"
                                            name="EMAIL_TO"
                                            value="<?= htmlspecialchars($arResult['PROPERTIES']['EMAIL_TO']['VALUE']) ?>"
                                    >
                                    <input
                                            type="hidden"
                                            name="SERVICE_NAME"
                                            value="Заявка на услугу '<?= $arResult['NAME'] ?>'"
                                    >
                                    <div class="form__line">
                                        <div class="form__content">
                                            <!-- ФИО абитуриента -->
                                            <div class="form__line">
                                                <label for="course-name">
                                                    ФИО <span>*</span>
                                                </label>
                                                <input
                                                        id="course-name"
                                                        name="name"
                                                        type="text"
                                                        class="input"
                                                        placeholder="ФИО"
                                                        autocomplete="name"
                                                        data-error="Обязательно для заполнения"
                                                        required
                                                >
                                            </div>
                                            <!-- Телефон абитуриента -->
                                            <div class="form__line">
                                                <label for="course-phone">
                                                    Телефон (с кодом) <span>*</span>
                                                </label>
                                                <input
                                                        id="course-phone"
                                                        name="phone"
                                                        type="tel"
                                                        class="input phone-mask"
                                                        placeholder="+375 (__) ___ - __ - __"
                                                        autocomplete="tel"
                                                        data-error="Обязательно для заполнения"
                                                        required
                                                >
                                            </div>
                                            <!-- Email абитуриента -->
                                            <div class="form__line">
                                                <label for="course-email">
                                                    E-mail <span>*</span>
                                                </label>
                                                <input
                                                        id="course-email"
                                                        name="email"
                                                        type="email"
                                                        class="input"
                                                        placeholder="Email"
                                                        autocomplete="email"
                                                        data-error="Обязательно для заполнения"
                                                        required
                                                >
                                            </div>
                                            <!-- Почтовый адрес -->
                                            <div class="form__line">
                                                <label for="course-address">
                                                    Почтовый адрес (с индексом)
                                                </label>
                                                <input
                                                        id="course-address"
                                                        name="address"
                                                        type="text"
                                                        class="input"
                                                        placeholder="Почтовый адрес (с индексом)"
                                                        autocomplete="street-address"
                                                >
                                            </div>
                                            <!-- Образование -->
                                            <div class="form__line">
                                                <label>
                                                    Образование <span>*</span>
                                                </label>
                                                <div
                                                        class="form__line-block"
                                                        data-error="Обязательно для заполнения"
                                                >
                                                    <div class="radio-block">
                                                        <label class="radio-label">
                                                            <input
                                                                    type="radio"
                                                                    class="radio"
                                                                    name="enterprise"
                                                                    value="brest_meat"
                                                                    required
                                                            >
                                                            <span class="radio-custom"></span>
                                                        </label>
                                                        <p>
                                                            Среднее специальное
                                                            (техникум, колледж)
                                                        </p>
                                                    </div>
                                                    <div class="radio-block">
                                                        <label class="radio-label">
                                                            <input
                                                                    type="radio"
                                                                    class="radio"
                                                                    name="enterprise"
                                                                    value="brest_traditions"
                                                            >
                                                            <span class="radio-custom"></span>
                                                        </label>
                                                        <p>
                                                            Профессионально-техническое
                                                        </p>
                                                    </div>
                                                    <div class="radio-block">
                                                        <label class="radio-label">
                                                            <input
                                                                    type="radio"
                                                                    class="radio"
                                                                    name="enterprise"
                                                                    value="brest_treats"
                                                            >
                                                            <span class="radio-custom"></span>
                                                        </label>
                                                        <p>
                                                            Среднее
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button
                                            type="submit"
                                            class="button-blue"
                                    >
                                        <span>Направить заявку на обучение</span>
                                        <iconify-icon
                                                icon="lucide:chevron-right"
                                                width="24"
                                                height="24"
                                                noobserver
                                        ></iconify-icon>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- ========================= -->
                        <!-- УСПЕШНАЯ ОТПРАВКА -->
                        <!-- ========================= -->
                        <div
                                class="popup__success-content"
                                hidden
                        >
                            <div class="popup__form">
                                <div class="popup__success">
                                    <div class="popup__success-icon">
                                        <iconify-icon
                                                icon="lucide:circle-check"
                                                width="64"
                                                height="64"
                                                noobserver
                                        ></iconify-icon>
                                    </div>
                                    <h3 class="title-three">
                                        Заявка успешно отправлена!
                                    </h3>
                                    <p class="popup__success-text">
                                        Спасибо за обращение. Ваша заявка на обучение
                                        успешно принята.
                                    </p>
                                    <p class="popup__success-text">
                                        Мы свяжемся с вами в ближайшее время для
                                        уточнения деталей.
                                    </p>
                                    <button
                                            data-close-popup
                                            type="button"
                                            class="button-blue"
                                    >
                                        <span>Закрыть</span>
                                        <iconify-icon
                                                icon="lucide:x"
                                                width="24"
                                                height="24"
                                                noobserver
                                        ></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($arResult['HASHTAGS']): ?>
        <ul class="hashtags">
            <?php foreach ($arResult['HASHTAGS']['TAGS'] as $hashtagTag): ?>
                <li class="hashtags__item">
                    <a
                            class="news-filter-tag"
                            data-tag="<?= htmlspecialcharsbx($hashtagTag['UF_XML_ID']) ?>"
                            data-name="<?= htmlspecialcharsbx($hashtagTag['NAME']) ?>"
                            href="/services/?<?= htmlspecialcharsbx($hashtagTag['LINK']) ?>"
                    >
                        #<?= htmlspecialcharsbx($hashtagTag['NAME']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
