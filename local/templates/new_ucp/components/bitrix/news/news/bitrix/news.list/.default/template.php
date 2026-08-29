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
            <?php $APPLICATION->IncludeFile(
                    "/include/news/filter.php",
                    array(),
                    array(
                            "MODE" => "html"
                    )
            ); ?>
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
                <div class="title-block">
                    <h1 class="title-two">Новости</h1>
                    <a href="#" class="button-rss" data-da=".button-rss__mobile,950,1">
                        <iconify-icon icon="line-md:rss" width="24" height="24" noobserver></iconify-icon>
                        <span>RSS</span>
                    </a>
                </div>
                <?php $APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "breadcrumb",
                        array(
                                "COMPONENT_TEMPLATE" => "breadcrumb",
                                "PATH" => "",
                                "SITE_ID" => "s1",
                                "START_FROM" => "0"
                        )
                ); ?>
                <div class="page__mobile-action">
                    <button type="button" class="button-filter">
                        <div class="icon">
                            <iconify-icon icon="iconoir:filter" width="100%" height="100%" noobserver></iconify-icon>
                        </div>
                        <span>Фильтр</span>
                    </button>
                    <div class="button-rss__mobile"></div>
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
            <div class="news__list-wrapper" id="ajax-wrapper">
                <ul class="news__list" id="news-list">
                    <?php foreach ($arResult["ITEMS"] as $arItem):
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                            <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="news__list-item">
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news__list-item-img">
                                    <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" />
                                </a>
                                <div class="news__list-item-info">
                                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news__list-item-info-content">
                                        <div class="date">
                                            <iconify-icon icon="lsicon:calendar-outline" width="18" height="18" noobserver></iconify-icon>
                                            <span><?= (new DateTime($arItem['ACTIVE_FROM']))->format('d.m.Y') ?></span>
                                        </div>
                                        <h5>
                                            <?=$arItem['NAME']?>
                                        </h5>
                                        <p>
                                            <?=$arItem['PREVIEW_TEXT']?>
                                        </p>
                                    </a>
                                    <?php if ($arItem['HASHTAGS']): ?>
                                    <ul class="hashtags">
                                    <?php foreach ($arItem['HASHTAGS'] as $hashtag): ?>
                                            <li class="hashtags__item">
                                                <a href="?<?= htmlspecialcharsbx($hashtag['LINK']) ?>">#<?= htmlspecialcharsbx($hashtag['NAME']) ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>
                                </div>
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


