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
    true,
    array('ID', 'NAME', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID')
);
while ($arSection = $rsSections->GetNext()) {
    $arSections[] = $arSection;
}

function buildSectionsTree($sections, $parentId = 0) {
    $result = array();
    foreach ($sections as $section) {
        if ($section['IBLOCK_SECTION_ID'] == $parentId) {
            $children = buildSectionsTree($sections, $section['ID']);
            $section['CHILDREN'] = $children;
            $result[] = $section;
        }
    }
    return $result;
}

$sectionsTree = buildSectionsTree($arSections);

$selectedSections = array();
if (isset($_REQUEST['sections'])) {
    $selectedSections = explode(',', $_REQUEST['sections']);
    $selectedSections = array_filter($selectedSections, function($v) { return $v !== ''; });
}
$searchQuery = trim($_REQUEST['search'] ?? '');
$sort = $_REQUEST['sort'] ?? 'popular';
?>

<main class="page" id="services-page">
    <div class="page__container">
        <nav class="page__sidebar">
            <div class="page__sidebar-content" data-da=".page__sidebar-content-mobile,950, 1">
                <div class="page__sidebar-search-content">
                    <p>Быстрый поиск</p>
                    <div class="page__sidebar-search">
                        <div class="page__sidebar-search-input">
                            <form method="get" action="">
                                <button type="submit" class="page__sidebar-search-btn page__sidebar-search-btn--search">
                                    <div class="page__sidebar-search-btn-icon">
                                        <iconify-icon icon="lucide:search" width="100%" height="100%" noobserver></iconify-icon>
                                    </div>
                                </button>
                                <input type="text" name="search" placeholder="Введите запрос..." value="<?php echo htmlspecialchars($searchQuery); ?>" autocomplete="off">
                                <?php if (!empty($selectedSections)): ?>
                                    <input type="hidden" name="sections" value="<?php echo htmlspecialchars(implode(',', $selectedSections)); ?>">
                                <?php endif; ?>
                                <?php if ($sort != 'popular'): ?>
                                    <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort); ?>">
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="hashtags-header-mobile"></div>
                <div data-spollers class="spollers _spoller-init" id="filter-spollers">
                    <?php if (!empty($sectionsTree)): ?>
                        <?php foreach ($sectionsTree as $section): ?>
                            <details class="spollers__item" <?php echo $section['DEPTH_LEVEL'] == 1 ? 'data-open open' : ''; ?>>
                                <summary class="spollers__title <?php echo $section['DEPTH_LEVEL'] == 1 ? '_spoller-active' : ''; ?>">
                                    <?php echo $section['NAME']; ?>
                                </summary>
                                <div class="spollers__body">
                                    <ul>
                                        <?php if (!empty($section['CHILDREN'])): ?>
                                            <?php foreach ($section['CHILDREN'] as $child): ?>
                                                <li style="padding-left: 20px;">
                                                    <?php 
                                                    $newSections = $selectedSections;
                                                    if (in_array($child['ID'], $selectedSections)) {
                                                        $newSections = array_diff($newSections, array($child['ID']));
                                                    } else {
                                                        $newSections[] = $child['ID'];
                                                    }
                                                    $newSections = array_filter($newSections);
                                                    $sectionsParam = !empty($newSections) ? implode(',', $newSections) : '';
                                                    
                                                    $url = '?';
                                                    $params = array();
                                                    if (!empty($sectionsParam)) $params[] = 'sections=' . urlencode($sectionsParam);
                                                    if (!empty($searchQuery)) $params[] = 'search=' . urlencode($searchQuery);
                                                    if ($sort != 'popular') $params[] = 'sort=' . urlencode($sort);
                                                    $url .= implode('&', $params);
                                                    ?>
                                                    <a href="<?php echo $url; ?>">
                                                        <input type="checkbox" <?php echo in_array($child['ID'], $selectedSections) ? 'checked' : ''; ?>>
                                                        <span><?php echo $child['NAME']; ?></span>
                                                    </a>
                                                    <?php if (!empty($child['CHILDREN'])): ?>
                                                        <ul>
                                                            <?php foreach ($child['CHILDREN'] as $subchild): ?>
                                                                <li style="padding-left: 20px;">
                                                                    <?php 
                                                                    $newSections2 = $selectedSections;
                                                                    if (in_array($subchild['ID'], $selectedSections)) {
                                                                        $newSections2 = array_diff($newSections2, array($subchild['ID']));
                                                                    } else {
                                                                        $newSections2[] = $subchild['ID'];
                                                                    }
                                                                    $newSections2 = array_filter($newSections2);
                                                                    $sectionsParam2 = !empty($newSections2) ? implode(',', $newSections2) : '';
                                                                    
                                                                    $url2 = '?';
                                                                    $params2 = array();
                                                                    if (!empty($sectionsParam2)) $params2[] = 'sections=' . urlencode($sectionsParam2);
                                                                    if (!empty($searchQuery)) $params2[] = 'search=' . urlencode($searchQuery);
                                                                    if ($sort != 'popular') $params2[] = 'sort=' . urlencode($sort);
                                                                    $url2 .= implode('&', $params2);
                                                                    ?>
                                                                    <a href="<?php echo $url2; ?>">
                                                                        <input type="checkbox" <?php echo in_array($subchild['ID'], $selectedSections) ? 'checked' : ''; ?>>
                                                                        <span><?php echo $subchild['NAME']; ?></span>
                                                                    </a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li>
                                                <?php 
                                                $newSections = $selectedSections;
                                                if (in_array($section['ID'], $selectedSections)) {
                                                    $newSections = array_diff($newSections, array($section['ID']));
                                                } else {
                                                    $newSections[] = $section['ID'];
                                                }
                                                $newSections = array_filter($newSections);
                                                $sectionsParam = !empty($newSections) ? implode(',', $newSections) : '';
                                                
                                                $url = '?';
                                                $params = array();
                                                if (!empty($sectionsParam)) $params[] = 'sections=' . urlencode($sectionsParam);
                                                if (!empty($searchQuery)) $params[] = 'search=' . urlencode($searchQuery);
                                                if ($sort != 'popular') $params[] = 'sort=' . urlencode($sort);
                                                $url .= implode('&', $params);
                                                ?>
                                                <a href="<?php echo $url; ?>">
                                                    <input type="checkbox" <?php echo in_array($section['ID'], $selectedSections) ? 'checked' : ''; ?>>
                                                    <span><?php echo $section['NAME']; ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </details>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <details class="spollers__item" data-open open>
                            <summary class="spollers__title _spoller-active">Категории услуг</summary>
                            <div class="spollers__body">
                                <ul>
                                    <li>
                                        <a href="?<?php echo !empty($searchQuery) ? 'search=' . urlencode($searchQuery) : ''; ?><?php echo $sort != 'popular' ? '&sort=' . urlencode($sort) : ''; ?>">
                                            <span>Все услуги</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </details>
                    <?php endif; ?>
                </div>
            </div>
            <ul class="page__banners">
                <li class="page__banners-item">
                    <a href="cart.html">
                        <img src="/local/templates/new_ucp/assets/img/main/servicesBanner1.webp" alt="Image" title="Баннер 1">
                    </a>
                </li>
                <li class="page__banners-item">
                    <img src="/local/templates/new_ucp/assets/img/main/servicesBanner2.webp" alt="Image" title="Баннер 2">
                </li>
            </ul>
        </nav>
        <div class="page__content">
            <div class="page__content-header">
                <div class="title-block">
                    <h1 class="title-two">Услуги</h1>
                    <div class="sort__block" data-da=".sort-mobile,950, 1">
                        <div class="sort-dropdown">
                            <button type="button" class="button-sort">
                                <div class="icon">
                                    <iconify-icon icon="fluent:arrow-sort-16-regular" width="100%" height="100%" noobserver></iconify-icon>
                                </div>
                                <span>
                                    <?php
                                    $sortLabels = array(
                                        'popular' => 'По популярности',
                                        'name_asc' => 'По названию (А-Я)',
                                        'name_desc' => 'По названию (Я-А)',
                                        'new' => 'Сначала новые'
                                    );
                                    echo $sortLabels[$sort] ?? 'По популярности';
                                    ?>
                                </span>
                            </button>
                            <div class="sort__content">
                                <ul>
                                    <li><a href="?sections=<?php echo htmlspecialchars(implode(',', $selectedSections)); ?><?php echo !empty($searchQuery) ? '&search=' . urlencode($searchQuery) : ''; ?>&sort=popular">По популярности</a></li>
                                    <li><a href="?sections=<?php echo htmlspecialchars(implode(',', $selectedSections)); ?><?php echo !empty($searchQuery) ? '&search=' . urlencode($searchQuery) : ''; ?>&sort=name_asc">По названию (А-Я)</a></li>
                                    <li><a href="?sections=<?php echo htmlspecialchars(implode(',', $selectedSections)); ?><?php echo !empty($searchQuery) ? '&search=' . urlencode($searchQuery) : ''; ?>&sort=name_desc">По названию (Я-А)</a></li>
                                    <li><a href="?sections=<?php echo htmlspecialchars(implode(',', $selectedSections)); ?><?php echo !empty($searchQuery) ? '&search=' . urlencode($searchQuery) : ''; ?>&sort=new">Сначала новые</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="/" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="/new/uslugi/" class="breadcrumbs__link">Услуги</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="services__list-wrapper" id="services-list-wrapper">
                <ul class="services__list" id="services-list">
                    <?php 
                    $filter = array(
                        'IBLOCK_ID' => 79,
                        'ACTIVE' => 'Y',
                    );
                    
                    $selectedIds = array_filter($selectedSections);
                    if (!empty($selectedIds)) {
                        $filter['SECTION_ID'] = $selectedIds;
                        $filter['INCLUDE_SUBSECTIONS'] = 'Y';
                    }
                    
                    if (!empty($searchQuery)) {
                        $filter['%NAME'] = $searchQuery;
                    }
                    
                    switch ($sort) {
                        case 'popular':
                            $arSort = array('SORT' => 'ASC');
                            break;
                        case 'name_asc':
                            $arSort = array('NAME' => 'ASC');
                            break;
                        case 'name_desc':
                            $arSort = array('NAME' => 'DESC');
                            break;
                        case 'new':
                            $arSort = array('DATE_CREATE' => 'DESC');
                            break;
                        default:
                            $arSort = array('SORT' => 'ASC');
                    }
                    
                    $rsElements = CIBlockElement::GetList($arSort, $filter, false, false, array('ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL', 'PROPERTY_ICON', 'PROPERTY_STATUS', 'PROPERTY_HASHTAGS', 'PROPERTY_TEG'));
                    
                    while ($arItem = $rsElements->GetNext()):
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        
                        $imgSrc = "";
                        if (!empty($arItem['PREVIEW_PICTURE'])) {
                            $imgSrc = CFile::GetPath($arItem['PREVIEW_PICTURE']);
                        }
                        
                        $iconSrc = "";
                        if (!empty($arItem['PROPERTY_ICON_VALUE'])) {
                            $iconSrc = CFile::GetPath($arItem['PROPERTY_ICON_VALUE']);
                        }
                        
                        $badge = $arItem['PROPERTY_STATUS_VALUE'] ?? '';
                        
                        $hashtags = array();
                        if (!empty($arItem['PROPERTY_HASHTAGS_VALUE'])) {
                            if (is_array($arItem['PROPERTY_HASHTAGS_VALUE'])) {
                                $hashtags = $arItem['PROPERTY_HASHTAGS_VALUE'];
                            } else {
                                $hashtags = array($arItem['PROPERTY_HASHTAGS_VALUE']);
                            }
                        }
                        
                        $tegValue = $arItem['PROPERTY_TEG_VALUE'] ?? '';
                    ?>
                        <li class="services__list-item" id="<?php echo $this->GetEditAreaId($arItem['ID']); ?>">
                            <a href="<?php echo $arItem['DETAIL_PAGE_URL']; ?>" class="services__list-item-img">
                                <?php if (!empty($imgSrc)): ?>
                                    <img src="<?php echo $imgSrc; ?>" alt="<?php echo $arItem['NAME']; ?>" title="<?php echo $arItem['NAME']; ?>">
                                <?php endif; ?>
                                <div class="services__list-item-badge">
                                    <?php if (!empty($iconSrc)): ?>
                                        <div class="icon">
                                            <img src="<?php echo $iconSrc; ?>" alt="Image">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($badge)): ?>
                                        <div class="label"><?php echo $badge; ?></div>
                                    <?php endif; ?>
                                </div>
                            </a>
                            <div class="services__list-item-info">
                                <a href="<?php echo $arItem['DETAIL_PAGE_URL']; ?>" class="services__list-item-info-content">
                                    <h4><?php echo $arItem['NAME']; ?></h4>
                                    <?php if (!empty($arItem['PREVIEW_TEXT'])): ?>
                                        <p><?php echo $arItem['PREVIEW_TEXT']; ?></p>
                                    <?php endif; ?>
                                </a>
                                <?php if (!empty($hashtags)): ?>
                                    <ul class="hashtags">
                                        <?php foreach ($hashtags as $hashtag): ?>
                                            <li class="hashtags__item"><a href="#">#<?php echo htmlspecialcharsbx($hashtag); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                                <?php if (!empty($tegValue)): ?>
                                    <?php if (!is_array($tegValue)): ?>
                                        <?php $tegs = explode(',', $tegValue); ?>
                                    <?php else: ?>
                                        <?php $tegs = $tegValue; ?>
                                    <?php endif; ?>
                                    <ul class="hashtags">
                                        <?php foreach ($tegs as $teg): 
                                            $teg = trim($teg);
                                            if (!empty($teg)):
                                        ?>
                                            <li class="hashtags__item"><a href="#">#<?php echo htmlspecialcharsbx($teg); ?></a></li>
                                        <?php 
                                            endif;
                                        endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
</main>

<style>
.sort__content {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 8px 0;
    min-width: 200px;
    z-index: 100;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.sort__content.open {
    display: block;
}
.sort-dropdown {
    position: relative;
}
.sort__content ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.sort__content ul li {
    padding: 0;
}
.sort__content ul li a {
    display: block;
    padding: 8px 16px;
    text-decoration: none;
    color: #333;
    font-size: 14px;
    transition: background 0.2s;
}
.sort__content ul li a:hover {
    background: #f5f5f5;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var sortBtn = document.querySelector('.button-sort');
    var sortContent = document.querySelector('.sort__content');
    
    if (sortBtn && sortContent) {
        sortBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            sortContent.classList.toggle('open');
        });
    }
    
    document.addEventListener('click', function(e) {
        if (sortContent && !e.target.closest('.sort-dropdown')) {
            sortContent.classList.remove('open');
        }
    });
});
</script>