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
<div class="news__slider swiper">
    <div class="swiper-wrapper">
        <?php foreach ($arResult['ITEMS'] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="swiper-slide">
                <div class="news__slider-wrapper">
                    <a href="/news/?project=<?=$arItem['PROPERTIES']['TAG']['VALUE']?>"
                       class="news__slider-img">
                        <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                             alt="<?= $arItem['NAME'] ?>"
                             title="<?= $arItem['NAME'] ?>"/>
                    </a>
                    <div class="news__slider-action">
                        <button class="news__slider-button-prev swiper-button-prev">
                            <iconify-icon icon="lucide:chevron-left" width="24" height="24"
                                          noobserver></iconify-icon>
                        </button>
                        <button class="news__slider-button-next swiper-button-next">
                            <iconify-icon icon="lucide:chevron-right" width="24" height="24"
                                          noobserver></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="news__slider-content">
                    <div class="news__slider-info">
                        <h2 class="title-two">
                            <a href="/news/?project=<?=$arItem['PROPERTIES']['TAG']['VALUE']?>">
                                <?= $arItem['NAME'] ?></a>
                        </h2>
                        <p class="text">
                            <?= $arItem['PREVIEW_TEXT'] ?>
                        </p>
                        <a href="/news/?project=<?=$arItem['PROPERTIES']['TAG']['VALUE']?>"
                           class="button-detail">
                            <span>Подробне</span>
                            <iconify-icon icon="lucide:chevron-right" width="24" height="24"
                                          noobserver></iconify-icon>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php endif; ?>





