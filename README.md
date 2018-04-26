# MessageMedia Messages PHP SDK
[![Travis Build Status](https://api.travis-ci.org/messagemedia/messages-php-sdk.svg?branch=master)](https://travis-ci.org/messagemedia/messages-php-sdk)
[![composer](https://badge.fury.io/ph/messagemedia%2Fmessages-sdk.svg)](https://packagist.org/packages/messagemedia/messages-sdk)

The MessageMedia Messages API provides a number of endpoints for building powerful two-way messaging applications.

## ⭐️ Installing via Composer
Run the Composer command to install the latest stable version of the Messages SDK:
```
composer require messagemedia/messages-sdk
```

## 🎬 Get Started
It's easy to get started. Simply enter the API Key and secret you obtained from the [MessageMedia Developers Portal](https://developers.messagemedia.com) into the code snippet below and a mobile number you wish to send to.

### 🚀 Send an SMS
* Destination numbers (`destination_number`) should be in the [E.164](http://en.wikipedia.org/wiki/E.164) format. For example, `+61491570156`.
```php
<?php
require_once "vendor/autoload.php";

use MessageMediaMessagesLib\MessageMediaMessagesClient;
use MessageMediaMessagesLib\APIHelper;

$authUserName = 'YOUR_API_KEY'; // The API key to use with basic/HMAC authentication
$authPassword = 'YOUR_API_SECRET'; // The API secret to use with basic/HMAC authentication
$useHmacAuthentication = false; // Change to true if you are using HMAC keys

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

$messages = $client->getMessages();

$bodyValue = '{
   "messages":[
      {
         "content":"My first message",
         "destination_number":"YOUR_MOBILE_NUMBER"
      }
   ]
}';


$body = MessageMediaMessagesLib\APIHelper::deserialize($bodyValue);

$result = $messages->createSendMessages($body);
?>
```


### 🖼 Send an MMS
* Destination numbers (`destination_number`) should be in the [E.164](http://en.wikipedia.org/wiki/E.164) format. For example, `+61491570156`.
```php
<?php
require_once "vendor/autoload.php";

$basicAuthUserName = 'YOUR_API_KEY'; // The username to use with basic authentication
$basicAuthPassword = 'YOUR_API_SECRET'; // The password to use with basic authentication

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($basicAuthUserName, $basicAuthPassword);

$messages = $client->getMessages();

$bodyValue = '
{
   "messages":[
     {
        "content":"Test",
        "destination_number":"YOUR_MOBILE_NUMBER",
        "format": "MMS",
        "media":["https://upload.wikimedia.org/wikipedia/commons/6/6a/L80385-flash-superhero-logo-1544.png"]
     }
   ]
}
';


$body = MessageMediaMessagesLib\APIHelper::deserialize($bodyValue);


$result = $messages->createSendMessages($body);
}

?>
```

### 🕓 Get Status of a Message
You can get a messsage ID from a sent message by looking at the `message_id` from the response of the above example.
```php
<?php
require_once "vendor/autoload.php";

use MessageMediaMessagesLib\MessageMediaMessagesClient;

$authUserName = 'YOUR_API_KEY'; // The API key to use with basic/HMAC authentication
$authPassword = 'YOUR_API_SECRET'; // The API secret to use with basic/HMAC authentication
$useHmacAuthentication = false; // Change to true if you are using HMAC keys

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

$messages = $client->getMessages();

$messageId = 'YOUR_MESSAGE_ID'; // The message id for the message you wish to get the status for

$result = $messages->getMessageStatus($messageId);
print_r($result);
?>
```

### 💬 Get replies to a message
You can check for replies that are sent to your messages
```php
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
```

### ✅ Check Delivery Reports
This endpoint allows you to check for delivery reports to inbound and outbound messages.
```php
<?php
require_once "vendor/autoload.php";

use MessageMediaMessagesLib\MessageMediaMessagesClient;

$authUserName = 'YOUR_API_KEY'; // The API key to use with basic/HMAC authentication
$authPassword = 'YOUR_API_SECRET'; // The API secret to use with basic/HMAC authentication
$useHmacAuthentication = false; // Change to true if you are using HMAC keys

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

$deliveryReports = $client->getDeliveryReports();


$result = $deliveryReports->getCheckDeliveryReports();
print_r($result);
?>
```

## 📕 Documentation
Check out the [full API documentation](DOCUMENTATION.md) for more detailed information.

## 😕 Need help?
Please contact developer support at developers@messagemedia.com or check out the developer portal at [developers.messagemedia.com](https://developers.messagemedia.com/)

## 📃 License
Apache License. See the [LICENSE](LICENSE) file.
