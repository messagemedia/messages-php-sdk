<?php
require_once "vendor/autoload.php";

use MessageMediaMessagesLib\MessageMediaMessagesClient;

$authUserName = 'YOUR_API_KEY'; // The API key to use with basic/HMAC authentication
$authPassword = 'YOUR_API_SECRET'; // The API secret to use with basic/HMAC authentication
$useHmacAuthentication = false; // Change to true if you are using HMAC keys

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

$replies = $client->getReplies();


$result = $replies->getCheckReplies();
print_r($result);
?>
