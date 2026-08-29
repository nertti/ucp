<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<?php if (!empty($arResult['ITEMS'])): ?>
    <?php foreach ($arResult['ITEMS'] as $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="news__recent-item">
            <a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
                <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem["NAME"] ?>"
                     title="<?= $arItem["NAME"] ?>"/>
                <p><?= $arItem["NAME"] ?></p>
            </a>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
