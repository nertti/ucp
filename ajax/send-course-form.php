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
 * Какие поля разрешены для данной формы
 */
$formFields = $_POST['FORM_FIELDS'] ?? [];

if (!is_array($formFields)) {
    $formFields = [$formFields];
}

$formFields = array_map(
    'trim',
    array_map('strval', $formFields)
);

/**
 * Разрешённые поля формы
 */
$availableFields = [
    'NAME',
    'PHONE',
    'EMAIL',
    'ADDRESS',
    'ORGANIZATION',
    'ORGANIZATION_ADDRESS',
    'ENTERPRISE',
    'POSITION',
    'CATEGORY',
];

/**
 * Оставляем только известные XML_ID
 */
$formFields = array_values(
    array_intersect($formFields, $availableFields)
);

/**
 * Проверка наличия поля
 */
$hasField = static function (string $xmlId) use ($formFields): bool {
    return in_array($xmlId, $formFields, true);
};

/**
 * Получение данных
 */
$serviceName = trim((string)($_POST['SERVICE_NAME'] ?? ''));
$emailTo = trim((string)($_POST['EMAIL_TO'] ?? ''));

$name = trim((string)($_POST['name'] ?? ''));
$phone = trim((string)($_POST['phone'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));

$address = trim((string)($_POST['address'] ?? ''));

$organization = trim((string)($_POST['organization'] ?? ''));
$organizationAddress = trim(
    (string)($_POST['organization_address'] ?? '')
);

$enterprise = trim((string)($_POST['enterprise'] ?? ''));
$position = trim((string)($_POST['position'] ?? ''));

$category = trim(
    (string)($_POST['form_dropdown_category'] ?? '')
);

/**
 * Валидация
 */
$errors = [];

/**
 * ФИО
 */
if ($hasField('NAME') && $name === '') {
    $errors[] = 'Укажите ФИО.';
}

/**
 * Телефон
 */
if ($hasField('PHONE') && $phone === '') {
    $errors[] = 'Укажите телефон.';
}

/**
 * Email
 */
if ($hasField('EMAIL')) {
    if ($email === '') {
        $errors[] = 'Укажите электронную почту.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Укажите корректный адрес электронной почты.';
    }
}

/**
 * Образование
 */
if ($hasField('ENTERPRISE') && $enterprise === '') {
    $errors[] = 'Выберите образование.';
}

/**
 * Категория
 */
if ($hasField('CATEGORY') && $category === '') {
    $errors[] = 'Выберите категорию слушателя.';
}

/**
 * Получатель письма
 */
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
    'Высшее' => 'Высшее образование',
    'Среднее специальное' => 'Среднее специальное (техникум, колледж)',
    'Профессионально-техническое' => 'Профессионально-техническое',
    'Среднее' => 'Среднее',
];

$enterpriseName = $enterpriseList[$enterprise] ?? $enterprise;

/**
 * Поля письма
 */
$arFields = [
    'EMAIL_TO' => $emailTo,

    'NAME' => $name,
    'PHONE' => $phone,
    'EMAIL' => $email,

    'ADDRESS' => $address,

    'ORGANIZATION' => $organization,
    'ORGANIZATION_ADDRESS' => $organizationAddress,

    'ENTERPRISE' => $enterpriseName,
    'POSITION' => $position,

    'CATEGORY' => $category,

    'SERVICE_NAME' => $serviceName,

    'DATE' => date('d.m.Y H:i:s'),
];

/**
 * Отправка письма
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

exit;