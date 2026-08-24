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

$mainItem = array_shift($arResult["ITEMS"]);
$latestItems = $arResult["ITEMS"];
?>

<section class="universities__news-main">
    <div class="home__feed-news">
        <div class="home__feed-news-content">
            <?php if (!empty($mainItem)): ?>
                <?php
                $this->AddEditAction($mainItem['ID'], $mainItem['EDIT_LINK'], CIBlock::GetArrayByID($mainItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($mainItem['ID'], $mainItem['DELETE_LINK'], CIBlock::GetArrayByID($mainItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                
                $imgSrc = "";
                if (is_array($mainItem["PREVIEW_PICTURE"])) {
                    $imgSrc = $mainItem["PREVIEW_PICTURE"]["SRC"];
                }
                
                $date = "";
                if ($arParams["DISPLAY_DATE"] != "N" && $mainItem["DISPLAY_ACTIVE_FROM"]) {
                    $date = $mainItem["DISPLAY_ACTIVE_FROM"];
                }
                ?>
                <div class="home__feed-news-main" id="<?php echo $this->GetEditAreaId($mainItem['ID']); ?>">
                    <a href="<?php echo $mainItem["DETAIL_PAGE_URL"]; ?>">
                        <div class="home__feed-news-slider-img">
                            <?php if (!empty($imgSrc)): ?>
                                <img src="<?php echo $imgSrc; ?>" alt="<?php echo $mainItem["PREVIEW_PICTURE"]["ALT"]; ?>" title="<?php echo $mainItem["PREVIEW_PICTURE"]["TITLE"]; ?>">
                            <?php endif; ?>
                        </div>
                        <div class="home__feed-news-slider-info">
                            <div class="date">
                                <iconify-icon icon="lsicon:calendar-outline" width="18" height="18" noobserver></iconify-icon>
                                <span><?php echo $date; ?></span>
                            </div>
                            <h4 class="title-four"><?php echo $mainItem["NAME"]; ?></h4>
                            <?php if (!empty($mainItem["PREVIEW_TEXT"])): ?>
                                <p class="text-caption"><?php echo $mainItem["PREVIEW_TEXT"]; ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (!empty($latestItems)): ?>
                <div class="home__feed-news-latest">
                    <ul class="home__feed-news-list">
                        <?php foreach ($latestItems as $arItem): ?>
                            <?php
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            
                            $imgSrc = "";
                            if (is_array($arItem["PREVIEW_PICTURE"])) {
                                $imgSrc = $arItem["PREVIEW_PICTURE"]["SRC"];
                            }
                            
                            $date = "";
                            if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]) {
                                $date = $arItem["DISPLAY_ACTIVE_FROM"];
                            }
                            ?>
                            <li class="home__feed-news-item" id="<?php echo $this->GetEditAreaId($arItem['ID']); ?>">
                                <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>">
                                    <div class="home__feed-news-item-img">
                                        <?php if (!empty($imgSrc)): ?>
                                            <img src="<?php echo $imgSrc; ?>" alt="<?php echo $arItem["PREVIEW_PICTURE"]["ALT"]; ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="home__feed-news-info">
                                        <div class="date">
                                            <iconify-icon icon="lsicon:calendar-outline" width="18" height="18" noobserver></iconify-icon>
                                            <span><?php echo $date; ?></span>
                                        </div>
                                        <p><?php echo $arItem["NAME"]; ?></p>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
