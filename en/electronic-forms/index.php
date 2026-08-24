<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Электронное обращение");
?><div class="tabs-block education">
	<ul class="nav nav-tabs owl-carousel owl-theme" role="tablist">
		<li role="presentation"> <a role="tab" aria-controls="profile" data-toggle="tab" href="#form1" aria-expanded="true">Физическое лицо</a> </li>
		<li role="presentation"> <a role="tab" aria-controls="profile" data-toggle="tab" href="#form2" aria-expanded="true">Юридическое лицо</a> </li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane" id="form1">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:form",
	"custom",
	Array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_ADDITIONAL" => "Y",
		"EDIT_STATUS" => "Y",
		"IGNORE_CUSTOM_TEMPLATE" => "Y",
		"NOT_SHOW_FILTER" => array("",""),
		"NOT_SHOW_TABLE" => array("",""),
		"RESULT_ID" => "",
		"SEF_FOLDER" => "",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("edit"=>"","list"=>"","new"=>"","view"=>""),
		"SHOW_ADDITIONAL" => "Y",
		"SHOW_ANSWER_VALUE" => "Y",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_STATUS" => "Y",
		"SHOW_VIEW_PAGE" => "N",
		"START_PAGE" => "new",
		"SUCCESS_URL" => "/electronic-forms/complete/",
		"USE_EXTENDED_ERRORS" => "Y",
		"WEB_FORM_ID" => "1"
	)
);?>
		</div>
		<div role="tabpanel" class="tab-pane" id="form2">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:form",
	"custom",
	Array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_ADDITIONAL" => "Y",
		"EDIT_STATUS" => "Y",
		"IGNORE_CUSTOM_TEMPLATE" => "Y",
		"NOT_SHOW_FILTER" => array("",""),
		"NOT_SHOW_TABLE" => array("",""),
		"RESULT_ID" => "",
		"SEF_FOLDER" => "",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("edit"=>"","list"=>"","new"=>"","view"=>""),
		"SHOW_ADDITIONAL" => "Y",
		"SHOW_ANSWER_VALUE" => "Y",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_STATUS" => "Y",
		"SHOW_VIEW_PAGE" => "N",
		"START_PAGE" => "new",
		"SUCCESS_URL" => "/electronic-forms/complete/",
		"USE_EXTENDED_ERRORS" => "Y",
		"WEB_FORM_ID" => "2"
	)
);?>
		</div>
	</div>
</div>
<h2>Правила электронного обращения </h2>
<p>
 <span class="color-1">Электронные обращения граждан, в том числе индивидуальных предпринимателей (далее - граждане), и юридических лиц в адрес Университета гражданской защиты МЧС Республики Беларусь направляются и рассматриваются в соответствии с требованиями Закона Республики Беларусь от 18 июля 2011 года “Об обращениях граждан и юридических лиц”.<br>
	 Электронное обращение излагается на белорусском или русском языке.<br>
	 Электронное обращение гражданина в обязательном порядке должно содержать: </span>
</p>
<ul>
	<li><span class="color-1">фамилию, собственное имя, отчество либо инициалы гражданина; </span></li>
	<li><span class="color-1">адрес места жительства (места пребывания) гражданина и (или) места работы (учебы); </span></li>
	<li><span class="color-1">изложение сущности обращения; </span></li>
	<li><span class="color-1">адрес электронной почты гражданина.</span></li>
</ul>
<p>
 <span class="color-1">Электронное обращение юридического лица в обязательном порядке должно содержать: </span>
</p>
<ul>
	<li><span class="color-1">полное наименование и (или) адрес организации либо должность лица, которым направляется обращение; </span></li>
	<li><span class="color-1">полное наименование юридического лица и место его нахождения; </span></li>
	<li><span class="color-1">изложение сути обращения; </span></li>
	<li><span class="color-1">фамилию, собственное имя, отчество (если таковое имеется) руководителя или лица, уполномоченного в установленном порядке подписывать обращения; </span></li>
	<li><span class="color-1">адрес электронной почты юридического лица.</span></li>
</ul>
<p>
 <span class="color-1">Электронные обращения должны быть рассмотрены не позднее 15 дней, а требующие дополнительного изучения и проверки - не позднее 1 месяца.<br>
	 Срок рассмотрения электронных обращений исчисляется со дня их регистрации в Университете гражданской защиты МЧС Республики Беларусь.<br>
	 Ответы на электронные обращения направляются в электронном виде на адрес электронной почты, указанный в электронном обращении, либо в письменном виде на адрес места жительства (места пребывания) гражданина или места нахождения юридического лица в случаях, установленных Законом Республики Беларусь от 18.07.2011 г. “Об обращениях граждан и юридических лиц”.<br>
	 Обращаем Ваше внимание, что без рассмотрения по существу остаются обращения, которые (по которым): </span>
</p>
<ul>
	<li><span class="color-1">изложены не на белорусском или русском языке; </span></li>
	<li><span class="color-1">не содержат фамилии, собственного имени и отчества или инициалов, адреса места жительства (места пребывания) гражданина или места его работы (учебы); </span></li>
	<li><span class="color-1">не содержат полного наименования юридического лица и адреса его места нахождения, фамилии, собственного имени, отчества руководителя или лица, уполномоченного в установленном порядке подписывать обращения (для юридических лиц); </span></li>
	<li><span class="color-1">содержат текст, не поддающийся прочтению; </span></li>
	<li><span class="color-1">содержат нецензурные либо оскорбительные слова или выражения; </span></li>
	<li><span class="color-1">подлежат рассмотрению в соответствии с законодательством о конституционном судопроизводстве, гражданским, гражданским процессуальным, хозяйственным процессуальным, уголовно- процессуальным законодательством, законодательством, определяющим порядок административного процесса, законодательством об административных процедурах либо в соответствии с законодательными актами установлен иной порядок подачи и рассмотрения таких обращений; </span></li>
	<li><span class="color-1">содержат вопросы, решение которых не относится к компетенции Университета гражданской защиты МЧС Республики Беларусь; </span></li>
	<li><span class="color-1">пропущен без уважительной причины срок подачи жалобы; </span></li>
	<li><span class="color-1">подано повторное обращение, если оно уже было рассмотрено по существу и в нем не содержатся новые обстоятельства, имеющие значение для рассмотрения обращения по существу; </span></li>
	<li><span class="color-1">с заявителем прекращена переписка по изложенным в обращении вопросам.</span></li>
</ul><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>