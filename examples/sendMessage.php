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

$body = new Models\SendMessagesRequest;
$body->messages = array();

$body->messages[0] = new Models\Message;
$body->messages[0]->callbackUrl = 'https://my.callback.url.com';
$body->messages[0]->content = 'My first message';
$body->messages[0]->destinationNumber = '+61491570156';
$body->messages[0]->deliveryReport = true;
$body->messages[0]->format = Models\FormatEnum::SMS;
$body->messages[0]->messageExpiryTimestamp = DateTimeHelper::fromRfc3339DateTime('2016-11-03T11:49:02.807Z');
$body->messages[0]->metadata = MessageMediaMessagesLib\APIHelper::deserialize('{"key1":"value1","key2":"value2"}');
$body->messages[0]->scheduled = DateTimeHelper::fromRfc3339DateTime('2016-11-03T11:49:02.807Z');
$body->messages[0]->sourceNumber = '+61491570157';
$body->messages[0]->sourceNumberType = Models\SourceNumberTypeEnum::INTERNATIONAL;

try {
    $result = $messagesController->sendMessages($body);
    print_r($result);
} catch (Exceptions\SendMessages400Response $e) {
    echo 'Caught SendMessages400Response: ',  $e->getMessage(), "\n";
} catch (MessageMediaMessagesLib\APIException $e) {
    echo 'Caught APIException: ',  $e->getMessage(), "\n";
}
