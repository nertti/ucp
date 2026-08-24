<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Contacts");
?><div class="tabs-block education">
	<ul class="nav nav-tabs owl-carousel owl-theme" role="tablist">
		<li role="presentation"> <a role="tab" aria-controls="profile" data-toggle="tab" href="#form1" aria-expanded="true">Address and contacts</a> </li>
		<li role="presentation"> <a role="tab" aria-controls="profile" data-toggle="tab" href="#form2" aria-expanded="true">Map</a> </li>
		<li role="presentation"> <a role="tab" aria-controls="profile" data-toggle="tab" href="#form3" aria-expanded="true">Panorama</a> </li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane" id="form1" itemscope="" itemtype="http://schema.org/CollegeOrUniversity">
 <img src="/images/for-contacts.jpg">
			<div class="right-block">
				<h2 itemprop="name">University of Civil Protection of the Ministry for Emergency Situations of the Republic of Belarus </h2>
				<p>
					 Our address:
				</p>
				<p itemprop="address">
					 Republic of Belarus, 220118, Minsk Mashinostroiteley 25
				</p>
				<p>
					 Phone:
				</p>
				<p itemprop="telephone">
					 +375 (17) 340-35-57
				</p>
				<p>
					 Fax:
				</p>
				<p itemprop="faxNumber">
					 +375 (17) 340-35-57
				</p>
				<p>
					 Press-service:
				</p>
				<p itemprop="telephone">
					 +375 (17) 340-24-50
				</p>
				<p>
					 Phone of the selection committee for full-time and part-time studies: &nbsp;
				</p>
				<p itemprop="telephone">
					 +375 (17) 345-33-38
				</p>
				<p>
					 Phone of the selection committee for retraining and further training:
				</p>
				<p itemprop="telephone">
					 +375 (17) 340-69-55
				</p>
				<p>
					 E-mail:<a href="mailto:mail@ucp.by" itemprop="email">mail@ucp.by</a>
				</p>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="form2">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"CONTROLS" => array(0=>"ZOOM",1=>"TYPECONTROL",2=>"SCALELINE",),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:53.84950299999355;s:10:\"yandex_lon\";d:27.660178999999978;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:27.660146813491796;s:3:\"LAT\";d:53.849591814109885;s:4:\"TEXT\";s:0:\"\";}}}",
		"MAP_HEIGHT" => "490",
		"MAP_ID" => "yam_1",
		"MAP_WIDTH" => "663",
		"OPTIONS" => array(0=>"ENABLE_SCROLL_ZOOM",1=>"ENABLE_DBLCLICK_ZOOM",2=>"ENABLE_DRAGGING",)
	)
);?>
		</div>
		<div role="tabpanel" class="tab-pane" id="form3">
			 <script src="https://panoramas.api-maps.yandex.ru/embed/1.x/?lang=ru&ll=27.66055642%2C53.8499526&ost=dir%3A162.18919576104972%2C3.266043222472629~span%3A119.99999999999999%2C59.854594655071175&size=611%2C611&l=stv"></script>
		</div>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>