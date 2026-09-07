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
<?php if (!empty($arResult["ITEMS"])): ?>
    <ul class="services__list">
    <?php foreach ($arResult["ITEMS"] as $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="services__list-item">
            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="services__list-item-img">
                <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>" title="<?= $arItem['NAME'] ?>" />
                <div class="services__list-item-badge">
                    <div class="icon">
                        <img src="<?= $arItem['ICON'] ?>" alt="<?= $arItem['SECTION_NAME'] ?>" />
                    </div>
                    <?php if (!empty($arItem['PROPERTIES']['TAG']['VALUE'])): ?>
                        <div class="label">
                            <span><?=$arItem['PROPERTIES']['TAG']['VALUE']?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </a>
            <div class="services__list-item-info">
                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="services__list-item-info-content">
                    <h4><?= $arItem['NAME'] ?></h4>
                    <p>
                        <?=$arItem['TEXT']?>
                    </p>
                </a>
                <?php if (!empty($arItem['HASHTAGS']['TAGS'])): ?>
                    <ul class="hashtags">
                        <?php foreach ($arItem['HASHTAGS']['TAGS'] as $hashtagTag): ?>
                            <li class="hashtags__item">
                                <a
                                        class="services-filter-tag"
                                        data-tag="<?= htmlspecialcharsbx($hashtagTag['UF_XML_ID']) ?>"
                                        data-name="<?= htmlspecialcharsbx($hashtagTag['NAME']) ?>"
                                        href="?<?= htmlspecialcharsbx($hashtagTag['LINK']) ?>"
                                >
                                    #<?= htmlspecialcharsbx($hashtagTag['NAME']) ?>
                                </a>
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
<?php else:?>
    <p class="text">По вашему запросу ничего не найдено</p>
<?php endif; ?>