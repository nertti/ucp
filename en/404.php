<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Page not found");

?><div>
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
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>