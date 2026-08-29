<?php
$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandler('iblock',
    'OnAfterIBlockElementAdd',
    'onAfterIBlockElementAddHandler');