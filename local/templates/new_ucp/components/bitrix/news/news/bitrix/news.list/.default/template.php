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
    <ul class="news__list">
        <?php foreach ($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="news__list-item">
                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="news__list-item-img">
                    <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>"
                         title="<?= $arItem['NAME'] ?>"/>
                    <?php if (!empty($arItem['ICON'])): ?>
                        <div class="icon">
                            <?= $arItem['ICON'] ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($arItem['PROPERTIES']['VIEW_ON_MAIN']['VALUE_XML_ID'] == 'Y'): ?>
                        <div class="label">
                            <span>Главная новость</span>
                        </div>
                    <?php endif; ?>

                </a>
                <div class="news__list-item-info">
                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="news__list-item-info-content">
                        <div class="date">
                            <iconify-icon icon="lsicon:calendar-outline" width="18" height="18"
                                          noobserver></iconify-icon>
                            <span><?= (new DateTime($arItem['ACTIVE_FROM']))->format('d.m.Y') ?></span>
                        </div>
                        <h5>
                            <?= $arItem['NAME'] ?>
                        </h5>
                        <p>
                            <?=$arItem['TEXT']?>
                        </p>
                    </a>
                    <?php if (!empty($arItem['HASHTAGS']['TAGS'])): ?>
                        <ul class="hashtags">
                            <?php foreach ($arItem['HASHTAGS']['TAGS'] as $hashtagTag): ?>
                                <li class="hashtags__item">
                                    <a
                                            class="news-filter-tag"
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


                    <?php if (!empty($arItem['HASHTAGS']['PROJECTS'])): ?>
                        <ul class="hashtags">
                            <?php if($arItem['PROPERTIES']['IS_PROJECT']['VALUE_XML_ID'] == 'Y'):?>
                                <li class="hashtags__item">
                                    <a
                                            class="news-filter-project"
                                            data-is-project="126"
                                            data-name="Проект"
                                            href="?is-project=126"
                                    >
                                        #Проект
                                    </a>
                                </li>
                            <?php endif;?>
                            <?php foreach ($arItem['HASHTAGS']['PROJECTS'] as $hashtagProject): ?>
                                <li class="hashtags__item">
                                    <a
                                            class="news-filter-project"
                                            data-project="<?= htmlspecialcharsbx($hashtagProject['UF_XML_ID']) ?>"
                                            data-name="<?= htmlspecialcharsbx($hashtagProject['NAME']) ?>"
                                            href="?<?= htmlspecialcharsbx($hashtagProject['LINK']) ?>"
                                    >
                                        #<?= htmlspecialcharsbx($hashtagProject['NAME']) ?>
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
<?php endif; ?>