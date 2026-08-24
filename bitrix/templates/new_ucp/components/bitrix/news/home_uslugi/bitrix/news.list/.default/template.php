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
    array('IBLOCK_ID' => 79, 'ACTIVE' => 'Y'),
    false,
    array('ID', 'NAME', 'CODE', 'SECTION_PAGE_URL', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID')
);
while ($arSection = $rsSections->GetNext()) {
    $arSections[$arSection['ID']] = $arSection;
}

$topSections = array();
foreach ($arSections as $id => $section) {
    if ($section['DEPTH_LEVEL'] == 1) {
        $topSections[$id] = $section;
        $topSections[$id]['CHILDREN'] = array();
    }
}
foreach ($arSections as $id => $section) {
    if ($section['DEPTH_LEVEL'] > 1 && isset($topSections[$section['IBLOCK_SECTION_ID']])) {
        $topSections[$section['IBLOCK_SECTION_ID']]['CHILDREN'][] = $id;
    }
}

$sectionIcons = array(
    'Образовательные и просветительские услуги' => 'streamline-plump:graduation-cap',
    'Наука и инновационная продукция' => 'lucide:atom',
    'Испытательная деятельность' => 'famicons:flask-outline',
    'Экспертная деятельность' => 'solar:clipboard-check-linear',
    'Орган по сертификации продукции' => 'lucide:file-badge',
    'Полиграфические и сервисные услуги' => 'lucide:briefcase-business',
    'Молния' => 'mynaui:lightning',
);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<section class="home__services">
    <div class="home__container">
        <div class="title-block">
            <h2 class="title-two">
                <a href="<?php echo $arParams["LIST_PAGE_URL"]; ?>">Услуги</a>
            </h2>
            <a href="/new/uslugi/" class="button-all">
                <span>Все услуги</span>
                <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
            </a>
        </div>
        <ul class="tabs" id="services-tabs">
            <li class="tabs__item _active" data-section="0">
                <button type="button">
                    <iconify-icon icon="hugeicons:stars" width="24" height="24" noobserver></iconify-icon>
                    <span>Все услуги</span>
                </button>
            </li>
            <?php foreach ($topSections as $arSection): ?>
                <li class="tabs__item" data-section="<?php echo $arSection['ID']; ?>">
                    <button type="button">
                        <?php if (isset($sectionIcons[$arSection['NAME']])): ?>
                            <iconify-icon icon="<?php echo $sectionIcons[$arSection['NAME']]; ?>" width="24" height="24" noobserver></iconify-icon>
                        <?php endif; ?>
                        <span><?php echo $arSection['NAME']; ?></span>
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>
        <ul class="services__main-list" id="services-main-list">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <?php
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                
                $sectionId = 0;
                $parentId = 0;
                if (!empty($arItem["IBLOCK_SECTION_ID"])) {
                    $sectionId = $arItem["IBLOCK_SECTION_ID"];
                    if (isset($arSections[$sectionId]) && $arSections[$sectionId]['DEPTH_LEVEL'] > 1) {
                        $parentId = $arSections[$sectionId]['IBLOCK_SECTION_ID'];
                    }
                }
                
                $iconSrc = "";
                if (!empty($arItem["PROPERTIES"]["ICON"]["VALUE"])) {
                    $iconSrc = $arItem["PROPERTIES"]["ICON"]["VALUE"];
                } elseif ($parentId > 0 && isset($topSections[$parentId])) {
                    $sectionName = $topSections[$parentId]['NAME'];
                    if (isset($sectionIcons[$sectionName])) {
                        $iconSrc = $sectionIcons[$sectionName];
                    }
                }
                
                $badge = "";
                if (!empty($arItem["PROPERTIES"]["ST"]["VALUE"])) {
                    $badge = $arItem["PROPERTIES"]["ST"]["VALUE"];
                }
                ?>
                <li class="services__main-list-item" data-section="<?php echo $parentId > 0 ? $parentId : $sectionId; ?>" id="<?php echo $this->GetEditAreaId($arItem['ID']); ?>">
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
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var allItems = document.querySelectorAll('.services__main-list-item');
    var tabs = document.querySelectorAll('.tabs__item');
    
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            var sectionId = parseInt(this.dataset.section);
            
            tabs.forEach(function(t) {
                t.classList.remove('_active');
            });
            this.classList.add('_active');
            
            if (sectionId === 0) {
                allItems.forEach(function(item) {
                    item.style.display = '';
                });
            } else {
                allItems.forEach(function(item) {
                    var itemSection = parseInt(item.dataset.section);
                    if (itemSection === sectionId) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
        });
    });
});
</script>