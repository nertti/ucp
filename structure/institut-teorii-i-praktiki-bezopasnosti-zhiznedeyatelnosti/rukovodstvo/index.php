<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Руководство");
?><? $APPLICATION->IncludeComponent("sprint.editor:blocks", "constructor", [
    'IBLOCK_TYPE' => 'static_pages',
    'IBLOCK_CODE' => 'static_pages',
    'ELEMENT_CODE' => '3-rukovodstvo',
    'PROPERTY_CODE' => 'EDITOR',
    'SHOW_AREAS' => 'Y',
]); ?>

<p style="text-align: center;">
	Заместитель начальника университета по идеологической работе и кадровому обеспечению – начальник института теории и практики безопасности жизнедеятельности <br>
	полковник внутренней службы <br>
	<b>Делендик Николай Анатольевич</b><br>
	<b>т. +375 17 341 71 22&nbsp;</b>
</p>
<p style="text-align: center;">
	Заместитель начальника института теории и практики безопасности жизнедеятельности – начальник центра исследований в области безопасности жизнедеятельности и взаимодействия с общественностью<br>
	подполковник внутренней службы<br>
	<b>Вайтович Иван Андреевич<br>
	</b><b>т. +375 17 269 70 65</b>
</p>
<p style="text-align: justify;">
</p>
<p style="text-align: justify;">
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>