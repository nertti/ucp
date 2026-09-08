<?php

define('STOP_STATISTICS', true);
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('DisableEventsCheck', true);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Main\Loader;

header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Недопустимый метод запроса'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

if (!Loader::includeModule('main')) {
    echo json_encode([
        'success' => false,
        'message' => 'Не удалось подключить модуль Bitrix'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}


/**
 * Получаем данные
 */
$emailTo = trim((string)($_POST['EMAIL_TO'] ?? 'fpipk@ucp.by'));

$name = trim((string)($_POST['name'] ?? ''));
$phone = trim((string)($_POST['phone'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));

$address = trim((string)($_POST['address'] ?? ''));

$enterprise = trim((string)($_POST['enterprise'] ?? ''));

$representativeName = trim(
    (string)($_POST['representative_name'] ?? '')
);

$representativePhone = trim(
    (string)($_POST['representative_phone'] ?? '')
);

$representativeEmail = trim(
    (string)($_POST['representative_email'] ?? '')
);

$text = trim((string)($_POST['text'] ?? ''));


/**
 * Проверяем email получателя
 */
if (
    !$emailTo ||
    !check_email($emailTo)
) {
    echo json_encode([
        'success' => false,
        'message' => 'Некорректный адрес получателя'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}


/**
 * Проверяем обязательные поля
 */
if (!$name || !$phone || !$email || !$enterprise) {
    echo json_encode([
        'success' => false,
        'message' => 'Заполните все обязательные поля'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}


/**
 * Проверяем email пользователя
 */
if (!check_email($email)) {
    echo json_encode([
        'success' => false,
        'message' => 'Некорректный E-mail'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}


/**
 * Названия образования
 */
$educationNames = [
    'brest_meat' => 'Среднее специальное (техникум, колледж)',
    'brest_traditions' => 'Профессионально-техническое',
    'brest_treats' => 'Среднее',
];

$education = $educationNames[$enterprise] ?? $enterprise;


/**
 * Формируем письмо
 */
$subject = 'Заявка на обучающие курсы';

$message = '
<h2>Новая заявка на обучающие курсы</h2>

<p>
    <strong>ФИО:</strong><br>
    ' . htmlspecialchars($name) . '
</p>

<p>
    <strong>Телефон:</strong><br>
    ' . htmlspecialchars($phone) . '
</p>

<p>
    <strong>E-mail:</strong><br>
    ' . htmlspecialchars($email) . '
</p>

<p>
    <strong>Почтовый адрес:</strong><br>
    ' . htmlspecialchars($address) . '
</p>

<p>
    <strong>Образование:</strong><br>
    ' . htmlspecialchars($education) . '
</p>
';


if ($representativeName) {
    $message .= '
    <p>
        <strong>ФИО законного представителя:</strong><br>
        ' . htmlspecialchars($representativeName) . '
    </p>
    ';
}

if ($representativePhone) {
    $message .= '
    <p>
        <strong>Телефон законного представителя:</strong><br>
        ' . htmlspecialchars($representativePhone) . '
    </p>
    ';
}

if ($representativeEmail) {
    $message .= '
    <p>
        <strong>E-mail законного представителя:</strong><br>
        ' . htmlspecialchars($representativeEmail) . '
    </p>
    ';
}


/**
 * Отправляем письмо
 */
$headers = [
    'Content-Type: text/html; charset=UTF-8',
    'From: noreply@' . $_SERVER['HTTP_HOST'],
    'Reply-To: ' . $email,
];

$result = \Bitrix\Main\Mail\Mail::send([
    'TO' => $emailTo,
    'SUBJECT' => $subject,
    'BODY' => $message,
    'HEADER' => $headers,
]);


/**
 * Ответ JS
 */
if ($result) {

    echo json_encode([
        'success' => true,
        'message' => 'Заявка успешно отправлена!'
    ], JSON_UNESCAPED_UNICODE);

} else {

    echo json_encode([
        'success' => false,
        'message' => 'Не удалось отправить заявку. Попробуйте ещё раз.'
    ], JSON_UNESCAPED_UNICODE);
}