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

$arGallery = array();
if (isset($arResult["PROPERTIES"]["GALLERY"]["VALUE"]) && is_array($arResult["PROPERTIES"]["GALLERY"]["VALUE"])) {
    foreach ($arResult["PROPERTIES"]["GALLERY"]["VALUE"] as $fileId) {
        $file = CFile::GetFileArray($fileId);
        if ($file) {
            $arGallery[] = $file;
        }
    }
}
$nextElement = null;
if (isset($arParams["NEXT_ELEMENT"]) && $arParams["NEXT_ELEMENT"] == "Y") {
    $rsNext = CIBlockElement::GetList(
            array("SORT" => "ASC", "ID" => "ASC"),
            array(
                    "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                    "ACTIVE" => "Y",
                    ">SORT" => $arResult["SORT"],
                    "!ID" => $arResult["ID"]
            ),
            false,
            array("nTopCount" => 1),
            array("ID", "NAME", "DETAIL_PAGE_URL", "CODE")
    );
    if ($arNext = $rsNext->GetNext()) {
        $nextElement = $arNext;
    }
}

if (!$nextElement) {
    $rsNext = CIBlockElement::GetList(
            array("SORT" => "ASC", "ID" => "ASC"),
            array(
                    "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                    "ACTIVE" => "Y",
                    "!ID" => $arResult["ID"]
            ),
            false,
            array("nTopCount" => 1),
            array("ID", "NAME", "DETAIL_PAGE_URL", "CODE")
    );
    if ($arNext = $rsNext->GetNext()) {
        $nextElement = $arNext;
    }
}

$arResult["NEXT_ELEMENT"] = $nextElement;

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
                            href="/news/?<?= htmlspecialcharsbx($hashtagTag['LINK']) ?>"
                    >
                        #<?= htmlspecialcharsbx($hashtagTag['NAME']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php foreach ($arResult['HASHTAGS']['PROJECTS'] as $hashtagProject): ?>
                <li class="hashtags__item">
                    <a
                            class="news-filter-project"
                            data-project="<?= htmlspecialcharsbx($hashtagProject['UF_XML_ID']) ?>"
                            data-name="<?= htmlspecialcharsbx($hashtagProject['NAME']) ?>"
                            href="/news/?<?= htmlspecialcharsbx($hashtagProject['LINK']) ?>"
                    >
                        #<?= htmlspecialcharsbx($hashtagProject['NAME']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="page__action">
        <a href="/news/" class="button-blue _prev">
            <iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver></iconify-icon>
            <span>Ко всем новостям</span>
        </a>

        <a href="<?php echo $arResult["NEXT_ELEMENT"]["DETAIL_PAGE_URL"]; ?>" class="button-blue _next">
            <span>Следующая новость</span>
            <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
        </a>

    </div>

</div>
