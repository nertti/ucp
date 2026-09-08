<? if (\Bitrix\Main\Loader::includeModule("advertising")): ?>
    <? $APPLICATION->IncludeComponent(
            "bitrix:advertising.banner",
            "left", // Шаблон компонента (по умолчанию .default)
            array(
                    "TYPE" => "left",         // Символьный код типа баннера
                    "NOINDEX" => "Y",         // Оборачивать ссылки баннера в тег <noindex>
                    "CACHE_TYPE" => "A",     // Автоматическое кеширование
                    "CACHE_TIME" => "3600",    // Время кеширования в секундах
                    "QUANTITY" => "5",
            ),
            false
    ); ?>
<? endif; ?>