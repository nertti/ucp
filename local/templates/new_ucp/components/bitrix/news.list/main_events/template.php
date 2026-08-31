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

<div class="home__feed-event">
    <div class="title-block">
        <h3 class="title-three">
            <a href="/events/">События</a>
        </h3>
        <a href="/events/" class="button-all">
            <span>Все события</span>
            <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
        </a>
    </div>
    
    <ul class="home__feed-event-list">
        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
            <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            
            <li class="home__feed-event-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<a href="<?= !empty($arItem["PROPERTIES"]["LINK"]["VALUE"])
                        ? htmlspecialcharsbx($arItem["PROPERTIES"]["LINK"]["VALUE"])
                        : "/events/?id=" . $arItem["ID"] ?>">
                    <div class="home__feed-event-date">
                        <p><strong><?= $arItem["PROPERTIES"]["DATE"]["DESCRIPTION"]; ?></strong> <?php echo $arItem["PROPERTIES"]["DATE"]["VALUE"]; ?></p>
                    </div>
                    <div class="home__feed-event-info">
                        <h4><?=$arItem["NAME"]; ?></h4>
                        <p><?=$arItem["PREVIEW_TEXT"]?></p>
                    </div>
                </a>
            </li>
            
        <?php endforeach; ?>
    </ul>
</div>