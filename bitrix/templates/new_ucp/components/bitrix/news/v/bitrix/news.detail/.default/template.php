<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<main class="page universities">
			<section class="preview universities__preview">
				<div class="preview-slider swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
					<div class="swiper-wrapper">
						<div class="swiper-slide swiper-slide-active" data-swiper-slide-index="0" style="width: 2028px; margin-right: 10px;">
							<div class="preview-slider-img-two">
								<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="Image" title="Превью">
							</div>
							<div class="preview__info">
								<div class="preview__container">
									<h1 class="title-one" data-da=".title-mobile,950, 1">
										<?=$arResult["NAME"]?>
									</h1>
									<nav class="breadcrumbs" data-da=".breadcrumbs-mobile,950, 1">
										<ul class="breadcrumbs__list">
											<li class="breadcrumbs__item">
												<a href="index.html" class="breadcrumbs__link">Главная</a>
											</li>
											<li class="breadcrumbs__item">
												<a href="#" class="breadcrumbs__link">НИИ ПБиПЧС УГЗ</a>
											</li>
										</ul>
									</nav>
								</div>
							</div>
						</div>
						<div class="swiper-slide swiper-slide-next" data-swiper-slide-index="1" style="width: 2028px; margin-right: 10px;">
							<div class="preview-slider-img-two">
								<img src="img/main/banner2.webp" alt="Image" title="Превью">
							</div>
							<div class="preview__info">
								<div class="preview__container">
									<h1 class="title-one" data-da=".title-mobile,950, 1">
										Научно-исследовательский институт пожарной безопасности и проблем
										чрезвычайных ситуаций Университета гражданской защиты
									</h1>
									<nav class="breadcrumbs" data-da=".breadcrumbs-mobile,950, 1">
										<ul class="breadcrumbs__list">
											<li class="breadcrumbs__item">
												<a href="index.html" class="breadcrumbs__link">Главная</a>
											</li>
											<li class="breadcrumbs__item">
												<a href="#" class="breadcrumbs__link">НИИ ПБиПЧС УГЗ</a>
											</li>
										</ul>
									</nav>
								</div>
							</div>
						</div>
						<div class="swiper-slide" data-swiper-slide-index="2" style="width: 2028px; margin-right: 10px;">
							<div class="preview-slider-img-two">
								<img src="img/main/banner2.webp" alt="Image" title="Превью">
							</div>
							<div class="preview__info">
								<div class="preview__container">
									<h1 class="title-one" data-da=".title-mobile,950, 1">
										Научно-исследовательский институт пожарной безопасности и проблем
										чрезвычайных ситуаций Университета гражданской защиты
									</h1>
									<nav class="breadcrumbs" data-da=".breadcrumbs-mobile,950, 1">
										<ul class="breadcrumbs__list">
											<li class="breadcrumbs__item">
												<a href="index.html" class="breadcrumbs__link">Главная</a>
											</li>
											<li class="breadcrumbs__item">
												<a href="#" class="breadcrumbs__link">НИИ ПБиПЧС УГЗ</a>
											</li>
										</ul>
									</nav>
								</div>
							</div>
						</div>
					</div>
					<div class="preview-slider-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
				</div>
			</section>
			<div class="universities__container">
				<nav class="page__sidebar">
					<div class="page__sidebar-content _event">
						<ul class="page__sidebar-event" data-da=".event-mobile,950, 1">
							<li class="page__sidebar-event-item"><a href="#">Руководство</a></li>
							<li class="page__sidebar-event-item"><a href="#">Об институте</a></li>
							<li class="page__sidebar-event-item">
								<a href="#">Научно-исследовательские центры и отделы</a>
							</li>
							<li class="page__sidebar-event-item"><a href="#">Услуги</a></li>
							<li class="page__sidebar-event-item">
								<a href="#">Орган по сертификации продукции</a>
							</li>
							<li class="page__sidebar-event-item"><a href="#">Разработки института</a></li>
							<li class="page__sidebar-event-item">
								<a href="#">ТНПА и НПА</a>
							</li>
							<li class="page__sidebar-event-item">
								<a href="#">Технический комитет ТК BY 35</a>
							</li>
							<li class="page__sidebar-event-item"><a href="#">Контактная информация</a></li>
						</ul>
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
						<li class="page__banners-item">
							<a href="cart.html">
								<img src="/dist/img/main/servicesBanner4.webp" alt="Image" title="Баннер 4">
							</a>
						</li>
						<li class="page__banners-item">
							<a href="cart.html">
								<img src="/dist/img/main/servicesBanner5.webp" alt="Image" title="Баннер 5">
							</a>
						</li>
					</ul>
				</nav>
				<div class="page__content">
					<div class="title-block">
						<h2 class="title-two">Новости</h2>
						<a href="/new/news/" class="button-all">
							<span>Все новости</span>
							<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
						</a>
					</div>
						<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"newsinstitut", 
	[
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "5",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/new/news/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => [
			0 => "",
			1 => "",
		],
		"LIST_PROPERTY_CODE" => [
			0 => "",
			1 => "",
		],
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => [
			0 => "",
			1 => "",
		],
		"DETAIL_PROPERTY_CODE" => [
			0 => "",
			1 => "",
		],
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SEF_URL_TEMPLATES" => [
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		]
	],
	false
);?>

						<section class="universities__info">
							<div class="universities__slider swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
								<div class="swiper-wrapper">
									<div class="swiper-slide _center swiper-slide-active" data-swiper-slide-index="0" style="width: 1182px; margin-right: 60px;">
										<div class="universities__slider-wrapper">
											<div class="universities__slider-img">
												<img src="img/main/universities.webp" alt="Image" title="Факультеты">
											</div>
											<div class="universities__slider-action">
												<button class="universities__slider-button-prev swiper-button-prev">
													<iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver=""></iconify-icon>
												<svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"></path></svg></button>
												<button class="universities__slider-button-next swiper-button-next">
													<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
												<svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"></path></svg></button>
											</div>
											<div class="universities__slider-slider-pagination"></div>
										</div>
										<div class="universities__slider-content">
											<div class="universities__slider-info">
												<h2 class="title-two">Виртуальная выставка</h2>
												<p>
													Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
													Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
													Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
													Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
													Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
												</p>
											</div>
										</div>
									</div>
									<div class="swiper-slide _center swiper-slide-next" data-swiper-slide-index="1" style="width: 1182px; margin-right: 60px;">
										<div class="universities__slider-wrapper">
											<div class="universities__slider-img">
												<img src="img/main/universities.webp" alt="Image" title="Факультеты">
											</div>
											<div class="universities__slider-action">
												<button class="universities__slider-button-prev swiper-button-prev">
													<iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver=""></iconify-icon>
												<svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"></path></svg></button>
												<button class="universities__slider-button-next swiper-button-next">
													<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
												<svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"></path></svg></button>
											</div>
											<div class="universities__slider-slider-pagination"></div>
										</div>
										<div class="universities__slider-content">
											<div class="universities__slider-info">
												<h2 class="title-two">Виртуальная выставка</h2>
												<p>
													Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
													Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
													Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
													Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
													Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>

						<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"institutuslugi", 
	[
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => [
			0 => "",
			1 => "",
		],
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => [
			0 => "",
			1 => "",
		],
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "79",
		"IBLOCK_TYPE" => "education",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => [
			0 => "",
			1 => "",
		],
		"LIST_PROPERTY_CODE" => [
			0 => "ST",
			1 => "TEG",
			2 => "favorites",
			3 => "POPULAR",
			4 => "ELEMENTS_IN_ROW",
			5 => "DISTACE",
			6 => "SLIDING_ANIMATION",
			7 => "OPEN_ANIMATION",
			8 => "SPEED_ANIMATION",
			9 => "",
		],
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "institutuslugi",
		"VARIABLE_ALIASES" => [
			"SECTION_ID" => "SECTION_ID",
			"ELEMENT_ID" => "ELEMENT_ID",
		]
	],
	false
);?>
						</section>

						<section class="universities__news">
							<div class="news__slider swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
								<div class="swiper-wrapper">
									<div class="swiper-slide swiper-slide-active" data-swiper-slide-index="0" style="width: 3.35544e+07px; margin-right: 60px;">
										<div class="news__slider-content">
											<div class="news__slider-info">
												<h2 class="title-two">
													<a href="#">Проект к Году белорусской женщины: «Женщины МЧС. Профессия
														добрых дел»</a>
												</h2>
												<p class="text">
													В Год белорусской женщины мы продолжаем проект «Женщины МЧС.
													Профессия добрых дел», чтобы рассказать о тех, кто ежедневно
													доказывает, что в суровом мире чрезвычайных ситуаций, где
													ценятся секунды и решительность, женское участие привносит
													особую созидательную энергию, ведь там, где речь идет о
													безопасности людей, нет «мужских» или «женских» профессий – есть
													призвание, ответственность и бесконечная готовность служить
													родной стране.&nbsp;
												</p>
												<a href="#" class="button-detail">
													<span>Подробне</span>
													<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
												</a>
											</div>
										</div>
										<div class="news__slider-wrapper">
											<a href="#" class="news__slider-img">
												<img src="img/main/newsRecent6.webp" alt="Image" title="Проект к Году белорусской женщины: «Женщины МЧС. Профессия добрых дел»">
											</a>
											<div class="news__slider-action">
												<button class="news__slider-button-prev swiper-button-prev">
													<iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver=""></iconify-icon>
												<svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"></path></svg></button>
												<button class="news__slider-button-next swiper-button-next">
													<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
												<svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"></path></svg></button>
											</div>
										</div>
									</div>
									<div class="swiper-slide swiper-slide-next" data-swiper-slide-index="1" style="width: 3.35544e+07px; margin-right: 60px;">
										<div class="news__slider-wrapper">
											<a href="#" class="news__slider-img">
												<img src="img/main/newsRecent6.webp" alt="Image" title="Проект к Году белорусской женщины: «Женщины МЧС. Профессия добрых дел»">
											</a>
											<div class="news__slider-action">
												<button class="news__slider-button-prev swiper-button-prev">
													<iconify-icon icon="lucide:chevron-left" width="24" height="24" noobserver=""></iconify-icon>
												<svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"></path></svg></button>
												<button class="news__slider-button-next swiper-button-next">
													<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
												<svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"></path></svg></button>
											</div>
										</div>
										<div class="news__slider-content">
											<div class="news__slider-info">
												<h2 class="title-two">
													<a href="#">Проект к Году белорусской женщины: «Женщины МЧС. Профессия
														добрых дел»</a>
												</h2>
												<p class="text">
													В Год белорусской женщины мы продолжаем проект «Женщины МЧС.
													Профессия добрых дел», чтобы рассказать о тех, кто ежедневно
													доказывает, что в суровом мире чрезвычайных ситуаций, где
													ценятся секунды и решительность, женское участие привносит
													особую созидательную энергию, ведь там, где речь идет о
													безопасности людей, нет «мужских» или «женских» профессий – есть
													призвание, ответственность и бесконечная готовность служить
													родной стране.&nbsp;
												</p>
												<a href="#" class="button-detail">
													<span>Подробне</span>
													<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="news__recent-content">
								<a href="news.html" class="button-all">
									<span>Все проекты</span>
									<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver=""></iconify-icon>
								</a>
								<ul class="news__recent">
									<li class="news__recent-item">
										<a href="">
											<img src="/dist/img/main/newsRecent1.webp" alt="Image" title="Электронный журнал UCP LIVE">
											<p>Электронный журнал UCP LIVE</p>
										</a>
									</li>
									<li class="news__recent-item">
										<a href="">
											<img src="/dist/img/main/newsRecent2.webp" alt="Image" title="Жизнь посвященная службе">
											<p>Жизнь посвященная службе</p>
										</a>
									</li>
									<li class="news__recent-item">
										<a href="">
											<img src="/dist/img/main/newsRecent3.webp" alt="Image" title="Инновации в мире науки">
											<p>Инновации в мире науки</p>
										</a>
									</li>
									<li class="news__recent-item">
										<a href="#">
											<img src="/dist/img/main/newsRecent4.webp" alt="Image" title="Инновации в мире науки">
											<p>Инновации в мире науки</p>
										</a>
									</li>
									<li class="news__recent-item">
										<a href="#">
											<img src="/dist/img/main/newsRecent5.webp" alt="Image" title="Инновации в мире науки">
											<p>Инновации в мире науки</p>
										</a>
									</li>
								</ul>
							</div>
						</section>
					</div>
				</div>
			</div>
		</main>





<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && ($arResult["FIELDS"]["PREVIEW_TEXT"] ?? '')):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif($arResult["DETAIL_TEXT"] <> ''):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?><br />
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>