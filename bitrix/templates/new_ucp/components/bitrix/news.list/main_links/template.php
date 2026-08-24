<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<?php if (!empty($arResult['ITEMS'])): ?>
    <ul class="home__feed-nav-list">
        <?php foreach ($arResult['ITEMS'] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="home__feed-nav-item">
                <a href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>" style="background: url(<?= CFile::GetPath($arItem['PROPERTIES']['BACKGROUND']['VALUE']) ?>) #d3d3d3 50%/cover no-repeat;">
                    <img src="<?= CFile::GetPath($arItem['PROPERTIES']['ICON_DESKTOP']['VALUE']) ?>" alt="<?= $arItem['NAME'] ?>"/>
                    <p><?= $arItem['NAME'] ?></p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>