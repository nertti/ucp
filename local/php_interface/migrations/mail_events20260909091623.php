<?php

namespace Sprint\Migration;


class mail_events20260909091623 extends Version
{
    protected $author = "New-admin";

    protected $description = "";

    protected $moduleVersion = "5.13.0";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Event()->saveEventType('SEND_SERVICE_MAIL', array (
  'LID' => 'ru',
  'EVENT_TYPE' => 'email',
  'NAME' => 'Отправка заявки на услугу',
  'DESCRIPTION' => '',
  'SORT' => '150',
));
            $helper->Event()->saveEventMessage('SEND_SERVICE_MAIL', array (
  'LID' => 
  array (
    0 => 's1',
  ),
  'ACTIVE' => 'Y',
  'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
  'EMAIL_TO' => '#EMAIL_TO#',
  'SUBJECT' => '123',
  'MESSAGE' => '<h2>#SERVICE_NAME#</h2>

<p>
    <strong>Дата заявки:</strong> #DATE#
</p>

<hr>

<h3>Данные заявителя</h3>

<p>
    <strong>ФИО:</strong><br>
    #NAME#
</p>

<p>
    <strong>Телефон:</strong><br>
    #PHONE#
</p>

<p>
    <strong>Email:</strong><br>
    #EMAIL#
</p>

<p>
    <strong>Адрес:</strong><br>
    #ADDRESS#
</p>

<p>
    <strong>Образование:</strong><br>
    #ENTERPRISE#
</p>

<hr>

<h3>Данные законного представителя</h3>

<p>
    <strong>ФИО:</strong><br>
    #REPRESENTATIVE_NAME#
</p>

<p>
    <strong>Телефон:</strong><br>
    #REPRESENTATIVE_PHONE#
</p>

<p>
    <strong>Email:</strong><br>
    #REPRESENTATIVE_EMAIL#
</p>

<hr>

<p>
    <strong>Дополнительная информация:</strong><br>
    #TEXT#
</p>',
  'BODY_TYPE' => 'text',
  'BCC' => '',
  'REPLY_TO' => '',
  'CC' => '',
  'IN_REPLY_TO' => '',
  'PRIORITY' => '',
  'FIELD1_NAME' => '',
  'FIELD1_VALUE' => '',
  'FIELD2_NAME' => '',
  'FIELD2_VALUE' => '',
  'SITE_TEMPLATE_ID' => '',
  'ADDITIONAL_FIELD' => 
  array (
  ),
  'LANGUAGE_ID' => 'ru',
  'EVENT_TYPE' => '[ SEND_SERVICE_MAIL ] Отправка заявки на услугу',
));
        }
}
