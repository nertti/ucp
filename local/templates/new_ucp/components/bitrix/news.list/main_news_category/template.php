<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<?php if (!empty($arResult['ITEMS'])): ?>
    <?php foreach ($arResult['ITEMS'] as $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="home__feed-news-item" data-category="<?=$arItem['PROPERTIES']['CATEGORY']['VALUE']?>">
            <a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
                <div class="home__feed-news-item-img">
                    <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem["NAME"] ?>">
                </div>
                <div class="home__feed-news-info">
                    <div class="date">
                        <iconify-icon icon="lsicon:calendar-outline" width="18" height="18"
                                      noobserver=""></iconify-icon>
                        <span><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></span>
                    </div>
                    <p><?= $arItem["NAME"] ?></p>
                </div>
            </a>
        </li>
    <?php endforeach; ?>
<?php endif; ?>