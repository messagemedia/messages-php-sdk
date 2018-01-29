<?php
require_once "vendor/autoload.php";

$basicAuthUserName = 'YOUR_API_KEY'; // The username to use with basic authentication
$basicAuthPassword = 'YOUR_API_SECRET'; // The password to use with basic authentication

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($basicAuthUserName, $basicAuthPassword);

$messages = $client->getMessages();

$messageId = 'YOUR_MESSAGE_ID'; // The message id for the message you wish to get the status for

$result = $messages->getMessageStatus($messageId);
print_r($result);
?>
