<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Электронны зварот");
?><div class="tabs-block education">
	<ul class="nav nav-tabs owl-carousel owl-theme" role="tablist">
		<li role="presentation"> <a role="tab" aria-controls="profile" data-toggle="tab" href="#form1" aria-expanded="true">Фізічная асоба</a> </li>
		<li role="presentation"> <a role="tab" aria-controls="profile" data-toggle="tab" href="#form2" aria-expanded="true">Юрыдычная асоба</a> </li>
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
		"WEB_FORM_ID" => "11"
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
		"WEB_FORM_ID" => "12"
	)
);?>
		</div>
	</div>
</div>
<h2>Правілы электроннага звароту </h2>
<p>
	 Электронныя звароты грамадзян, у тым ліку індывідуальных прадпрымальнікаў (далей - грамадзяне), і юрыдычных асоб у адрас Універсітэта грамадзянскай абароны МНС Рэспублікі Беларусь накіроўваюцца і разглядаюцца ў адпаведнасці з патрабаваннямі Закона Рэспублікі Беларусь ад 18 лiпеня 2011 года "Аб зваротах грамадзян і юрыдычных асобаў".Электронны зварот выкладаецца на беларускай або рускай мове. Электронны зварот грамадзяніна ў абавязковым парадку павінен&nbsp;уключаць:
</p>
<ul>
	<li><span class="color-1">прозвішча, уласнае імя, імя па бацьку або ініцыялы грамадзяніна; </span></li>
	<li><span class="color-1">адрас месца жыхарства (месца знаходжання) грамадзяніна і (або) месца працы (вучобы); </span></li>
	<li><span class="color-1">выклад сутнасці звароту; </span></li>
	<li><span class="color-1">адрас электроннай пошты грамадзяніна.</span></li>
</ul>
<p>
 <span class="color-1">Электронны зварот юрыдычнай асобы ў абавязковым парадку павінен&nbsp;уключаць: </span>
</p>
<ul>
	<li><span class="color-1">поўнае назву і (або) адрас арганізацыі альбо пасаду асобы, якім накіроўваецца зварот; </span></li>
	<li><span class="color-1">поўнае найменне юрыдычнай асобы і месца яго знаходжання; </span></li>
	<li><span class="color-1">выкладанне сутнасці звароту; </span></li>
	<li><span class="color-1">прозвішча, уласнае імя, імя па бацьку (калі такое маецца) кіраўніка або асобы, упаўнаважанай ва ўстаноўленым парадку падпісваць звароты; </span></li>
	<li><span class="color-1">адрас электроннай пошты юрыдычнай асобы.</span></li>
</ul>
<p>
 <span class="color-1">Электронныя звароты павінны быць разгледжаны не пазней за 15 дзён, а якія патрабуюць дадатковага вывучэння і праверкі - не пазней 1 месяца.<br>
	 Тэрмін разгляду электронных зваротаў лiчыцца з дня іх рэгістрацыі ў Універсітэце грамадзянскай абароны МНС Рэспублікі Беларусь.<br>
	 Адказы на электронныя звароты накіроўваюцца ў электронным выглядзе на адрас электроннай пошты, паказаны ў электронным звароце, альбо ў пісьмовым выглядзе на адрас месца жыхарства (месца знаходжання) грамадзяніна або месца знаходжання юрыдычнай асобы ў выпадках, устаноўленых Законам Рэспублікі Беларусь ад 18.07.2011 г. «Аб зваротах грамадзян і юрыдычных асобаў".<br>
	 Звяртаем Вашу ўвагу, што без разгляду па сутнасці застаюцца звароты, якія (па якіх): </span>
</p>
<ul>
	<li><span class="color-1">выкладзены не на беларускай або рускай мове; </span></li>
	<li><span class="color-1">не ўтрымліваюць прозвiшча, уласнага iмя i iмя па бацьку або ініцыялаў, адрасы месца жыхарства (месца знаходжання) грамадзяніна або месца яго працы (вучобы); </span></li>
	<li><span class="color-1">не ўтрымліваюць поўнай назвы юрыдычнай асобы і адрасы яго месца знаходжання, прозвiшча, уласнага iмя, iмя па бацьку кіраўніка або асобы, упаўнаважанай ва ўстаноўленым парадку падпісваць звароты (для юрыдычных асоб); </span></li>
	<li><span class="color-1">ўтрымліваюць тэкст, які не паддаецца чытанню; </span></li>
	<li><span class="color-1">ўтрымліваюць нецэнзурныя або абразлівыя словы або выразы; </span></li>
	<li><span class="color-1">падлягаюць разгляду ў адпаведнасці з заканадаўствам аб канстытуцыйным судаводстве, грамадзянскім, грамадзянскім працэсуальным, гаспадарчым працэсуальным, крымінальна-працэсуальным заканадаўствам, заканадаўствам, якое вызначае парадак адміністрацыйнага працэсу, заканадаўствам аб адміністрацыйных працэдурах альбо ў адпаведнасці з заканадаўчымі актамі ўстаноўлены іншы парадак падачы і разгляду такіх зваротаў; </span></li>
	<li><span class="color-1">змяшчаюць пытанні, вырашэнне якіх не адносіцца да кампетэнцыі Універсітэта грамадзянскай абароны МНС Рэспублікі Беларусь; </span></li>
	<li><span class="color-1">прапушчаны без уважлівай прычыны тэрмін падачы скаргі; </span></li>
	<li><span class="color-1">пададзены паўторны зварот, калі ён ужо быў разгледжаны па сутнасці і ў ім НЕ змяшчаюцца новыя, &nbsp; Абставіны для разгляду;</span></li>
	<li><span class="color-1">з заяўнікам спынена перапіска па выкладзенаму ў звароце пытанняў.</span></li>
</ul><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>