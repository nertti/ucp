<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Старонка не знойдзена");

?><div>
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
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>