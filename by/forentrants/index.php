<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Университет  МЧС Беларуси");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"news",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("ID",""),
		"FILE_404" => "",
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MEDIA_PROPERTY" => "",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK" => "",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"PAGER_DESC_NUMBERING" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_PARAMS_NAME" => "arrPager",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "3",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("","DESCRIPTION",""),
		"SEARCH_PAGE" => "/search/",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "Y",
		"SLIDER_PROPERTY" => "",
		"SORT_BY1" => "PROPERTY_favorites",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"TEMPLATE_THEME" => "blue",
		"USE_RATING" => "N",
		"USE_SHARE" => "N"
	)
);?>
<div class="news-popular">
	<h2>Популярное</h2>

	<div class="bx-newslist-container" >
		<div class="bx-newslist-block">
				<div class="date">
					<div class="bx-newslist-date">13.02.2017, </div>
				</div>
				<div class="cat">
					<div class="bx-newslist-date"><a href="/">Новости университета</a></div>
				</div>
				<h3 class="bx-newslist-title">
						<a href="/">Институт удостоен Премии Правительства Республики Беларусь за достижения в области качества…</a>
				</h3>		 								
		</div>
	</div>
	
	<div class="bx-newslist-container" >
		<div class="bx-newslist-block">
				<div class="date">
					<div class="bx-newslist-date">02.02.2017, </div>
				</div>
				<div class="cat">
					<div class="bx-newslist-date"><a href="/">Здоровье</a></div>
				</div>
				<h3 class="bx-newslist-title">
						<a href="/">Мой стиль жизни сегодня - мое здоровье и успех завтра!</a>
				</h3>		 								
		</div>
	</div>
	
	<div class="bx-newslist-container" >
		<div class="bx-newslist-block">
				<div class="date">
					<div class="bx-newslist-date">25.01.2017, </div>
				</div>
				<div class="cat">
					<div class="bx-newslist-date"><a href="/">Здоровье</a></div>
				</div>
				<h3 class="bx-newslist-title">
						<a href="/">Мой стиль жизни сегодня - мое здоровье и успех завтра!</a>
				</h3>		 								
		</div>
	</div>
	
	<div class="bx-newslist-container" >
		<div class="bx-newslist-block">
				<div class="date">
					<div class="bx-newslist-date">22.01.2017, </div>
				</div>
				<div class="cat">
					<div class="bx-newslist-date"><a href="/">Здоровье</a></div>
				</div>
				<h3 class="bx-newslist-title">
						<a href="/">День единения народов Беларуси и России</a>
				</h3>		 								
		</div>
	</div>
	
	<div class="bx-newslist-container" >
		<div class="bx-newslist-block">
				<div class="date">
					<div class="bx-newslist-date">20.01.2017, </div>
				</div>
				<div class="cat">
					<div class="bx-newslist-date"><a href="/">Здоровье</a></div>
				</div>
				<h3 class="bx-newslist-title">
						<a href="/">Институт удостоен Премии Правительства Республики Беларусь за достижения в области</a>
				</h3>		 								
		</div>
	</div>
	
	<div class="bx-newslist-container" >
		<div class="bx-newslist-block">
				<div class="date">
					<div class="bx-newslist-date">17.01.2017, </div>
				</div>
				<div class="cat">
					<div class="bx-newslist-date"><a href="/">Здоровье</a></div>
				</div>
				<h3 class="bx-newslist-title">
						<a href="/">День единения народов Беларуси и России</a>
				</h3>		 								
		</div>
	</div>
</div>
<div class="tabs-block pictures">
	<ul class="nav nav-tabs" role="tablist">
	  <li role="presentation"><a href="#ippk" aria-controls="profile" role="tab" data-toggle="tab">Филиал (ИППК)</a></li>
	  <li role="presentation"><a href="#gomel" aria-controls="profile" role="tab" data-toggle="tab">Филиал (г.Гомель)</a></li>
	  <li role="presentation"><a href="#faculties" aria-controls="profile" role="tab" data-toggle="tab">Факультеты</a></li>
	  <li role="presentation" class="active"><a href="#departments" aria-controls="profile" role="tab" data-toggle="tab">Кафедры</a></li>
	  <li role="presentation"><a href="#otdely" aria-controls="profile" role="tab" data-toggle="tab">Отделы</a></li>
	  <li role="presentation"><a href="#upasch" aria-controls="profile" role="tab" data-toggle="tab">УПАСЧ</a></li>
	  <li role="presentation"><a href="#tskpp" aria-controls="profile" role="tab" data-toggle="tab">ЦКПП</a></li>
	</ul>
	
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane" id="ippk">12345</div>
		<div role="tabpanel" class="tab-pane" id="gomel">32423</div>
		<div role="tabpanel" class="tab-pane" id="faculties">434234</div>
		<div role="tabpanel" class="tab-pane active" id="departments">
			<h2>Университет</h2>
			<a href="#" class="col-lg-3">
				<img class="thumb" src="/images/univ/univ-1.jpg"	/>
			</a>
			<a href="#" class="col-lg-3">
				<img src="/images/univ/univ-2.jpg"	/>
			</a>
			<a href="#" class="col-lg-3">
				<img src="/images/univ/univ-3.jpg"	/>
			</a>
			<a href="#" class="col-lg-3">
				<img src="/images/univ/univ-4.jpg"	/>
			</a>	
			<a href="#" class="col-lg-3">
				<img src="/images/univ/univ-4.jpg"	/>
			</a>	
			<a href="#" class="col-lg-3">
				<img src="/images/univ/univ-4.jpg"	/>
			</a>	
			<a href="#" class="col-lg-3">
				<img src="/images/univ/univ-4.jpg"	/>
			</a>	
			<a href="#" class="col-lg-3">
				<img src="/images/univ/univ-4.jpg"	/>
			</a>	
			<a href="#" class="col-lg-3">
				<img src="/images/univ/univ-4.jpg"	/>
			</a>	
			<a href="#" class="col-lg-3">
				<img src="/images/univ/univ-4.jpg"	/>
			</a>	
			
			
		</div>
		<div role="tabpanel" class="tab-pane" id="otdely">.33344444www</div>
		<div role="tabpanel" class="tab-pane" id="upasch">fgggggggg</div>
		<div role="tabpanel" class="tab-pane" id="tskpp">jjjjjjjjjjjj</div>
	</div>
</div>
<div class="right-col">
	<div class="news-mchs">
		<h2>Новости МЧС Беларуси</h2>
		<div class="bx-newslist-container" >
			<div class="bx-newslist-block">
					<div class="date">
						<div class="bx-newslist-date">13.02.2017</div>
					</div>
					<h3 class="bx-newslist-title">
							<a href="/">В Светлогорске мужчина пострадал при попытке самостоятельно потушитьпожар...</a>
					</h3>		 								
			</div>
		</div>
		<div class="bx-newslist-container" >
			<div class="bx-newslist-block">
					<div class="date">
						<div class="bx-newslist-date">13.02.2017</div>
					</div>
					<h3 class="bx-newslist-title">
							<a href="/">В Мозыре спасатели деблокировали пострадавшую в ДТП женщину</a>
					</h3>		 								
			</div>
		</div>
		<div class="bx-newslist-container" >
			<div class="bx-newslist-block">
					<div class="date">
						<div class="bx-newslist-date">13.02.2017</div>
					</div>
					<h3 class="bx-newslist-title">
							<a href="/">Пожарная колонча в Гродно превратится в ...</a>
					</h3>		 								
			</div>
		</div>
		<a href="http://mchs.gov.by/rus/main/" target="_blank">Перейти на сайт</a>
	</div>
	<div class="evets-cal">
		<img src="/images/cal-example.jpg"	/>
	</div>
</div>
<div class="tabs-block education">
	<ul class="nav nav-tabs owl-carousel owl-theme" role="tablist">
	  <li role="presentation" class="active"><a href="#education1" aria-controls="profile" role="tab" data-toggle="tab">Дневное обучение</a></li>
	  <li role="presentation"><a href="#education2" aria-controls="profile" role="tab" data-toggle="tab">Заочное обучение</a></li>
	  <li role="presentation"><a href="#education3" aria-controls="profile" role="tab" data-toggle="tab">Магистратура</a></li>
	  <li role="presentation"><a href="#education4" aria-controls="profile" role="tab" data-toggle="tab">Переподготовка</a></li>
	  <li role="presentation"><a href="#education5" aria-controls="profile" role="tab" data-toggle="tab">Повышение квалификации</a></li>
	  <li role="presentation"><a href="#education6" aria-controls="profile" role="tab" data-toggle="tab">Дополнительная вкаладка</a></li>
	</ul>
	
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="education1">
			<h2>Поступающим</h2>
			<ul class="col-lg-4">
				<li><a href="#">Контрольные цифры приема в 2016 году</a></li>
				<li><a href="#">Порядок приема</a></li>
				<li><a href="#">Справочное пособие Абитуриент-2016</a></li>
				<li><a href="#">Конкурс и проходной балл в 2015 году</a></li>
				<li><a href="#">Специальности и специализации</a></li>
				<li><a href="#">Алгоритм действий абитуриента</a></li>
			</ul>
			<ul class="col-lg-4">
				<li><a href="#">Расписание вступительной компании в 2016 году</a></li>
				<li><a href="#">Жизнь курсантов</a></li>
				<li><a href="#">Регистрация абитуриента</a></li>
				<li><a href="#">Обращение начальника института</a></li>
				<li><a href="#">ПОДГОТОВИТЕЛЬНЫЕ КУРСЫ</a></li>
				<li><a href="#">Приемущества обучения в институте</a></li>
			</ul>
		</div>
		<div role="tabpanel" class="tab-pane" id="education2">32423</div>
		<div role="tabpanel" class="tab-pane" id="education3">434234</div>
		<div role="tabpanel" class="tab-pane" id="education4">аааааааааааааааааааааа</div>
		<div role="tabpanel" class="tab-pane" id="education5">33344444www</div>
		<div role="tabpanel" class="tab-pane" id="education6">fgggggggg</div>
	</div>
</div>
<div class="right-col purchases">
	<h2>Закупки</h2>
	<div class="owl-carousel owl-theme">
		<div class="bx-newslist-container" >
			<div class="bx-newslist-block">
					<div class="date">
						<div class="bx-newslist-date">9 декабря 2016 - 29 декабря 2016</div>
					</div>
					<h3 class="bx-newslist-title">
							<a href="/">Администрация университета проводит поиск подрядчика для выполнения монтажно-наладочных работ по установке системы СКУД. Требования к подрядчику: лицензия на выполнение монтажных работ, опыт от 5 лет...</a>
					</h3>		 								
			</div>
		</div>
		<div class="bx-newslist-container" >
			<div class="bx-newslist-block">
					<div class="date">
						<div class="bx-newslist-date">9 декабря 2016 - 29 декабря 2016</div>
					</div>
					<h3 class="bx-newslist-title">
							<a href="/">Администрация университета проводит поиск подрядчика для выполнения монтажно-наладочных работ по установке системы СКУД. Требования к подрядчику: лицензия на выполнение монтажных работ, опыт от 5 лет...</a>
					</h3>		 								
			</div>
		</div>
		<div class="bx-newslist-container" >
			<div class="bx-newslist-block">
					<div class="date">
						<div class="bx-newslist-date">9 декабря 2016 - 29 декабря 2016</div>
					</div>
					<h3 class="bx-newslist-title">
							<a href="/">Администрация университета проводит поиск подрядчика для выполнения монтажно-наладочных работ по установке системы СКУД. Требования к подрядчику: лицензия на выполнение монтажных работ, опыт от 5 лет...</a>
					</h3>		 								
			</div>
		</div>
	</div>
</div>

<div class="tabs-block spheres">
	<ul class="nav nav-tabs owl-carousel owl-theme" role="tablist">
	  <li role="presentation" class="active"><a href="#spheres1" aria-controls="profile" role="tab" data-toggle="tab">Образование</a></li>
	  <li role="presentation"><a href="#spheres2" aria-controls="profile" role="tab" data-toggle="tab">Наука</a></li>
	  <li role="presentation"><a href="#spheres3" aria-controls="profile" role="tab" data-toggle="tab">Идеологи</a></li>
	  <li role="presentation"><a href="#spheres4" aria-controls="profile" role="tab" data-toggle="tab">Спорт</a></li>
	  <li role="presentation"><a href="#spheres5" aria-controls="profile" role="tab" data-toggle="tab">Профилактика</a></li>
	  <li role="presentation"><a href="#spheres6" aria-controls="profile" role="tab" data-toggle="tab">ОБЖ</a></li>
	</ul>
	
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="spheres1">
			<h2>Рабочие материалы</h2>
			<ul class="col-lg-4">
				<li><a href="#">Подготовка</a></li>
				<li><a href="#">Практикоориентировання магистратура</a></li>
				<li><a href="#">Научная магистратура</a></li>
				<li><a href="#">Переподготовка</a></li>
				<li><a href="#">Повышение квалификации</a></li>
				<li><a href="#">Семинары</a></li>
				<li><a href="#">Адьюнктура</a></li>
			</ul>
			<ul class="col-lg-4">
				<li><a href="#">Подготовка</a></li>
				<li><a href="#">Практикоориентировання магистратура</a></li>
				<li><a href="#">Научная магистратура</a></li>
				<li><a href="#">Переподготовка</a></li>
				<li><a href="#">Повышение квалификации</a></li>
				<li><a href="#">Семинары</a></li>
				<li><a href="#">Адьюнктура</a></li>
			</ul>	
			<ul class="col-lg-4">
				<li><a href="#">Подготовка</a></li>
				<li><a href="#">Практикоориентировання магистратура</a></li>
				<li><a href="#">Научная магистратура</a></li>
				<li><a href="#">Переподготовка</a></li>
				<li><a href="#">Повышение квалификации</a></li>
				<li><a href="#">Семинары</a></li>
				<li><a href="#">Адьюнктура</a></li>
			</ul>	
		</div>
		<div role="tabpanel" class="tab-pane" id="spheres2">32423</div>
		<div role="tabpanel" class="tab-pane" id="spheres3">434234</div>
		<div role="tabpanel" class="tab-pane" id="spheres4">аааааааааааааааааааааа</div>
		<div role="tabpanel" class="tab-pane" id="spheres5">33344444www</div>
		<div role="tabpanel" class="tab-pane" id="spheres6">fgggggggg</div>
	</div>
</div>
<div class="right-col presentation">
	<div class="presentation-block"><a href="#">Презентация университета</a></div>
	<div class="electronic-treatment-block">
		<h2>Электронное обращение</h2>
		<p>Для получения ответа на интересующий Вас вопрос</p>
		<a href="#">Заполнить форму</a>
	</div>
</div>

	<div class="tabs-block media-block">
		<ul class="nav nav-tabs level1" role="tablist">
		  <li role="presentation" class="active"><a href="#media1" aria-controls="profile" role="tab" data-toggle="tab">Фото</a></li>
		  <li role="presentation"><a href="#media2" aria-controls="profile" role="tab" data-toggle="tab">Видео</a></li>
		  <li role="presentation"><a href="#media3" aria-controls="profile" role="tab" data-toggle="tab">Лучшие выпускники</a></li>
		  <li role="presentation"><a href="#media4" aria-controls="profile" role="tab" data-toggle="tab">Ветераны</a></li>
		  <li role="presentation"><a href="#media5" aria-controls="profile" role="tab" data-toggle="tab">Юбиляры</a></li>
		  <li role="presentation"><a href="#media6" aria-controls="profile" role="tab" data-toggle="tab">Профсоюз</a></li>
		</ul>
		
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="media1">
				<ul class="nav nav-tabs" role="tablist">
				  <li role="presentation" class="active"><a href="#album1" aria-controls="profile" role="tab" data-toggle="tab">Альбом 1</a></li>
				  <li role="presentation"><a href="#album2" aria-controls="profile" role="tab" data-toggle="tab">Альбом 2</a></li>
				  <li role="presentation"><a href="#album3" aria-controls="profile" role="tab" data-toggle="tab">Альбом 3</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="album1">
						<div class="owl-carousel owl-theme"> 
							<a href="#" >
								<img src="/images/album-example.jpg" />
							</a>
							<a href="#">
								<img src="/images/album-example.jpg" />
							</a>
							<a href="#">
								<img src="/images/album-example.jpg" />
							</a>
							<a href="#">
								<img src="/images/album-example.jpg" />
							</a>
							<a href="#">
								<img src="/images/album-example.jpg" />
							</a>
							<a href="#" >
								<img src="/images/album-example.jpg" />
							</a>
							<a href="#">
								<img src="/images/album-example.jpg" />
							</a>
							<a href="#">
								<img src="/images/album-example.jpg" />
							</a>
							<a href="#" >
								<img src="/images/album-example.jpg" />
							</a>		
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="album2">434234</div>
					<div role="tabpanel" class="tab-pane" id="album3">аааааааааааааааааааааа</div>
				</div>
				
			</div>
			<div role="tabpanel" class="tab-pane" id="media2">32423</div>
			<div role="tabpanel" class="tab-pane" id="media3">434234</div>
			<div role="tabpanel" class="tab-pane" id="media4">аааааааааааааааааааааа</div>
			<div role="tabpanel" class="tab-pane" id="media5">33344444www</div>
			<div role="tabpanel" class="tab-pane" id="media6">fgggggggg</div>
		</div>
	</div>
	<div class="right-col presentation">
			<div class="top-courses-block">
				<h2>Лучшие курсы</h2>
				<p>Здесь Вы можете найти курсы по всем предметам университета</p>
				<a href="#">Смотреть</a>
			</div>
			<div class="answers-block">
				<h2>Ответы на вопросы</h2>
				<p>Помогите нам сделать университет лучше</p>
				<a href="#">Голосовать</a>
			</div>

	</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>