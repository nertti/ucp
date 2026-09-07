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
            <?php if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
                <div class="date">
                    <iconify-icon icon="lsicon:calendar-outline" width="18" height="18" noobserver></iconify-icon>
                    <span><?php echo $arResult["DISPLAY_ACTIVE_FROM"]; ?></span>
                </div>
            <?php endif; ?>
            <h1 class="title-two"><?= $arResult["NAME"]; ?></h1>
        </div>
    </div>
    <div class="page__info">
        <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && !empty($arResult["PREVIEW_TEXT"])): ?>
            <p><strong><?php echo $arResult["PREVIEW_TEXT"]; ?></strong></p>
        <?php endif; ?>
        <?php if (!empty($arResult["DETAIL_TEXT"])): ?>
            <div class="page__info-block">
                <?php echo $arResult["DETAIL_TEXT"]; ?>
            </div>
        <?php endif; ?>
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
