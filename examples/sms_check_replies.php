<?php
require_once "vendor/autoload.php";

$basicAuthUserName = 'YOUR_API_KEY'; // The username to use with basic authentication
$basicAuthPassword = 'YOUR_API_SECRET'; // The password to use with basic authentication

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($basicAuthUserName, $basicAuthPassword);

$replies = $client->getReplies();


$result = $replies->getCheckReplies();
print_r($result);
?>
