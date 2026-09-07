<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<div class="title-block">
    <h2 class="title-two">
        <a href="/services/">Услуги</a>
    </h2>
    <a href="/services/" class="button-all">
        <span>Все услуги</span>
        <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
    </a>
</div>

<ul class="tabs">
    <li class="tabs__item _active" data-code="all" data-tab="all">
        <button type="button">
            <iconify-icon icon="hugeicons:stars" width="24" height="24" noobserver=""></iconify-icon>
            <span>Все услуги</span>
        </button>
    </li>
    <?php if(!empty($arResult["PARENT_SECTIONS"])): ?>
        <?php foreach ($arResult["PARENT_SECTIONS"] as $section):?>
            <?// Заполняем и data-code, и data-tab для совместимости с JS ?>
            <li class="tabs__item" data-code="<?=$section['CODE']?>" data-tab="<?=$section['CODE']?>">
                <button type="button">
                    <?=$section['UF_ICON_MAIN_1']?>
                    <span><?=$section['NAME']?></span>
                </button>
            </li>
        <?php endforeach;?>
    <?php endif; ?>
</ul>

<div class="services__wrapper">
    <!-- Блок со скелетонами -->
    <ul class="services__skeleton-list">
        <?for($i=0; $i<5; $i++):?>
            <li class="services__skeleton-item">
                <div class="skeleton-header">
                    <div class="skeleton-icon skeleton-el"></div>
                    <div class="skeleton-label skeleton-el"></div>
                </div>
                <div class="skeleton-content">
                    <div class="skeleton-title skeleton-el"></div>
                    <div class="skeleton-text skeleton-el"></div>
                    <div class="skeleton-text skeleton-el _short"></div>
                </div>
            </li>
        <?endfor;?>

        <!-- Элемент пустого состояния -->
        <li class="services__skeleton-item _empty-state" style="display: none; grid-column: 1 / -1; text-align: center; justify-content: center; align-items: center; min-height: 150px;">
            <div class="services__main-list-content" style="align-items: center; gap: 12px;">
                <iconify-icon icon="solar:box-minimalistic-linear" width="48" height="48" style="color: #0c338c; opacity: 0.6;"></iconify-icon>
                <h3 style="-webkit-line-clamp: unset; text-align: center;">В данном разделе пока нет доступных услуг</h3>
                <p style="-webkit-line-clamp: unset; text-align: center;">Мы уже работаем над наполнением этой категории.</p>
            </div>
        </li>
    </ul>

    <!-- Основной список услуг -->
    <ul class="services__main-list">
        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

            // 1. Способ: Пробуем взять ID привязанного раздела элемента напрямую
            $sectionId = !empty($arItem["IBLOCK_SECTION_ID"]) ? $arItem["IBLOCK_SECTION_ID"] : $arItem["SECTION"]["ID"];

            $sectionCodes = [];
            $directSectionCode = "";

            if ($sectionId) {
                // Получаем всю цепочку разделов от корня до текущего подраздела
                $nav = CIBlockSection::GetNavChain($arItem["IBLOCK_ID"], $sectionId, array("ID", "CODE"));
                while ($sectionPath = $nav->Fetch()) {
                    if (!empty($sectionPath["CODE"])) {
                        $sectionCodes[] = $sectionPath["CODE"];
                        // Запоминаем код самого нижнего (текущего) подраздела
                        $directSectionCode = $sectionPath["CODE"];
                    }
                }
            }

            // Если GetNavChain не вернул коды, попробуем взять код из стандартных полей Битрикса
            if (empty($directSectionCode) && !empty($arItem["SECTION_CODE"])) {
                $directSectionCode = $arItem["SECTION_CODE"];
                $sectionCodes[] = $arItem["SECTION_CODE"];
            }

            $categoriesJson = htmlspecialchars(json_encode($sectionCodes));
            ?>
            <li class="services__main-list-item <?=($arItem["PROPERTIES"]["ATT_BLUE"]["VALUE"] || in_array('_blue', $arItem["PROPERTIES"])) ? '_blue' : ''?>"
                id="<?=$this->GetEditAreaId($arItem['ID']);?>"
                data-category="<?=$directSectionCode?>"
                data-categories='<?=$categoriesJson?>'>

                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <div class="services__main-list-header">
                        <div class="icon">
                            <?if(!empty($arItem["PROPERTIES"]["ATT_ICON"]["VALUE"])):?>
                                <iconify-icon icon="<?=$arItem["PROPERTIES"]["ATT_ICON"]["VALUE"]?>" width="100%" height="100%" noobserver=""></iconify-icon>
                            <?else:?>
                                <iconify-icon icon="lucide:atom" width="100%" height="100%" noobserver=""></iconify-icon>
                            <?endif;?>
                        </div>
                        <?if(!empty($arItem["PROPERTIES"]["ATT_LABEL"]["VALUE"])):?>
                            <div class="label"><?=$arItem["PROPERTIES"]["ATT_LABEL"]["VALUE"]?></div>
                        <?endif;?>
                    </div>
                    <div class="services__main-list-content">
                        <h3><?=$arItem["NAME"]?></h3>
                        <p><?=$arItem["PREVIEW_TEXT"]?></p>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>