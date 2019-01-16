<?php

require_once "vendor/autoload.php";

use MessageMediaMessagesLib\Models;
use MessageMediaMessagesLib\Exceptions;

$authUserName = 'API_KEY';
$authPassword = 'API_SECRET';
/* You can change this to true when the above keys are HMAC */
$useHmacAuthentication = false;

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

$messagesController = $client->getMessages();

try {
    $result = $messagesController->checkCreditsRemaining();
    print_r($result);
} catch (MessageMediaMessagesLib\APIException $e) {
    echo 'Caught APIException: ',  $e->getMessage(), "\n";
}
