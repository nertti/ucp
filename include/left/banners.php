<? if (\Bitrix\Main\Loader::includeModule("advertising")): ?>
    <?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"left",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"NOINDEX" => "Y",
		"QUANTITY" => "5",
		"TYPE" => "left"
	)
);?>
<? endif; ?>