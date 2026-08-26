<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

$mainNews = [];
$regularNews = [];

foreach ($arResult["ITEMS"] as $arItem) {
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    if (count($mainNews) < 6) {
        $mainNews[] = $arItem;
    }
}


foreach ($arResult["ITEMS"] as $arItem) {
    if (count($regularNews) < 4) {
        $regularNews[] = $arItem;
    }
}
?>

<div class="home__feed-news">
    <div class="title-block">
        <h2 class="title-two"><a href="/news/">Новости</a></h2>
        <a href="/news/" class="button-all">
            <span>Все новости</span>
            <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
        </a>
    </div>
    <div class="home__feed-news-content">
        <div class="home__feed-news-slider swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
            <div class="swiper-wrapper">
                <?php if (!empty($mainNews)): ?>
                    <?php foreach ($mainNews as $arItem): ?>
                        <?php
                        $date = $arItem["DISPLAY_ACTIVE_FROM"] ?: $arItem["DISPLAY_DATE"];
                        if (empty($date)) {
                            $date = FormatDate("d.m.Y", MakeTimeStamp($arItem["DATE_CREATE"]));
                        }

                        $imgSrc = '';
                        if (!empty($arItem["PREVIEW_PICTURE"])) {
                            $imgSrc = $arItem["PREVIEW_PICTURE"]["SRC"];
                        } elseif (!empty($arItem["DETAIL_PICTURE"])) {
                            $imgSrc = $arItem["DETAIL_PICTURE"]["SRC"];
                        } else {
                            $imgSrc = SITE_TEMPLATE_PATH . '/img/main/news1.webp';
                        }

                        $itemLink = !empty($arItem["DETAIL_PAGE_URL"]) ? $arItem["DETAIL_PAGE_URL"] : '#';
                        $text = $arItem["DETAIL_TEXT"];
                        $firstParagraph = '';
                        if (preg_match('/<p[^>]*>(.*?)<\/p>/is', $text, $matches)) {
                            $firstParagraph = $matches[1];
                        } else {
                            $firstParagraph = explode("\n", $text)[0];
                        }
                        $previewText = strip_tags($firstParagraph);
                        if (mb_strlen($previewText) > 180) {
                            $previewText = mb_substr($previewText, 0, 180) . '...';
                        }
                        ?>
                        <div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                            <a href="<?= $itemLink ?>">
                                <div class="home__feed-news-slider-img">
                                    <img src="<?=$imgSrc ?>" alt="Image" title="<?= $arItem["NAME"] ?>">
                                    <div class="label">
                                        <span>Главная новость</span>
                                    </div>
                                </div>
                                <div class="home__feed-news-slider-info">
                                    <div class="date">
                                        <iconify-icon icon="lsicon:calendar-outline" width="18" height="18" noobserver></iconify-icon>
                                        <span><?= $date ?></span>
                                    </div>
                                    <h4 class="title-four"><?= $arItem["NAME"] ?></h4>
                                    <p class="text-caption"><?= $previewText ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="swiper-slide">
                        <a href="#">
                            <div class="home__feed-news-slider-img">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/main/news1.webp" alt="Image" title="Новости">
                                <div class="label">
                                    <span>Главная новость</span>
                                </div>
                            </div>
                            <div class="home__feed-news-slider-info">
                                <div class="date">
                                    <iconify-icon icon="lsicon:calendar-outline" width="18" height="18" noobserver></iconify-icon>
                                    <span><?= date("d.m.Y") ?></span>
                                </div>
                                <h4 class="title-four">Новостей пока нет</h4>
                                <p class="text-caption">Добавьте новости в инфоблок</p>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="home__feed-news-slider-action-mobile"></div>
            <div class="home__feed-news-slider-action" data-da=".home__feed-news-slider-action-mobile,1024, 1">
                <button class="home__feed-news-slider-button-prev swiper-button-prev">
                    <iconify-icon icon="lucide:chevron-left" width="30" height="30" noobserver></iconify-icon>
                </button>
                <div class="home__feed-news-slider-pagination"></div>
                <button class="home__feed-news-slider-button-next swiper-button-next">
                    <iconify-icon icon="lucide:chevron-right" width="30" height="30" noobserver></iconify-icon>
                </button>
            </div>
        </div>
        <div class="home__feed-news-latest">
            <nav class="home__feed-news-nav">
                <ul class="home__feed-news-nav-list">
                    <li class="home__feed-news-nav-item _active">
                        <a href="#">
                            <iconify-icon icon="streamline-plump:graduation-cap" width="24" height="24" noobserver></iconify-icon>
                            <p>Новости университета</p>
                        </a>
                    </li>
                    <li class="home__feed-news-nav-item">
                        <a href="#">
                            <iconify-icon icon="icon-park-outline:microscope-one" width="24" height="24" noobserver></iconify-icon>
                            <p>Наука и инновации</p>
                        </a>
                    </li>
                    <li class="home__feed-news-nav-item">
                        <a href="#">
                            <iconify-icon icon="lucide:shield-check" width="24" height="24" noobserver></iconify-icon>
                            <p>Безопасность жизнедеятельности</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <ul class="home__feed-news-list">
                <?php if (!empty($regularNews)): ?>
                    <?php foreach ($regularNews as $arItem): ?>
                        <?php
                        $date = $arItem["DISPLAY_ACTIVE_FROM"] ?: $arItem["DISPLAY_DATE"];
                        if (empty($date)) {
                            $date = FormatDate("d.m.Y", MakeTimeStamp($arItem["DATE_CREATE"]));
                        }
                        
                        $imgSrc = '';
                        if (!empty($arItem["PREVIEW_PICTURE"])) {
                            $imgSrc = $arItem["PREVIEW_PICTURE"]["SRC"];
                        } elseif (!empty($arItem["DETAIL_PICTURE"])) {
                            $imgSrc = $arItem["DETAIL_PICTURE"]["SRC"];
                        } else {
                            $imgSrc = SITE_TEMPLATE_PATH . '/img/main/news2.webp';
                        }
                        
                        $itemLink = !empty($arItem["DETAIL_PAGE_URL"]) ? $arItem["DETAIL_PAGE_URL"] : '#';
                        ?>
                        <li class="home__feed-news-item">
                            <a href="<?= $itemLink ?>">
                                <div class="home__feed-news-item-img">
                                    <img src="<?= $imgSrc ?>" alt="Image">
                                </div>
                                <div class="home__feed-news-info">
                                    <div class="date">
                                        <iconify-icon icon="lsicon:calendar-outline" width="18" height="18" noobserver></iconify-icon>
                                        <span><?= $date ?></span>
                                    </div>
                                    <p><?= $arItem["NAME"] ?></p>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="home__feed-news-item">
                        <a href="#">
                            <div class="home__feed-news-item-img">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/main/news2.webp" alt="Image">
                            </div>
                            <div class="home__feed-news-info">
                                <div class="date">
                                    <iconify-icon icon="lsicon:calendar-outline" width="18" height="18" noobserver></iconify-icon>
                                    <span><?= date("d.m.Y") ?></span>
                                </div>
                                <p>Новостей пока нет</p>
                            </div>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>