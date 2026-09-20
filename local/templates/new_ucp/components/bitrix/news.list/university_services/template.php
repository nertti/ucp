<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<?php if($arResult["ITEMS"]):?>
<section class="page__services">
    <div class="title-block">
        <h2 class="title-two">
            <a href="">Услуги</a>
        </h2>
        <a href="/services/?institute=<?=$arParams["SECTION_SERVICES"]?>" class="button-all">
            <span>Все услуги</span>
            <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
        </a>
    </div>
    <ul class="services__main-list">
        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
        <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li class="services__list-item"
                id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="services__list-item-img">
                    <img loading="lazy" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>" title="<?= $arItem['NAME'] ?>" />
                    <div class="services__list-item-badge">
                        <div class="icon">
                            <img loading="lazy" src="<?= $arItem['ICON'] ?>" alt="<?= $arItem['SECTION_NAME'] ?>" />
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
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<?php endif; ?>