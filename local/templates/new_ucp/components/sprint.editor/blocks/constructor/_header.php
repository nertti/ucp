<?php /**
 * Подключается перед выводом всех блоков
 *
 * @var $this     SprintEditorBlocksComponent
 * @var $blocks   array - массив со всеми блоками, можно модифицировать
 * @var $arParams array - массив с параметрами компонента
 */
global $APPLICATION;

use Sprint\Editor\Module;

?>
<main class="page">
    <div class="page__container">
        <nav class="page__sidebar">
            <?php $APPLICATION->IncludeFile(
                    "/include/left/banners.php",
                    array(),
                    array(
                            "MODE" => "html"
                    )
            ); ?>
        </nav>
        <div class="page__content">
            <?php $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "breadcrumb",
                    array(
                            "COMPONENT_TEMPLATE" => "breadcrumb",
                            "PATH" => "",
                            "SITE_ID" => "s1",
                            "START_FROM" => "0"
                    )
            ); ?>
            <div class="page__content-block">

