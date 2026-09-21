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
                                <div class="popup__error"
                                     hidden
                                     role="alert"></div>
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
                                            <?php
                                            $formFields = $arResult['PROPERTIES']['FORM_FIELDS']['VALUE_XML_ID'] ?? [];

                                            if (!is_array($formFields)) {
                                                $formFields = [$formFields];
                                            }

                                            foreach ($formFields as $formField):
                                                ?>
                                                <input
                                                        type="hidden"
                                                        name="FORM_FIELDS[]"
                                                        value="<?= htmlspecialchars($formField) ?>"
                                                >
                                            <?php endforeach; ?>
                                            <?php

                                            $formFields = $arResult['PROPERTIES']['FORM_FIELDS']['VALUE_XML_ID'] ?? [];

                                            if (!is_array($formFields)) {
                                                $formFields = [$formFields];
                                            }

                                            $hasField = static function (string $xmlId) use ($formFields): bool {
                                                return in_array($xmlId, $formFields, true);
                                            };
                                            ?>

                                            <?php if ($hasField('NAME')): ?>
                                                <!-- ФИО -->
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
                                            <?php endif; ?>

                                            <?php if ($hasField('PHONE')): ?>
                                                <!-- Телефон -->
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
                                            <?php endif; ?>

                                            <?php if ($hasField('EMAIL')): ?>
                                                <!-- Email -->
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
                                            <?php endif; ?>

                                            <?php if ($hasField('ADDRESS')): ?>
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
                                            <?php endif; ?>

                                            <?php if ($hasField('ORGANIZATION')): ?>
                                                <!-- Орган или организация -->
                                                <div class="form__line">
                                                    <label for="course-name">
                                                        Орган или организация
                                                    </label>
                                                    <input
                                                            id="course-name"
                                                            name="organization"
                                                            type="text"
                                                            class="input"
                                                            placeholder="Орган или организация"
                                                    >
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($hasField('ORGANIZATION_ADDRESS')): ?>
                                                <div class="form__line">
                                                    <label for="course-name">
                                                        Адрес расположения организации (область, город, район (если
                                                        организация находится вне города), населенный пункт)
                                                    </label>
                                                    <input
                                                            id="course-name"
                                                            name="organization_address"
                                                            type="text"
                                                            class="input"
                                                            placeholder="Адрес"
                                                    >
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($hasField('ENTERPRISE')): ?>
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
                                                                        value="Высшее"
                                                                        required
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Высшее
                                                            </p>
                                                        </div>
                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="enterprise"
                                                                        value="Среднее специальное"
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
                                                                        value="Профессионально-техническое"
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
                                                                        value="Среднее"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Среднее
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($hasField('POSITION')): ?>
                                                <!-- Должность -->
                                                <div class="form__line">
                                                    <label for="course-name">
                                                        Должность
                                                    </label>
                                                    <input
                                                            id="course-name"
                                                            name="position"
                                                            type="text"
                                                            class="input"
                                                            placeholder="Должность"
                                                    >
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($hasField('CATEGORY')): ?>
                                                <!-- Выберите категорию слушателя по программе которой будете обучаться -->
                                                <div class="form__line">
                                                    <label>
                                                        Категория <span>*</span>
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
                                                                        name="form_dropdown_category"
                                                                        value="Руководящий состав органов управления ГСЧСиГО (руководители организаций)"
                                                                        required
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Руководящий состав органов управления ГСЧСиГО
                                                                (руководители организаций)
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Руководящий состав органов управления ГСЧСиГО (работники ГСЧСиГО)"
                                                                        required
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Руководящий состав органов управления ГСЧСиГО
                                                                (работники ГСЧСиГО)
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Руководители и зам. руководителей учр. дошк., общ. среднего, проф.-тех. и средн. спец. обр-я"
                                                                        required
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Руководители и зам. руководителей учр. дошк., общ.
                                                                среднего, проф.-тех. и средн. спец. обр-я
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Руководители и заместители руководителей учреждений (организаций) СНЛК местного уровня"
                                                                        required
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Руководители и заместители руководителей учреждений
                                                                (организаций) СНЛК местного уровня
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Руководители структурных подразделений организаций, входящих в состав СНЛК"
                                                                        required
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Руководители структурных подразделений организаций,
                                                                входящих в состав СНЛК
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры санитарных формирований"
                                                                        required
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры санитарных формирований
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры пожарных дружин"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры пожарных дружин
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры спасательных формирований"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры спасательных формирований
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры звеньев по обслуживанию защитных сооружений гражданской обороны"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры звеньев по обслуживанию защитных сооружений
                                                                гражданской обороны
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры звеньев специальной обработки"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры звеньев специальной обработки
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры звеньев связи"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры звеньев связи
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры звеньев подвоза воды"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры звеньев подвоза воды
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры погрузочных звеньев"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры погрузочных звеньев
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Начальники пунктов выдачи средств индивидуальной защиты"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Начальники пунктов выдачи средств индивидуальной защиты
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Начальники группы приема и размещения временно отселяемого населения"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Начальники группы приема и размещения временно
                                                                отселяемого населения
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Начальники подвижных пунктов продовольственного снабжения"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Начальники подвижных пунктов продовольственного снабжения
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Начальники подвижных пунктов питания"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Начальники подвижных пунктов питания
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Начальники подвижных пунктов вещевого снабжения"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Начальники подвижных пунктов вещевого снабжения
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры разведывательных звеньев химической (радиационной) разведки"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры разведывательных звеньев химической
                                                                (радиационной) разведки
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры разведывательных звеньев инженерной разведки"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры разведывательных звеньев инженерной разведки
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры разведывательных звеньев эпидемиологической разведки"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры разведывательных звеньев эпидемиологической
                                                                разведки
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры разведывательных звеньев ветеринарной разведки"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры разведывательных звеньев ветеринарной разведки
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры разведывательных звеньев фитопатологической разведки"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры разведывательных звеньев фитопатологической
                                                                разведки
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры разведывательных звеньев железнодорожной разведки"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры разведывательных звеньев железнодорожной разведки
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры разведывательных звеньев речной разведки"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры разведывательных звеньев речной разведки
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры дорожно-мостовых групп"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры дорожно-мостовых групп
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры подвижных автозаправочных групп"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры подвижных автозаправочных групп
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры групп механизации работ"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры групп механизации работ
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры аварийно-технических звеньев"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры аварийно-технических звеньев
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры аварийно-технических звеньев по водопроводным сетям"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры аварийно-технических звеньев по водопроводным
                                                                сетям
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры аварийно-технических звеньев по канализационным сетям"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры аварийно-технических звеньев по канализационным
                                                                сетям
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры аварийно-технических звеньев по тепловым сетям"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры аварийно-технических звеньев по тепловым сетям
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры аварийно-технических звеньев по электросетям"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры аварийно-технических звеньев по электросетям
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры аварийно-технических звеньев по газовым сетям"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры аварийно-технических звеньев по газовым сетям
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры лесопожарных формирований бригад пункта противопожарного инвентаря (ППИ)"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры лесопожарных формирований бригад пункта
                                                                противопожарного инвентаря (ППИ)
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры лесопожарных формир. команд пожарно-химических станций первого типа (ПХС-1)"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры лесопожарных формир. команд
                                                                пожарно-химических станций первого типа (ПХС-1)
                                                            </p>
                                                        </div>

                                                        <div class="radio-block">
                                                            <label class="radio-label">
                                                                <input
                                                                        type="radio"
                                                                        class="radio"
                                                                        name="form_dropdown_category"
                                                                        value="Командиры лесопожарных формир. команд пожарно-химических станций второго типа (ПХС-2)"
                                                                >
                                                                <span class="radio-custom"></span>
                                                            </label>
                                                            <p>
                                                                Командиры лесопожарных формир. команд
                                                                пожарно-химических станций второго типа (ПХС-2)
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

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
