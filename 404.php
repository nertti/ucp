<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

//echo "<pre>";
//var_dump($_SERVER);
//echo "</pre>";


?>
<?if(SITE_DIR=="/"):?>
<?$APPLICATION->SetTitle("Страница не найдена");?>
<div class="">
	<p><strong>Вы не можете посетить текущую страницу по причине:</strong></p>
	<ol>
	<li><b>Просроченная закладка/избранное;</b></li>
	<li>Поисковый механизм, у которого <strong>просрочен список для этого сайта;</strong></li>
	<li><strong>Пропущен адрес;</strong></li>
	<li>У вас <strong>нет права доступа</strong> на эту страницу;</li>
	<li>Запрашиваемый ресурс не найден;</li>
	<li>В процессе обработки вашего запроса произошла ошибка.</li>
	</ol>
	<p><strong>Для удобства навигации по сайту вы можете перейти на одну из следующих страниц:</strong></p>
	<ul>
	<li><a href="/" title="Вернуться на Домашнюю страницу">Домашняя страница</a></li>
	<li><a href="/sitemap" title="Перейти на карту сайта">Карта сайта</a></li>
	</ul>
	<p>Если проблемы продолжатся, пожалуйста, обратитесь к <a href="mailto:mail@ucp.by">системному администратору</a> сайта и сообщите об ошибке.</p>
</div>
<?endif;?>
<?if(SITE_DIR=="/by/"):?>
<?$APPLICATION->SetTitle("Старонка не знойдзена");?>
<div>
	<p>
		<strong>Вы не можаце наведаць гэтую старонку, таму што:</strong>
	</p>
	<ol>
		<li><b>Пратэрмінаваная закладка / абранае;</b></li>
		<li>Пошукавы механізм, у якога пратэрмінаваны <strong>спіс для гэтага сайта;</strong></li>
		<li><strong>Прапушчаны адрас;</strong></li>
		<li>У вас няма правы доступу на <strong> гэтую старонку;</strong></li>
		<li>Запытаны рэсурс не знойдзены;</li>
		<li>У працэсе апрацоўкі вашага запыту адбылася памылка;</li>
	</ol>

	<p>
		<strong>Для выгоды навігацыі па сайце вы можаце перайсці на адну з наступных старонак:</strong>
	</p>
	<ul>
		<li><a href="/" title="Back to Home Page">Хатняя старонка</a></li>
		<li><a href="/sitemap" title="Перайсці на карту сайта">Карта сайта</a></li>
	</ul>
	<p>
		Калі праблемы будуць працягвацца, калі ласка, звярніцеся да <a href="mailto:mail@ucp.by">сістэмнага адміністратара</a> сайта і паведаміце пра памылку.
	</p>

</div>
<?endif;?>
<?if(SITE_DIR=="/en/"):?>
<?$APPLICATION->SetTitle("Page not found");?>
<div>
	<p>
		<strong>You can not visit the current page because:</strong>
	</p>
	<ol>
		<li><b>Overdue bookmarks / favorites;</b></li>
		<li>A crooked mechanism that has a <strong> list for this site overdue;</strong></li>
		<li><strong>Missing address;</strong></li>
		<li>You do not have <strong> permission on this page;</strong></li>
		<strong>
		<li>The requested resource is not found;</li>
		<li>An error occurred while processing your request.</li>
 </strong>
	</ol>
	<strong>
	<p>
		<strong>For ease of navigation on the site, you can go to one of the following pages:</strong>
	</p>
	<ul>
		<li><a href="/" title="Back to Home Page">Home page</a></li>
		<li><a href="/sitemap" title="Go to site map">Site map</a></li>
	</ul>
	<p>
		If the problem persists, please contact <a href="mailto:mail@ucp.by"> system administrator </a> and report an error.
	</p>
 </strong>
</div>
<?endif;?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
