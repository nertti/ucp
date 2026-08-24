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
    array('IBLOCK_ID' => 2, 'ACTIVE' => 'Y'),
    false,
    array('ID', 'NAME')
);
while ($arSection = $rsSections->GetNext()) {
    $arSections[] = $arSection;
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<main class="page">
    <div class="page__container">
        <nav class="page__sidebar">
            <div class="page__sidebar-content" data-da=".page__sidebar-content-mobile,950,1">
                <div class="page__sidebar-search-content">
                    <p>Быстрый поиск</p>
                    <div class="page__sidebar-search">
                        <div class="page__sidebar-search-input">
                            <button class="page__sidebar-search-btn page__sidebar-search-btn--search" id="search-btn">
                                <div class="page__sidebar-search-btn-icon">
                                    <iconify-icon icon="lucide:search" width="100%" height="100%" noobserver></iconify-icon>
                                </div>
                            </button>
                            <input type="text" id="search-input" placeholder="Введите запрос..." autocomplete="off">
                            <button class="page__sidebar-search-btn page__sidebar-search-btn--clear" id="search-clear" style="display:none;">
                                <div class="page__sidebar-search-btn-icon">
                                    <iconify-icon icon="lucide:x" width="100%" height="100%" noobserver></iconify-icon>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div data-spollers class="spollers _spoller-init">
                    <details class="spollers__item" data-open open>
                        <summary class="spollers__title _spoller-active">Категории новостей</summary>
                        <div class="spollers__body">
                            <ul>
                                <li>
                                    <a href="#" class="section-link" data-section="0" data-all="1">
                                        <span>Все новости</span>
                                    </a>
                                </li>
                                <?php foreach ($arSections as $arSection): ?>
                                    <li>
                                        <a href="#" class="section-link" data-section="<?php echo $arSection['ID']; ?>">
                                            <span><?php echo $arSection['NAME']; ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </details>
                    
                </div>
            </div>
            <ul class="page__banners">
                <li class="page__banners-item">
                    <a href="cart.html">
                        <img src="/dist/img/main/servicesBanner1.webp" alt="Image" title="Баннер 1">
                    </a>
                </li>
                <li class="page__banners-item">
                    <img src="/dist/img/main/servicesBanner2.webp" alt="Image" title="Баннер 2">
                </li>
                <li class="page__banners-item">
                    <a href="cart.html">
                        <img src="/dist/img/main/servicesBanner3.webp" alt="Image" title="Баннер 3">
                    </a>
                </li>
            </ul>
        </nav>
        <div class="page__content">
            <div class="page__content-header">
                <div class="title-block">
                    <h1 class="title-two">Новости</h1>
                    <a href="#" class="button-rss" data-da=".button-rss__mobile,950,1">
                        <iconify-icon icon="line-md:rss" width="24" height="24" noobserver></iconify-icon>
                        <span>RSS</span>
                    </a>
                </div>
                <nav class="breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="index.html" class="breadcrumbs__link">Главная</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="#" class="breadcrumbs__link">Новости</a>
                        </li>
                    </ul>
                </nav>
                <div class="page__mobile-action">
                    <button type="button" class="button-filter">
                        <div class="icon">
                            <iconify-icon icon="iconoir:filter" width="100%" height="100%" noobserver></iconify-icon>
                        </div>
                        <span>Фильтр</span>
                    </button>
                    <div class="button-rss__mobile"></div>
                    <div class="page__mobile-filter">
                        <div class="page__mobile-filter-header">
                            <h4 class="title-four">Фильтр</h4>
                            <button class="filter-close" data-close>
                                <iconify-icon icon="lucide:x" width="24" height="24" noobserver></iconify-icon>
                            </button>
                        </div>
                        <div class="page__mobile-filter-content">
                            <form action="#">
                                <div class="page__sidebar-content-mobile"></div>
                                <div class="page__mobile-filter-action">
                                    <button type="button" class="button-result" data-close>
                                        <span>Показать результат</span>
                                        <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="news__list-wrapper" id="news-list-wrapper">
                <ul class="news__list" id="news-list">
                    <?php foreach ($arResult["ITEMS"] as $arItem): ?>

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
                        
                        $iconSrc = "";
                        if (!empty($arItem["PROPERTIES"]["ICON"]["VALUE"])) {
                            $iconSrc = $arItem["PROPERTIES"]["ICON"]["VALUE"];
                        }
                        
                        $hashtags = array();
                        if (!empty($arItem["PROPERTIES"]["HASHTAGS"]["VALUE"])) {
                            if (is_array($arItem["PROPERTIES"]["HASHTAGS"]["VALUE"])) {
                                $hashtags = $arItem["PROPERTIES"]["HASHTAGS"]["VALUE"];
                            } else {
                                $hashtags = array($arItem["PROPERTIES"]["HASHTAGS"]["VALUE"]);
                            }
                        }
                        
                        $tegValue = '';
                        if (!empty($arItem["PROPERTIES"]["TEG"]["VALUE"])) {
                            $tegValue = $arItem["PROPERTIES"]["TEG"]["VALUE"];
                        }
                        ?>
                        <li class="news__list-item" id="<?php echo $this->GetEditAreaId($arItem['ID']); ?>">
                            <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>" class="news__list-item-img">
                                <?php if (!empty($imgSrc)): ?>
                                    <img src="<?php echo $imgSrc; ?>" alt="<?php echo $arItem["PREVIEW_PICTURE"]["ALT"]; ?>" title="<?php echo $arItem["PREVIEW_PICTURE"]["TITLE"]; ?>">
                                <?php endif; ?>
                                <?php if ($arItem["PROPERTIES"]["ST"]["VALUE"] == "Видео"): ?>
                                    <div class="icon">
                                        <img src="/dist/img/icons/news/icon2.svg" alt="Image">
                                    </div>
                                <?php endif; ?>
                                <?php if ($arItem["PROPERTIES"]["ST"]["VALUE"] == "Статья"): ?>
                                    <div class="icon">
                                        <img src="/dist/img/icons/news/icon1.svg" alt="Image">
                                    </div>
                                <?php endif; ?>
                                <?php if ($arItem["PROPERTIES"]["ST"]["VALUE"] == "Фото"): ?>
                                    <div class="icon">
                                        <img src="/dist/img/icons/news/icon3.svg" alt="Image">
                                    </div>
                                <?php endif; ?>
                            </a>
                            <div class="news__list-item-info">
                                <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>" class="news__list-item-info-content">
                                    <div class="date">
                                        <iconify-icon icon="lsicon:calendar-outline" width="18" height="18" noobserver></iconify-icon>
                                        <span><?php echo $date; ?></span>
                                    </div>
                                    <h5><?php echo $arItem["NAME"]; ?></h5>
                                    <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && !empty($arItem["PREVIEW_TEXT"])): ?>
                                        <p>
                                            <?php 
                                            $previewText = strip_tags($arItem["PREVIEW_TEXT"]);
                                            if (mb_strlen($previewText) > 150) {
                                                $previewText = mb_substr($previewText, 0, 150) . '...';
                                            }
                                            echo $previewText;
                                            ?>
                                        </p>
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
                    <?php endforeach; ?>
                </ul>
                <?php if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                    <nav class="pagination__nav" aria-label="Навигация по страницам">
                        <?php echo $arResult["NAV_STRING"]; ?>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {

    $('.section-link').on('click', function(e) {
        e.preventDefault();
        
        var sectionId = $(this).data('section');
        var isAll = $(this).data('all') || 0;
        

        $('.section-link').removeClass('checked');
        $(this).addClass('checked');


        var searchQuery = $('#search-input').val().trim();
        

        $('#news-list-wrapper').addClass('loading');
        

        $.ajax({
            url: '/ajax_news.php',
            type: 'GET',
            data: {
                ajax: 'Y',
                search: searchQuery,
                section: sectionId
            },
            dataType: 'json',
            success: function(response) {
                $('#news-list-wrapper').removeClass('loading');
                if (response.html) {
                    $('#news-list').html(response.html);
                }
            },
            error: function() {
                $('#news-list-wrapper').removeClass('loading');
                alert('Ошибка загрузки');
            }
        });
    });

    var searchTimeout;
    $('#search-input').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            var searchQuery = $('#search-input').val().trim();
            var activeSection = $('.section-link.checked').data('section') || 0;
            
            $('#news-list-wrapper').addClass('loading');
            
            $.ajax({
                url: '/ajax_news.php',
                type: 'GET',
                data: {
                    ajax: 'Y',
                    search: searchQuery,
                    section: activeSection
                },
                dataType: 'json',
                success: function(response) {
                    $('#news-list-wrapper').removeClass('loading');
                    if (response.html) {
                        $('#news-list').html(response.html);
                    }
                },
                error: function() {
                    $('#news-list-wrapper').removeClass('loading');
                }
            });
        }, 300);
    });

    $('#search-btn').on('click', function(e) {
        e.preventDefault();
        $('#search-input').trigger('input');
    });

    $('#search-clear').on('click', function() {
        $('#search-input').val('').trigger('input');
        $(this).hide();
    });

    $('#search-input').on('input', function() {
        if ($(this).val().length > 0) {
            $('#search-clear').show();
        } else {
            $('#search-clear').hide();
        }
    });
    

    $('.section-link[data-all="1"]').addClass('checked');
});
</script>

