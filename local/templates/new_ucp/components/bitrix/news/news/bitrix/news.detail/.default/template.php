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

$arGallery = array();
if (isset($arResult["PROPERTIES"]["GALLERY"]["VALUE"]) && is_array($arResult["PROPERTIES"]["GALLERY"]["VALUE"])) {
    foreach ($arResult["PROPERTIES"]["GALLERY"]["VALUE"] as $fileId) {
        $file = CFile::GetFileArray($fileId);
        if ($file) {
            $arGallery[] = $file;
        }
    }
}
$nextElement = null;
if (isset($arParams["NEXT_ELEMENT"]) && $arParams["NEXT_ELEMENT"] == "Y") {
    $rsNext = CIBlockElement::GetList(
        array("SORT" => "ASC", "ID" => "ASC"),
        array(
            "IBLOCK_ID" => $arResult["IBLOCK_ID"],
            "ACTIVE" => "Y",
            ">SORT" => $arResult["SORT"],
            "!ID" => $arResult["ID"]
        ),
        false,
        array("nTopCount" => 1),
        array("ID", "NAME", "DETAIL_PAGE_URL", "CODE")
    );
    if ($arNext = $rsNext->GetNext()) {
        $nextElement = $arNext;
    }
}

if (!$nextElement) {
    $rsNext = CIBlockElement::GetList(
        array("SORT" => "ASC", "ID" => "ASC"),
        array(
            "IBLOCK_ID" => $arResult["IBLOCK_ID"],
            "ACTIVE" => "Y",
            "!ID" => $arResult["ID"]
        ),
        false,
        array("nTopCount" => 1),
        array("ID", "NAME", "DETAIL_PAGE_URL", "CODE")
    );
    if ($arNext = $rsNext->GetNext()) {
        $nextElement = $arNext;
    }
}

$arResult["NEXT_ELEMENT"] = $nextElement;
?>

<main class="page">
    <div class="page__container">
        <nav class="page__sidebar">
            <ul class="page__banners">
                <li class="page__banners-item">
                    <a href="cart.html">
						<img src="/local/templates/new_ucp/assets/img/main/servicesBanner1.webp" alt="Image" title="Баннер 1">
                    </a>
                </li>
                <li class="page__banners-item">
                    <img src="/local/templates/new_ucp/assets/img/main/servicesBanner2.webp" alt="Image" title="Баннер 2">
                </li>
                <li class="page__banners-item">
                    <a href="cart.html">
                        <img src="/local/templates/new_ucp/assets/img/main/servicesBanner3.webp" alt="Image" title="Баннер 3">
                    </a>
                </li>
            
            </ul>
        </nav>
        <div class="page__content">
            <nav class="breadcrumbs">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item">
						<a href="/" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="breadcrumbs__item">
						<a href="/new/news/" class="breadcrumbs__link">Новости</a>
                    </li>
                    <li class="breadcrumbs__item">
                        <a href="#" class="breadcrumbs__link"><?php echo $arResult["NAME"]; ?></a>
                    </li>
                </ul>
            </nav>
            <div class="page__content-block">
                <div class="page__banner">
                    <?php if (is_array($arResult["DETAIL_PICTURE"])): ?>
                        <div class="page__banner-img">
                            <img src="<?php echo $arResult["DETAIL_PICTURE"]["SRC"]; ?>" alt="<?php echo $arResult["DETAIL_PICTURE"]["ALT"]; ?>" title="<?php echo $arResult["NAME"]; ?>">
                        </div>
                    <?php endif; ?>
                    <div class="page__banner-content">
                        <?php if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
                            <div class="date">
                                <iconify-icon icon="lsicon:calendar-outline" width="18" height="18" noobserver></iconify-icon>
                                <span><?php echo $arResult["DISPLAY_ACTIVE_FROM"]; ?></span>
                            </div>
                        <?php endif; ?>
                        <h1 class="title-two"><?php echo $arResult["NAME"]; ?></h1>
                    </div>
                </div>
                <div class="page__info">
                    <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && !empty($arResult["PREVIEW_TEXT"])): ?>
                        <p><strong><?php echo $arResult["PREVIEW_TEXT"]; ?></strong></p>
                    <?php endif; ?>

                    <?php if (!empty($arResult["PROPERTIES"]["VIDEO"]["VALUE"])): ?>
                        <div class="page__video">
                            <iframe src="<?php echo $arResult["PROPERTIES"]["VIDEO"]["VALUE"]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($arResult["DETAIL_TEXT"])): ?>
                        <div class="page__info-block">
                            <?php echo $arResult["DETAIL_TEXT"]; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($arResult["PROPERTIES"]["IMAGE_1"]["VALUE"])): ?>
                        <?php $img1 = CFile::GetFileArray($arResult["PROPERTIES"]["IMAGE_1"]["VALUE"]); ?>
                        <?php if ($img1): ?>
                            <a href="<?php echo $img1["SRC"]; ?>" class="page__info-img" data-fancybox="gallery">
                                <img src="<?php echo $img1["SRC"]; ?>" alt="Image" title="<?php echo $img1["DESCRIPTION"]; ?>">
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!empty($arResult["PROPERTIES"]["BLOCK_2"]["VALUE"]["TEXT"])): ?>
                        <div class="page__info-block">
                            <?php echo $arResult["PROPERTIES"]["BLOCK_2"]["VALUE"]["TEXT"]; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($arResult["PROPERTIES"]["IMAGE_2"]["VALUE"])): ?>
                        <?php $img2 = CFile::GetFileArray($arResult["PROPERTIES"]["IMAGE_2"]["VALUE"]); ?>
                        <?php if ($img2): ?>
                            <a href="<?php echo $img2["SRC"]; ?>" class="page__info-img" data-fancybox="gallery">
                                <img src="<?php echo $img2["SRC"]; ?>" alt="Image" title="<?php echo $img2["DESCRIPTION"]; ?>">
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>

            <?php if (!empty($arResult["PROPERTIES"]['MORE_PHOTO']['VALUE'])): ?>
    <?php 
    $arGallery = array();
    foreach ($arResult["PROPERTIES"]['MORE_PHOTO']['VALUE'] as $fileId) {
        $file = CFile::GetFileArray($fileId);
        if ($file) {
            $arGallery[] = $file;
        }
    }
    ?>
    <?php if (!empty($arGallery)): ?>
    <div class="page__image-slider">
        <div class="page__image-slider-main swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
            <div class="swiper-wrapper">
                <?php foreach ($arGallery as $file): ?>
                    <div class="swiper-slide">
                        <a href="<?php echo $file["SRC"]; ?>" class="page__image-slider-link" data-fancybox="gallery">
                            <img src="<?php echo $file["SRC"]; ?>" alt="image" title="<?php echo $file["DESCRIPTION"]; ?>">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="page__image-slider-action">
                <div class="page__image-slider-prev swiper-button-prev">
                    <iconify-icon icon="ep:arrow-left-bold" width="20" height="20" noobserver></iconify-icon>
                    <svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"></path></svg>
                </div>
                <div class="page__image-slider-next swiper-button-next">
                    <iconify-icon icon="ep:arrow-right-bold" width="20" height="20" noobserver></iconify-icon>
                    <svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"></path></svg>
                </div>
            </div>
        </div>
        <div class="page__image-slider-thumbs swiper swiper-initialized swiper-horizontal swiper-watch-progress swiper-backface-hidden swiper-thumbs">
            <div class="swiper-wrapper">
                <?php foreach ($arGallery as $file): ?>
                    <div class="swiper-slide">
                        <img src="<?php echo $file["SRC"]; ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php endif; ?>

                <?php if (!empty($arResult["PROPERTIES"]["HASHTAGS"]["VALUE"])): ?>
                    <ul class="hashtags">
                        <?php foreach ($arResult["PROPERTIES"]["HASHTAGS"]["VALUE"] as $hashtag): ?>
                            <li class="hashtags__item"><a href="#">#<?php echo htmlspecialcharsbx($hashtag); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
       <div class="page__action">
					<a href="/new/news/" class="button-blue _prev">
                        <iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver></iconify-icon>
                        <span>Ко всем новостям</span>
                    </a>

					<a href="<?php echo $arResult["NEXT_ELEMENT"]["DETAIL_PAGE_URL"]; ?>" class="button-blue _next">
                            <span>Следующая новость</span>
                            <iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
                        </a>

                </div>

            </div>
        </div>
    </div>
</main>