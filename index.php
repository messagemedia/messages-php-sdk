<?php

require_once "vendor/autoload.php";

use MessageMediaMessagesLib\Models;
use MessageMediaMessagesLib\Exceptions;

$authUserName = '0HlknKPfNXXC3MXOcMbr'; // The API key to use with basic/HMAC authentication
$authPassword = 'CraZaWRQSqRS0nKpbDeKXHX0XOZfhK';
$useHmacAuthentication = true;

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

$messagesController = $client->getMessages();

$body = new Models\SendMessagesRequest;
$body->messages = array();

$body->messages[0] = new Models\Message;
$body->messages[0]->content = 'My first message';
$body->messages[0]->destinationNumber = '+61451325027';

try {
    $result = $messagesController->sendMessages($body);
    print_r($result);
} catch (Exceptions\SendMessages400Response $e) {
    echo 'Caught SendMessages400Response: ',  $e->getMessage(), "\n";
} catch (MessageMediaMessagesLib\APIException $e) {
    echo 'Caught APIException: ',  $e->getMessage(), "\n";
}
