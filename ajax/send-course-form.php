<?php

define('STOP_STATISTICS', true);
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('DisableEventsCheck', true);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Main\Loader;

header('Content-Type: application/json; charset=UTF-8');

if (!Loader::includeModule('iblock')) {
    echo json_encode([
        'success' => false,
        'message' => 'Не удалось подключить модуль инфоблоков.'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

/**
 * Только POST
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Некорректный метод запроса.'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

/**
 * Получение и очистка данных
 */
$name = trim((string)($_POST['name'] ?? ''));
$phone = trim((string)($_POST['phone'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$address = trim((string)($_POST['address'] ?? ''));

$enterprise = trim((string)($_POST['enterprise'] ?? ''));

$captchaText = trim((string)($_POST['text'] ?? ''));

/**
 * Получатель
 *
 * Пока берём из скрытого поля формы.
 * В дальнейшем лучше передавать ID курса/элемента
 * и получать EMAIL_TO непосредственно на сервере.
 */
$emailTo = trim((string)($_POST['EMAIL_TO'] ?? ''));

/**
 * Валидация
 */
$errors = [];

if ($name === '') {
    $errors[] = 'Укажите ФИО.';
}

if ($phone === '') {
    $errors[] = 'Укажите телефон.';
}

if ($email === '') {
    $errors[] = 'Укажите электронную почту.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Укажите корректный адрес электронной почты.';
}

if ($address === '') {
    $errors[] = 'Укажите адрес.';
}

if ($enterprise === '') {
    $errors[] = 'Выберите образование.';
}

if ($emailTo === '') {
    $errors[] = 'Не указан получатель письма.';
}

if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'message' => implode(' ', $errors)
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

/**
 * Расшифровка образования
 */
$enterpriseList = [
    'brest_meat' => 'Среднее специальное (техникум, колледж)',
    'brest_traditions' => 'Профессионально-техническое',
    'brest_treats' => 'Среднее',
];

$enterpriseName = $enterpriseList[$enterprise] ?? $enterprise;

/**
 * Параметры почтового события
 */
$arFields = [
    'EMAIL_TO' => $emailTo,

    'NAME' => $name,
    'PHONE' => $phone,
    'EMAIL' => $email,
    'ADDRESS' => $address,

    'ENTERPRISE' => $enterpriseName,

    'TEXT' => $captchaText,

    'DATE' => date('d.m.Y H:i:s'),
];

/**
 * Отправка почтового события
 */
$eventId = CEvent::Send(
    'SEND_SERVICE_MAIL',
    SITE_ID,
    $arFields
);

if (!$eventId) {
    echo json_encode([
        'success' => false,
        'message' => 'Не удалось отправить заявку. Попробуйте ещё раз.'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'Заявка успешно отправлена!'
], JSON_UNESCAPED_UNICODE);