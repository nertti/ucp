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

$arSections = array();
$rsSections = CIBlockSection::GetList(
    array('SORT' => 'ASC', 'NAME' => 'ASC'),
    array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ACTIVE' => 'Y'),
    false,
    array('ID', 'NAME', 'CODE', 'SECTION_PAGE_URL')
);
while ($arSection = $rsSections->GetNext()) {
    $arSections[$arSection['ID']] = $arSection;
}
?>

<section class="page__services">
    <div class="title-block">
        <h2 class="title-two">
            <a href="<?php echo $arParams["LIST_PAGE_URL"]; ?>">Услуги</a>
        </h2>
        <a href="/new/uslugi/" class="button-all">
            <span>Все услуги</span>
            <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
        </a>
    </div>
    <ul class="services__main-list">
        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
            <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            
            $iconSrc = "";
            if (!empty($arItem["PROPERTIES"]["ICON"]["VALUE"])) {
                $iconSrc = $arItem["PROPERTIES"]["ICON"]["VALUE"];
            }
            
            $badge = "";
            if (!empty($arItem["PROPERTIES"]["ST"]["VALUE"])) {
                $badge = $arItem["PROPERTIES"]["ST"]["VALUE"];
            }
            ?>
            <li class="services__main-list-item" id="<?php echo $this->GetEditAreaId($arItem['ID']); ?>">
                <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>">
                    <div class="services__main-list-header">
                        <?php if (!empty($iconSrc)): ?>
                            <div class="icon">
                                <iconify-icon icon="<?php echo htmlspecialcharsbx($iconSrc); ?>" width="100%" height="100%" noobserver></iconify-icon>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($badge)): ?>
                            <div class="label"><?php echo htmlspecialcharsbx($badge); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="services__main-list-content">
                        <h3><?php echo $arItem["NAME"]; ?></h3>
                        <?php if (!empty($arItem["PREVIEW_TEXT"])): ?>
                            <p><?php echo $arItem["PREVIEW_TEXT"]; ?></p>
                        <?php endif; ?>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>