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

            $eventDate = $arItem["ACTIVE_FROM"] ?: $arItem["DATE_CREATE"];
            

            $day = "";
            $month = "";
            if ($eventDate) {
                $timestamp = MakeTimeStamp($eventDate);
                $day = date("d", $timestamp);
                $month = strtoupper(FormatDate("M", $timestamp));
            }
            
            $title = $arItem["NAME"];
            $location = $arItem["PREVIEW_TEXT"];


            // $location = $arItem["PROPERTY_LOCATION_VALUE"] ?: $arItem["PREVIEW_TEXT"];
            ?>
            
            <li class="home__feed-event-item" id="<?php echo $this->GetEditAreaId($arItem['ID']); ?>">
				<a href="<?php echo $arItem["PROPERTIES"]["LINK"]["VALUE"]; ?>">
                    <div class="home__feed-event-date">
                        <p><strong><?php echo $arItem["PROPERTIES"]["DATE"]["DESCRIPTION"]; ?></strong> <?php echo $arItem["PROPERTIES"]["DATE"]["VALUE"]; ?></p>
                    </div>
                    <div class="home__feed-event-info">
                        <h4><?php echo $title; ?></h4>
                        <?php if (!empty($location)): ?>
                            <p><?php echo $location; ?></p>
                        <?php endif; ?>
                    </div>
                </a>
            </li>
            
        <?php endforeach; ?>
    </ul>
</div>