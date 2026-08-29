<?php
// ПОДКЛЮЧАЕМ ФУНКЦИИ
if(file_exists($_SERVER['DOCUMENT_ROOT']. "/local/php_interface/include/functions.php"))
    require_once($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/include/functions.php");
// Подключаем класс новости
if(file_exists($_SERVER['DOCUMENT_ROOT']. "/local/php_interface/handlers/NewsHandler.php"))
    require_once($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/handlers/NewsHandler.php");
// ПОДКЛЮЧАЕМ СОБЫТИЯ
if(file_exists($_SERVER['DOCUMENT_ROOT']. "/local/php_interface/events.php"))
    require_once($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/events.php");
