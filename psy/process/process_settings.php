<?php

// стартовый путь ('http://mydomain.ru/')
$startPath = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/';
// максимальный размер файла 512Кбайт (512*1024=524288)
const MAX_FILE_SIZE = 524288;
// директория для хранения загруженных файлов
$uploadPath = dirname(dirname(__FILE__)) . '/uploads/';
// разрешённые расширения файлов
$allowedExtensions = array('gif', 'jpg', 'png', "pdf");

// от какого email будет отправляться письмо
const MAIL_FROM = 'noreply@ucp.by';
// от какого имени будет отправляться письмо
const MAIL_FROM_NAME = 'Ucp.by';
// тема письма
const MAIL_SUBJECT = 'Психологический опрос - Опросник Леонгарда-Шмишека (расширенный)';
// кому необходимо отправить ';
const MAIL_ADDRESS = 'oir@ucp.by';
// настройки mail для информирования пользователя о доставке сообщения
const MAIL_SUBJECT_CLIENT = 'Ваше сообщение доставлено';