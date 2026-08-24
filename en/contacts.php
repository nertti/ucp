<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Feedback");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	"personal",
	Array(
		"EMAIL_TO" => "",
		"EVENT_MESSAGE_ID" => "",
		"OK_TEXT" => "Спасибо, ваше сообщение отправлено.",
		"REQUIRED_FIELDS" => array(0=>"NAME",1=>"EMAIL",2=>"MESSAGE",),
		"USE_CAPTCHA" => "Y"
	)
);?>
<h1>Контактная информация</h1>
<div class="hr">
</div>
<ul>
	<li>E-mail: <a href="mailto:19Victoria84@gmail.com">19Victoria84@gmail.com</a>.</li>
	<li>Skype: Fadeeva_Victoria.</li>
</ul><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>