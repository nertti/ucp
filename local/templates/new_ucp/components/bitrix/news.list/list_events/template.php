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
            <div class="page__sidebar-content _event">
                <ul class="page__sidebar-event">
                    <li class="page__sidebar-event-item"><a href="#">История</a></li>
                    <li class="page__sidebar-event-item"><a href="#">Презентация университета</a></li>
                    <li class="page__sidebar-event-item">
                        <a href="#">Лицензии, сертификаты и аттестаты</a>
                    </li>
                    <li class="page__sidebar-event-item"><a href="#">Система менеджмента качества</a></li>
                    <li class="page__sidebar-event-item">
                        <a href="#">Система управления охраной труда</a>
                    </li>
                    <li class="page__sidebar-event-item"><a href="#">Информационные ресурсы</a></li>
                    <li class="page__sidebar-event-item">
                        <a href="#">Нумерация корпусов и учебных аудиторий</a>
                    </li>
                    <li class="page__sidebar-event-item">
                        <a href="#">Политика в отношении обработки персональных данных</a>
                    </li>
                    <li class="page__sidebar-event-item"><a href="#">Вакансии</a></li>
                    <li class="page__sidebar-event-item _active"><a href="#">События</a></li>
                </ul>
            </div>
            <?php $APPLICATION->IncludeFile(
                    "/include/left/banners.php",
                    array(),
                    array(
                            "MODE" => "html"
                    )
            ); ?>
        </nav>
        <div class="page__content">
            <div class="page__content-header">
                <h1 class="title-two">События</h1>
                <nav class="breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="/" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="#" class="breadcrumbs__link">События</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="event__wrapper">
                <ul class="event__list">
                    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                        <?php
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <li class="event__item" id="<?php echo $this->GetEditAreaId($arItem['ID']); ?>">
                            <a href="<?php echo $arItem["PROPERTIES"]["LINK"]["VALUE"]; ?>">
                                <div class="event__item-date">
                                    <p>
                                        <strong><?php echo $arItem["PROPERTIES"]["DATE"]["DESCRIPTION"]; ?></strong><?php echo $arItem["PROPERTIES"]["DATE"]["VALUE"]; ?>
                                    </p>
                                </div>
                                <div class="event__item-content">
                                    <div class="event__item-info">
                                        <h4 class="title-four"><?= $arItem["NAME"]; ?></h4>
                                        <div class="text-block">
                                            <p><?= $arItem["DETAIL_TEXT"]; ?></p>
                                        </div>
                                    </div>
                                    <?php if (!empty($arItem["PREVIEW_PICTURE"]["SRC"])): ?>
                                        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                             alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"]; ?>"
                                             title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"]; ?>">
                                    <?php endif; ?>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                    <?php echo $arResult["NAV_STRING"]; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>