<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);
?>

<main class="page">
    <div class="page__container">

        <nav class="page__sidebar">

            <?php
            $APPLICATION->IncludeFile(
                "/include/left/menu.php",
                [],
                [
                    "MODE" => "html"
                ]
            );
            ?>

            <?php
            $APPLICATION->IncludeFile(
                "/include/left/banners.php",
                [],
                [
                    "MODE" => "html"
                ]
            );
            ?>

        </nav>

        <div class="page__content">

            <div class="page__content-header">

                <h1 class="title-two">
                    События
                </h1>

                <nav class="breadcrumbs">
                    <ul class="breadcrumbs__list">

                        <li class="breadcrumbs__item">
                            <a href="/" class="breadcrumbs__link">
                                Главная
                            </a>
                        </li>

                        <li class="breadcrumbs__item">
                            <span class="breadcrumbs__link">
                                События
                            </span>
                        </li>

                    </ul>
                </nav>

            </div>

            <div class="event__wrapper">

                <?php if (!empty($arResult["ITEMS"])): ?>

                    <ul class="event__list">

                        <?php foreach ($arResult["ITEMS"] as $arItem): ?>

                            <?php
                            $this->AddEditAction(
                                $arItem['ID'],
                                $arItem['EDIT_LINK'],
                                CIBlock::GetArrayByID(
                                    $arItem["IBLOCK_ID"],
                                    "ELEMENT_EDIT"
                                )
                            );

                            $this->AddDeleteAction(
                                $arItem['ID'],
                                $arItem['DELETE_LINK'],
                                CIBlock::GetArrayByID(
                                    $arItem["IBLOCK_ID"],
                                    "ELEMENT_DELETE"
                                ),
                                [
                                    "CONFIRM" => GetMessage(
                                        'CT_BNL_ELEMENT_DELETE_CONFIRM'
                                    )
                                ]
                            );

                            // Ссылка события
                            $link = '';

                            if (!empty($arItem["PROPERTIES"]["LINK"]["VALUE"])) {
                                $link = trim($arItem["PROPERTIES"]["LINK"]["VALUE"]);
                            }

                            // Дата
                            $dateValue = '';
                            $dateDescription = '';

                            if (!empty($arItem["PROPERTIES"]["DATE"])) {
                                $dateValue = $arItem["PROPERTIES"]["DATE"]["VALUE"] ?? '';
                                $dateDescription = $arItem["PROPERTIES"]["DATE"]["DESCRIPTION"] ?? '';
                            }

                            // Картинка
                            $picture = $arItem["PREVIEW_PICTURE"] ?? null;
                            ?>

                            <li
                                class="event__item"
                                id="<?= $this->GetEditAreaId($arItem['ID']) ?>"
                                data-event-id="<?= (int)$arItem['ID'] ?>"
                            >

                                <?php if ($link): ?>

                                    <a
                                        href="<?= htmlspecialcharsbx($link) ?>"
                                        class="event__item-link"
                                        aria-label="<?= htmlspecialcharsbx($arItem["NAME"]) ?>"
                                    ></a>

                                <?php endif; ?>


                                <div class="event__item-date">
                                    <p>

                                        <?php if ($dateDescription): ?>

                                            <strong>
                                                <?= htmlspecialcharsbx($dateDescription) ?>
                                            </strong>

                                        <?php endif; ?>

                                        <?= htmlspecialcharsbx($dateValue) ?>

                                    </p>
                                </div>


                                <div class="event__item-content">

                                    <div class="event__item-info">

                                        <h4 class="title-four">
                                            <?= htmlspecialcharsbx($arItem["NAME"]) ?>
                                        </h4>


                                        <?php if (!empty($arItem["DETAIL_TEXT"])): ?>

                                            <div class="text-block">
                                                <?= $arItem["DETAIL_TEXT"] ?>
                                            </div>

                                        <?php endif; ?>

                                    </div>


                                    <?php if (!empty($picture["SRC"])): ?>

                                        <img
                                            loading="lazy"
                                            src="<?= htmlspecialcharsbx($picture["SRC"]) ?>"
                                            alt="<?= htmlspecialcharsbx(
                                                $picture["ALT"] ?? $arItem["NAME"]
                                            ) ?>"
                                            title="<?= htmlspecialcharsbx(
                                                $picture["TITLE"] ?? $arItem["NAME"]
                                            ) ?>"
                                        >

                                    <?php endif; ?>

                                </div>

                            </li>

                        <?php endforeach; ?>

                    </ul>

                <?php endif; ?>


                <?php if (!empty($arParams["DISPLAY_BOTTOM_PAGER"])): ?>

                    <?= $arResult["NAV_STRING"] ?>

                <?php endif; ?>

            </div>

        </div>

    </div>
</main>