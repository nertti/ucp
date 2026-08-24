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
            <ul class="page__banners">
                <li class="page__banners-item">
                    <a href="cart.html">
						<img src="/local/templates/new_ucp/assets/img/main/servicesBanner1.webp" alt="Image" title="Баннер 1">
                    </a>
                </li>
                <li class="page__banners-item">
					<img src="/local/templates/new_ucp/assets/img/main/servicesBanner2.webp" alt="Image" title="Баннер 2">
                </li>
                <li class="page__banners-item">
                    <a href="cart.html">
						<img src="/local/templates/new_ucp/assets/img/main/servicesBanner3.webp" alt="Image" title="Баннер 3">
                    </a>
                </li>

            </ul>
        </nav>
        <div class="page__content">
            <div class="page__content-header">
                <h1 class="title-two">События</h1>
                <nav class="breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="index.html" class="breadcrumbs__link">Главная</a>
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
                        
                        $imgSrc = "";
                        if (is_array($arItem["PREVIEW_PICTURE"])) {
                            $imgSrc = $arItem["PREVIEW_PICTURE"]["SRC"];
                        }
                        
                        $dateDay = "";
                        $dateMonth = "";
                        if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]) {
                            $timestamp = MakeTimeStamp($arItem["DISPLAY_ACTIVE_FROM"], FORMAT_DATETIME);
                            $dateDay = date("d", $timestamp);
                            $dateMonth = strtoupper(FormatDate("M", $timestamp));
                        }
                        
                        $previewText2 = "";
                        if (!empty($arItem["PROPERTIES"]["PREVIEW_TEXT_2"]["VALUE"]["TEXT"])) {
                            $previewText2 = $arItem["PROPERTIES"]["PREVIEW_TEXT_2"]["VALUE"]["TEXT"];
                        }
                        ?>
                        <li class="event__item" id="<?php echo $this->GetEditAreaId($arItem['ID']); ?>">
                            <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>">
                                <div class="event__item-date">
                                    <p><strong><?php echo $dateDay; ?></strong><?php echo $dateMonth; ?></p>
                                </div>
                                <div class="event__item-content">
                                    <div class="event__item-info">
                                        <h4 class="title-four"><?php echo $arItem["NAME"]; ?></h4>
                                        <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && !empty($arItem["PREVIEW_TEXT"])): ?>
                                            <div class="text-block">
                                                <p><?php echo $arItem["PREVIEW_TEXT"]; ?></p>
                                                <?php if (!empty($previewText2)): ?>
                                                    <p><?php echo $previewText2; ?></p>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($imgSrc)): ?>
                                        <img src="<?php echo $imgSrc; ?>" alt="<?php echo $arItem["PREVIEW_PICTURE"]["ALT"]; ?>" title="<?php echo $arItem["PREVIEW_PICTURE"]["TITLE"]; ?>">
                                    <?php endif; ?>
                                </div>
                            </a>
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