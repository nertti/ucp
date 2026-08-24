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

<main class="page">
    <div class="page__container">
        <nav class="page__sidebar">
            <div class="page__sidebar-content" data-da=".page__sidebar-content-mobile,950, 1">
                <div class="page__sidebar-search-content">
                    <p>Быстрый поиск</p>
                    <div class="page__sidebar-search">
                        <div class="page__sidebar-search-input">
                            <button class="page__sidebar-search-btn page__sidebar-search-btn--search">
                                <div class="page__sidebar-search-btn-icon">
                                    <iconify-icon icon="lucide:search" width="100%" height="100%" noobserver></iconify-icon>
                                </div>
                            </button>
                            <input type="text" placeholder="Введите запрос...">
                            <button class="page__sidebar-search-btn page__sidebar-search-btn--clear">
                                <div class="page__sidebar-search-btn-icon">
                                    <iconify-icon icon="lucide:x" width="100%" height="100%" noobserver></iconify-icon>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="hashtags-header-mobile"></div>
                <div data-spollers class="spollers _spoller-init">
                    <details class="spollers__item" data-open open>
                        <summary class="spollers__title _spoller-active">Образовательные и просветительские услуги</summary>
                        <div class="spollers__body">
                            <ul>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu1_1">
                                        <span>Общее высшее образование (бакалавриат)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu1_2">
                                        <span>Углубленное высшее образование (магистратура)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu1_3">
                                        <span>Научно-ориентированное образование</span>
                                    </a>
                                </li>
                                <li>
                                    <div data-spollers class="spollers _spoller-init">
                                        <details class="spollers__item">
                                            <summary class="spollers__title">
                                                <a href="#">
                                                    <input type="checkbox" id="edu1_parent" class="spollers__parent-checkbox">
                                                    <span>Университет (все направления)</span>
                                                </a>
                                            </summary>
                                            <div class="spollers__body" hidden>
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu1_11" class="spollers__child-checkbox" data-parent="edu1_parent">
                                                            <span>Общее высшее образование (бакалавриат)</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu1_12" class="spollers__child-checkbox" data-parent="edu1_parent">
                                                            <span>Углубленное высшее образование (магистратура)</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu1_13" class="spollers__child-checkbox" data-parent="edu1_parent">
                                                            <span>Научно-ориентированное образование</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu1_14" class="spollers__child-checkbox" data-parent="edu1_parent">
                                                            <span>Подготовка к проверке знаний</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu1_15" class="spollers__child-checkbox" data-parent="edu1_parent">
                                                            <span>Центр безопасности</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu1_16" class="spollers__child-checkbox" data-parent="edu1_parent">
                                                            <span>Музей МЧС</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </details>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu1_4">
                                        <span>Подготовка к проверке знаний</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu1_5">
                                        <span>Центр безопасности</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu1_6">
                                        <span>Музей МЧС</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </details>
                    <details class="spollers__item">
                        <summary class="spollers__title">Наука и инновационная продукция</summary>
                        <div class="spollers__body" hidden>
                            <ul>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu2_1">
                                        <span>Общее высшее образование (бакалавриат)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu2_2">
                                        <span>Углубленное высшее образование (магистратура)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu2_3">
                                        <span>Научно-ориентированное образование</span>
                                    </a>
                                </li>
                                <li>
                                    <div data-spollers class="spollers _spoller-init">
                                        <details class="spollers__item">
                                            <summary class="spollers__title">
                                                <a href="#">
                                                    <input type="checkbox" id="edu2_parent" class="spollers__parent-checkbox">
                                                    <span>Университет (все направления)</span>
                                                </a>
                                            </summary>
                                            <div class="spollers__body" hidden>
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu2_11" class="spollers__child-checkbox" data-parent="edu2_parent">
                                                            <span>Общее высшее образование (бакалавриат)</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu2_12" class="spollers__child-checkbox" data-parent="edu2_parent">
                                                            <span>Углубленное высшее образование (магистратура)</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu2_13" class="spollers__child-checkbox" data-parent="edu2_parent">
                                                            <span>Научно-ориентированное образование</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu2_14" class="spollers__child-checkbox" data-parent="edu2_parent">
                                                            <span>Подготовка к проверке знаний</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu2_15" class="spollers__child-checkbox" data-parent="edu2_parent">
                                                            <span>Центр безопасности</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu2_16" class="spollers__child-checkbox" data-parent="edu2_parent">
                                                            <span>Музей МЧС</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </details>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu2_4">
                                        <span>Подготовка к проверке знаний</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu2_5">
                                        <span>Центр безопасности</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu2_6">
                                        <span>Музей МЧС</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </details>
                    <details class="spollers__item">
                        <summary class="spollers__title">Испытательная деятельность</summary>
                        <div class="spollers__body" hidden>
                            <ul>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu3_1">
                                        <span>Общее высшее образование (бакалавриат)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu3_2">
                                        <span>Углубленное высшее образование (магистратура)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu3_3">
                                        <span>Научно-ориентированное образование</span>
                                    </a>
                                </li>
                                <li>
                                    <div data-spollers class="spollers _spoller-init">
                                        <details class="spollers__item">
                                            <summary class="spollers__title">
                                                <a href="#">
                                                    <input type="checkbox" id="edu3_parent" class="spollers__parent-checkbox">
                                                    <span>Университет (все направления)</span>
                                                </a>
                                            </summary>
                                            <div class="spollers__body" hidden>
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu3_11" class="spollers__child-checkbox" data-parent="edu3_parent">
                                                            <span>Общее высшее образование (бакалавриат)</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu3_12" class="spollers__child-checkbox" data-parent="edu3_parent">
                                                            <span>Углубленное высшее образование (магистратура)</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu3_13" class="spollers__child-checkbox" data-parent="edu3_parent">
                                                            <span>Научно-ориентированное образование</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu3_14" class="spollers__child-checkbox" data-parent="edu3_parent">
                                                            <span>Подготовка к проверке знаний</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu3_15" class="spollers__child-checkbox" data-parent="edu3_parent">
                                                            <span>Центр безопасности</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu3_16" class="spollers__child-checkbox" data-parent="edu3_parent">
                                                            <span>Музей МЧС</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </details>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu3_4">
                                        <span>Подготовка к проверке знаний</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu3_5">
                                        <span>Центр безопасности</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu3_6">
                                        <span>Музей МЧС</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </details>
                    <details class="spollers__item">
                        <summary class="spollers__title">Орган по сертификации продукции</summary>
                        <div class="spollers__body" hidden>
                            <ul>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu4_1">
                                        <span>Общее высшее образование (бакалавриат)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu4_2">
                                        <span>Углубленное высшее образование (магистратура)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu4_3">
                                        <span>Научно-ориентированное образование</span>
                                    </a>
                                </li>
                                <li>
                                    <div data-spollers class="spollers _spoller-init">
                                        <details class="spollers__item">
                                            <summary class="spollers__title">
                                                <a href="#">
                                                    <input type="checkbox" id="edu4_parent" class="spollers__parent-checkbox">
                                                    <span>Университет (все направления)</span>
                                                </a>
                                            </summary>
                                            <div class="spollers__body" hidden>
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu4_11" class="spollers__child-checkbox" data-parent="edu4_parent">
                                                            <span>Общее высшее образование (бакалавриат)</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu4_12" class="spollers__child-checkbox" data-parent="edu4_parent">
                                                            <span>Углубленное высшее образование (магистратура)</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu4_13" class="spollers__child-checkbox" data-parent="edu4_parent">
                                                            <span>Научно-ориентированное образование</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu4_14" class="spollers__child-checkbox" data-parent="edu4_parent">
                                                            <span>Подготовка к проверке знаний</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu4_15" class="spollers__child-checkbox" data-parent="edu4_parent">
                                                            <span>Центр безопасности</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu4_16" class="spollers__child-checkbox" data-parent="edu4_parent">
                                                            <span>Музей МЧС</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </details>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu4_4">
                                        <span>Подготовка к проверке знаний</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu4_5">
                                        <span>Центр безопасности</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu4_6">
                                        <span>Музей МЧС</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </details>
                    <details class="spollers__item">
                        <summary class="spollers__title">Полиграфические и сервисные услуги</summary>
                        <div class="spollers__body" hidden>
                            <ul>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu5_1">
                                        <span>Общее высшее образование (бакалавриат)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu5_2">
                                        <span>Углубленное высшее образование (магистратура)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu5_3">
                                        <span>Научно-ориентированное образование</span>
                                    </a>
                                </li>
                                <li>
                                    <div data-spollers class="spollers _spoller-init">
                                        <details class="spollers__item">
                                            <summary class="spollers__title">
                                                <a href="#">
                                                    <input type="checkbox" id="edu5_parent" class="spollers__parent-checkbox">
                                                    <span>Университет (все направления)</span>
                                                </a>
                                            </summary>
                                            <div class="spollers__body" hidden>
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu5_11" class="spollers__child-checkbox" data-parent="edu5_parent">
                                                            <span>Общее высшее образование (бакалавриат)</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu5_12" class="spollers__child-checkbox" data-parent="edu5_parent">
                                                            <span>Углубленное высшее образование (магистратура)</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu5_13" class="spollers__child-checkbox" data-parent="edu5_parent">
                                                            <span>Научно-ориентированное образование</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu5_14" class="spollers__child-checkbox" data-parent="edu5_parent">
                                                            <span>Подготовка к проверке знаний</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu5_15" class="spollers__child-checkbox" data-parent="edu5_parent">
                                                            <span>Центр безопасности</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu5_16" class="spollers__child-checkbox" data-parent="edu5_parent">
                                                            <span>Музей МЧС</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </details>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu5_4">
                                        <span>Подготовка к проверке знаний</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu5_5">
                                        <span>Центр безопасности</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu5_6">
                                        <span>Музей МЧС</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </details>
                    <details class="spollers__item">
                        <summary class="spollers__title">Молния</summary>
                        <div class="spollers__body" hidden>
                            <ul>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu6_1">
                                        <span>Общее высшее образование (бакалавриат)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu6_2">
                                        <span>Углубленное высшее образование (магистратура)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu6_3">
                                        <span>Научно-ориентированное образование</span>
                                    </a>
                                </li>
                                <li>
                                    <div data-spollers class="spollers _spoller-init">
                                        <details class="spollers__item">
                                            <summary class="spollers__title">
                                                <a href="#">
                                                    <input type="checkbox" id="edu6_parent" class="spollers__parent-checkbox">
                                                    <span>Университет (все направления)</span>
                                                </a>
                                            </summary>
                                            <div class="spollers__body" hidden>
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu6_11" class="spollers__child-checkbox" data-parent="edu6_parent">
                                                            <span>Общее высшее образование (бакалавриат)</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu6_12" class="spollers__child-checkbox" data-parent="edu6_parent">
                                                            <span>Углубленное высшее образование (магистратура)</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu6_13" class="spollers__child-checkbox" data-parent="edu6_parent">
                                                            <span>Научно-ориентированное образование</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu6_14" class="spollers__child-checkbox" data-parent="edu6_parent">
                                                            <span>Подготовка к проверке знаний</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu6_15" class="spollers__child-checkbox" data-parent="edu6_parent">
                                                            <span>Центр безопасности</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <input type="checkbox" id="edu6_16" class="spollers__child-checkbox" data-parent="edu6_parent">
                                                            <span>Музей МЧС</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </details>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu6_4">
                                        <span>Подготовка к проверке знаний</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu6_5">
                                        <span>Центр безопасности</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="checkbox" id="edu6_6">
                                        <span>Музей МЧС</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </details>
                </div>
            </div>
            <ul class="page__banners">
                <li class="page__banners-item">
                    <a href="cart.html">
						<img src="/local/templates/new_ucp/assets/img/main/servicesBanner1.webp" alt="Image" title="Баннер 1">
                    </a>
                </li>
                <li class="page__banners-item">
                    <img src="/local/templates/new_ucp/assets/img/main/servicesBanner2.webp" alt="Image" title="Баннер 2">
                </li>

            </ul>
        </nav>
        <div class="page__content">
            <div class="page__content-header">
                <div class="title-block">
                    <h1 class="title-two">Услуги</h1>
                    <div class="sort__block" data-da=".sort-mobile,950, 1">
                        <button type="button" class="button-sort">
                            <div class="icon">
                                <iconify-icon icon="fluent:arrow-sort-16-regular" width="100%" height="100%" noobserver></iconify-icon>
                            </div>
                            <span>По популярности</span>
                        </button>
                        <div class="sort__content">
                            <ul>
                                <li>
                                    <label class="active _form-focus">
                                        <input type="radio" name="sort_cheap" value="cheap" class="_form-focus" checked>
                                        <span>По популярности</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" name="sort_dear" value="dear">
                                        <span>По названию (А-Я)</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" name="sort_short" value="short">
                                        <span>По названию (Я-А)</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" name="sort_long" value="long">
                                        <span>Сначала новые</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
         
                <nav class="breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="index.html" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="cart.html" class="breadcrumbs__link">Услуги</a>
                        </li>
                    </ul>
                </nav>
                <div class="page__mobile-action">
                    <button type="button" class="button-filter">
                        <div class="icon">
                            <iconify-icon icon="iconoir:filter" width="100%" height="100%" noobserver></iconify-icon>
                        </div>
                        <span>Фильтр</span>
                    </button>
                    <div class="sort-mobile"></div>
                    <div class="page__mobile-filter">
                        <div class="page__mobile-filter-header">
                            <h4 class="title-four">Фильтр</h4>
                            <button class="filter-close" data-close>
                                <iconify-icon icon="lucide:x" width="24" height="24" noobserver></iconify-icon>
                            </button>
                        </div>
                        <div class="page__mobile-filter-content">
                            <form action="#">
                                <div class="page__sidebar-content-mobile"></div>
                                <div class="page__mobile-filter-action">
                                    <button type="button" class="button-result" data-close>
                                        <span>Показать результат</span>
                                        <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="services__list-wrapper">
                <ul class="services__list">
                    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                        <?php
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        
                        $imgSrc = "";
                        if (is_array($arItem["PREVIEW_PICTURE"])) {
                            $imgSrc = $arItem["PREVIEW_PICTURE"]["SRC"];
                        }
                        
                        $iconSrc = "";
                        if (!empty($arItem["PROPERTIES"]["ICON"]["VALUE"])) {
                            $iconSrc = $arItem["PROPERTIES"]["ICON"]["VALUE"];
                        }
                        
                        $badge = "";
                        if (!empty($arItem["PROPERTIES"]["BADGE"]["VALUE"])) {
                            $badge = $arItem["PROPERTIES"]["BADGE"]["VALUE"];
                        }
                        
                        $hashtags = array();
                        if (!empty($arItem["PROPERTIES"]["HASHTAGS"]["VALUE"])) {
                            $hashtags = $arItem["PROPERTIES"]["HASHTAGS"]["VALUE"];
                        }
                        ?>
                        <li class="services__list-item" id="<?php echo $this->GetEditAreaId($arItem['ID']); ?>">
                            <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>" class="services__list-item-img">
                                <?php if (!empty($imgSrc)): ?>
                                    <img src="<?php echo $imgSrc; ?>" alt="<?php echo $arItem["PREVIEW_PICTURE"]["ALT"]; ?>" title="<?php echo $arItem["PREVIEW_PICTURE"]["TITLE"]; ?>">
                                <?php endif; ?>
                                <div class="services__list-item-badge">
                                    <?php if (!empty($iconSrc)): ?>
                                        <div class="icon">
                                            <img src="<?php echo $iconSrc; ?>" alt="Image">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($badge)): ?>
                                        <div class="label"><?php echo $badge; ?></div>
                                    <?php endif; ?>
                                </div>
                            </a>
                            <div class="services__list-item-info">
                                <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>" class="services__list-item-info-content">
                                    <h4><?php echo $arItem["NAME"]; ?></h4>
                                    <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && !empty($arItem["PREVIEW_TEXT"])): ?>
                                        <p><?php echo $arItem["PREVIEW_TEXT"]; ?></p>
                                    <?php endif; ?>
                                </a>
                                <?php if (!empty($hashtags)): ?>
                                    <ul class="hashtags">
                                        <?php foreach ($hashtags as $hashtag): ?>
                                            <li class="hashtags__item"><a href="#">#<?php echo htmlspecialcharsbx($hashtag); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                    <nav class="pagination__nav" aria-label="Навигация по страницам">
                        <ul class="pagination">
                            <?php echo $arResult["NAV_STRING"]; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>