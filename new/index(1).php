<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Университет гражданской защиты");
?>


<?php
$APPLICATION->IncludeComponent(
"bitrix:news.list",
"banner_slider",
[
"IBLOCK_ID" => 2,
"NEWS_COUNT" => 5,
"SORT_BY1" => "SORT",
"SORT_ORDER1" => "ASC",
"CACHE_TYPE" => "A",
"CACHE_TIME" => "3600"
],
false
);
?>


<div class="home__wrapper">
<nav class="home__subnav">
<?php
$APPLICATION->IncludeComponent(
"bitrix:menu",
"subnav",
[
"ROOT_MENU_TYPE" => "subnav",
"CHILD_MENU_TYPE" => "subnav",
"MENU_CACHE_TYPE" => "A",
"MENU_CACHE_TIME" => "3600",
"MAX_LEVEL" => "1"
]
);
?>
</nav>

<div class="home__content">
<section class="home__feed">
<div class="home__container">
<nav class="home__feed-nav">
<ul class="home__feed-nav-list">
<li class="home__feed-nav-item _one">
<a href="#">
<img src="/dist/img/icons/feedLogo1.svg" alt="Image" />
<p>Образовательная платформа</p>
</a>
</li>
<li class="home__feed-nav-item _two">
<a href="#">
<img src="/dist/img/icons/feedLogo2.svg" alt="Image" />
<p>Абитуриенту</p>
</a>
</li>
<li class="home__feed-nav-item _three">
<a href="#">
<img src="/dist/img/icons/feedLogo3.svg" alt="Image" />
<p>UCPExport и IRTCenter</p>
</a>
</li>
<li class="home__feed-nav-item _four">
<a href="#">
<img src="/dist/img/icons/feedLogo4.svg" alt="Image" />
<p>Программы обучения</p>
</a>
</li>
<li class="home__feed-nav-item _five">
<a href="#">
<img src="/dist/img/icons/feedLogo5.svg" alt="Image" />
<p>Культура безопасности</p>
</a>
</li>
<li class="home__feed-nav-item _six">
<a href="#">
<img src="/dist/img/icons/feedLogo6.svg" alt="Image" />
<p>Медиацентр</p>
</a>
</li>
<li class="home__feed-nav-item _seven">
<a href="#">
<img src="/dist/img/icons/feedLogo7.svg" alt="Image" />
<p>Молния</p>
</a>
</li>
<li class="home__feed-nav-item _eight">
<a href="#">
<img src="/dist/img/icons/feedLogo8.svg" alt="Image" />
<p>Испытательная деятельность</p>
</a>
</li>
</ul>
</nav>

<div class="home__feed-content">
<div class="home__feed-news">
<div class="title-block">
<h2 class="title-two"><a href="/news/">Новости</a></h2>
<a href="/news/" class="button-all">
<span>Все новости</span>
<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
</a>
</div>


<?php
$APPLICATION->IncludeComponent(
"bitrix:news.list",
"main_slider",
[
"IBLOCK_ID" => 2,
"NEWS_COUNT" => 6,
"SORT_BY1" => "ACTIVE_FROM",
"SORT_ORDER1" => "DESC",
"PROPERTY_CODE" => ["IS_MAIN"],
"FILTER_NAME" => "arFilterMainNews",
"FIELD_CODE" => ["PREVIEW_TEXT", "DETAIL_TEXT", "DATE_ACTIVE_FROM"],
"CACHE_TYPE" => "A",
"CACHE_TIME" => "3600"
],
false
);
?>


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
<?php
$APPLICATION->IncludeComponent(
"bitrix:news.list",
"latest_news",
[
"IBLOCK_ID" => 2,
"NEWS_COUNT" => 4,
"SORT_BY1" => "ACTIVE_FROM",
"SORT_ORDER1" => "DESC",
"FIELD_CODE" => ["PREVIEW_TEXT", "DATE_ACTIVE_FROM"],
"CACHE_TYPE" => "A",
"CACHE_TIME" => "3600"
],
false
);
?>
</ul>
</div>
</div>
</div>

<div class="home__feed-event">
<div class="title-block">
<h3 class="title-three"><a href="#">События</a></h3>
<a href="#" class="button-all">
<span>Все события</span>
<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
</a>
</div>
<ul class="home__feed-event-list">
<?php
$APPLICATION->IncludeComponent(
"bitrix:news.list",
"events_list",
[
"IBLOCK_ID" => 3,
"NEWS_COUNT" => 4,
"SORT_BY1" => "ACTIVE_FROM",
"SORT_ORDER1" => "ASC",
"FIELD_CODE" => ["NAME", "PREVIEW_TEXT", "DATE_ACTIVE_FROM"],
"CACHE_TYPE" => "A",
"CACHE_TIME" => "3600"
],
false
);
?>
</ul>
</div>
</div>
</div>
</section>

<section class="home__about">
<div class="home__container">
<ul class="home__about-list" data-watch>
<li class="home__about-list-item">
<div class="counters-block">
<div data-digits-counter class="counters__item">110000</div>
<span>+</span>
</div>
<p>Выпускников</p>
</li>
<li class="home__about-list-item">
<div class="counters-block">
<div data-digits-counter class="counters__item">5000</div>
<span>+</span>
</div>
<p>Ежегодный выпуск</p>
</li>
<li class="home__about-list-item">
<div class="counters-block">
<div data-digits-counter class="counters__item">1500</div>
<span>+</span>
</div>
<p>Обучается по специальностям</p>
</li>
<li class="home__about-list-item">
<div class="counters-block">
<div data-digits-counter class="counters__item">90</div>
<span>+</span>
</div>
<p>Лет опыта</p>
</li>
<li class="home__about-list-item">
<div class="counters-block">
<div data-digits-counter class="counters__item">80</div>
<span>+</span>
</div>
<p>Стран мира</p>
</li>
</ul>
</div>
</section>


<?php
$APPLICATION->IncludeComponent(
"bitrix:news.list",
"faculties_slider",
[
"IBLOCK_ID" => 8,
"NEWS_COUNT" => 10,
"SORT_BY1" => "SORT",
"SORT_ORDER1" => "ASC",
"CACHE_TYPE" => "A",
"CACHE_TIME" => "3600"
],
false
);
?>


<?php
$APPLICATION->IncludeComponent(
"bitrix:news.list",
"branches_slider",
[
"IBLOCK_ID" => 2,
"NEWS_COUNT" => 10,
"SORT_BY1" => "SORT",
"SORT_ORDER1" => "ASC",
"CACHE_TYPE" => "A",
"CACHE_TIME" => "3600"
],
false
);
?>


<ul class="services__main-list">
<?php
$APPLICATION->IncludeComponent(
"bitrix:news.list",
"services_list",
[
"IBLOCK_ID" => 6,
"NEWS_COUNT" => 5,
"SORT_BY1" => "SORT",
"SORT_ORDER1" => "ASC",
"PROPERTY_CODE" => ["IS_POPULAR", "IS_RECOMMENDED"],
"FIELD_CODE" => ["NAME", "PREVIEW_TEXT"],
"CACHE_TYPE" => "A",
"CACHE_TIME" => "3600"
],
false
);
?>
</ul>
</div>
</section>

<section class="home__news">
<div class="home__container">
<div class="news__slider swiper">
<div class="swiper-wrapper">
<?php
$APPLICATION->IncludeComponent(
"bitrix:news.list",
"project_slider",
[
"IBLOCK_ID" => 7,
"NEWS_COUNT" => 3,
"SORT_BY1" => "ACTIVE_FROM",
"SORT_ORDER1" => "DESC",
"FIELD_CODE" => ["NAME", "PREVIEW_TEXT", "DETAIL_TEXT"],
"CACHE_TYPE" => "A",
"CACHE_TIME" => "3600"
],
false
);
?>
</div>
</div>

<div class="news__recent-content">
<a href="/news/" class="button-all">
<span>Все проекты</span>
<iconify-icon icon="lucide:chevron-right" width="24" height="24" noobserver></iconify-icon>
</a>
<ul class="news__recent">
<?php
$APPLICATION->IncludeComponent(
"bitrix:news.list",
"projects_list",
[
"IBLOCK_ID" => 2,
"NEWS_COUNT" => 5,
"SORT_BY1" => "SORT",
"SORT_ORDER1" => "ASC",
"FIELD_CODE" => ["NAME"],
"CACHE_TYPE" => "A",
"CACHE_TIME" => "3600"
],
false
);
?>
</ul>
</div>
</div>
</section>
</div>
</div>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>