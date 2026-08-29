<?
if (mail("tsit@ucp.by","test subject", "test body","From: otpravitel@bitrix.ru"))
echo "Сообщение передано функции mail, проверьте почту в ящике.";
else
echo "Функция mail не работает, свяжитесь с администрацией хостинга.";
?>