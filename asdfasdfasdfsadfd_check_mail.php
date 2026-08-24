<?PHP
$sender = 'noreply@ucp.by';
$recipient = 'ucp.by@tut.by';

$subject = "php mail test";
$message = "php test message";
$headers = 'From:' . $sender;

if (mail($recipient, $subject, $message, $headers))
{
    echo "Message accepted";
}
else
{
    echo "Error: Message not accepted";
}