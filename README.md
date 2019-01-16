# MessageMedia Messages PHP SDK
[![Pull Requests Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat)](http://makeapullrequest.com)
[![HitCount](http://hits.dwyl.io/messagemedia/messages-php-sdk.svg)](http://hits.dwyl.io/messagemedia/messages-php-sdk)
[![composer](https://badge.fury.io/ph/messagemedia%2Fmessages-sdk.svg)](https://packagist.org/packages/messagemedia/messages-sdk)

The MessageMedia Messages API provides a number of endpoints for building powerful two-way messaging applications.

![Isometric](https://i.imgur.com/jJeHwf5.png)

## Table of Contents
* [Authentication](#closed_lock_with_key-authentication)
* [Errors](#interrobang-errors)
* [Information](#newspaper-information)
  * [Slack and Mailing List](#slack-and-mailing-list)
  * [Bug Reports](#bug-reports)
  * [Contributing](#contributing)
* [Installation](#star-installation)
* [Get Started](#clapper-get-started)
* [API Documentation](#closed_book-api-documentation)
* [Need help?](#confused-need-help)
* [License](#page_with_curl-license)

## :closed_lock_with_key: Authentication

Authentication is done via API keys. Sign up at https://developers.messagemedia.com/register/ to get your API keys.

Requests are authenticated using HTTP Basic Auth or HMAC. For Basic Auth, your API key will be basicAuthUserName and API secret will be basicAuthPassword. For HMAC, your API key will be hmacAuthUserName and API secret will be hmacAuthPassword. This is demonstrated in the [Send Message example](#send-an-sms) below.

## :interrobang: Errors

Our API returns standard HTTP success or error status codes. For errors, we will also include extra information about what went wrong encoded in the response as JSON. The most common status codes are listed below.

#### HTTP Status Codes

| Code      | Title       | Description |
|-----------|-------------|-------------|
| 400 | Invalid Request | The request was invalid |
| 401 | Unauthorized | Your API credentials are invalid |
| 403 | Disabled feature | Feature not enabled |
| 404 | Not Found |	The resource does not exist |
| 50X | Internal Server Error | An error occurred with our API |

## :newspaper: Information

#### Slack and Mailing List

If you have any questions, comments, or concerns, please join our Slack channel:
https://developers.messagemedia.com/collaborate/slack/

Alternatively you can email us at:
developers@messagemedia.com

#### Bug reports

If you discover a problem with the SDK, we would like to know about it. You can raise an [issue](https://github.com/messagemedia/signingkeys-php-sdk/issues) or send an email to: developers@messagemedia.com

#### Contributing

We welcome your thoughts on how we could best provide you with SDKs that would simplify how you consume our services in your application. You can fork and create pull requests for any features you would like to see or raise an [issue](https://github.com/messagemedia/messages-php-sdk/issues). Please be aware that a large share of the files are auto-generated by our backend tool.

## :star: Installation
Run the Composer command to install the latest stable version of the Messages SDK:
```
composer require messagemedia/messages-sdk
```

## :clapper: Get Started
It's easy to get started. Simply enter the API Key and secret you obtained from the [MessageMedia Developers Portal](https://developers.messagemedia.com) into the code snippet below and a mobile number you wish to send to.

### Send an SMS
Destination numbers (`destinationNumber`) should be in the [E.164](http://en.wikipedia.org/wiki/E.164) format. For example, `+61491570156` NOT `0491570156`. The code snippet below comprises of only the bare minimum parameters required to send a message. You can view the full list of parameters over [here](https://github.com/messagemedia/messages-php-sdk/wiki/Message-Body-Parameters). Alternatively, you can refer this code snippet with all the parameters in use.

```php
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
$body->messages[0]->content = 'My first message';
$body->messages[0]->destinationNumber = '+61491570156';

try {
    $result = $messagesController->sendMessages($body);
    print_r($result);
} catch (Exceptions\SendMessages400Response $e) {
    echo 'Caught SendMessages400Response: ',  $e->getMessage(), "\n";
} catch (MessageMediaMessagesLib\APIException $e) {
    echo 'Caught APIException: ',  $e->getMessage(), "\n";
}
?>
```


### Send an MMS
Destination numbers (`destinationNumber`) should be in the [E.164](http://en.wikipedia.org/wiki/E.164) format. For example, `+61491570156` NOT `0491570156`. The code snippet below comprises of only the bare minimum parameters required to send a message. You can view the full list of parameters over [here](https://github.com/messagemedia/messages-nodejs-sdk/wiki/Message-Body-Parameters). Alternatively, you can refer this code snippet with all the parameters in use.

```php
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
$body->messages[0]->content = 'My second message';
$body->messages[0]->destinationNumber = '+61491570156';
$body->messages[0]->format = Models\FormatEnum::MMS;
$body->messages[0]->media = array('https://images.pexels.com/photos/1018350/pexels-photo-1018350.jpeg?cs=srgb&dl=architecture-buildings-city-1018350.jpg');
$body->messages[0]->subject = 'This is an MMS message';

try {
    $result = $messagesController->sendMessages($body);
    print_r($result);
} catch (Exceptions\SendMessages400Response $e) {
    echo 'Caught SendMessages400Response: ',  $e->getMessage(), "\n";
} catch (MessageMediaMessagesLib\APIException $e) {
    echo 'Caught APIException: ',  $e->getMessage(), "\n";
}
?>
```

### Get Status of a Message
You can get a messsage ID from a sent message by looking at the `message_id` from the response of the above example.

```php
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

$messageId = '877c19ef-fa2e-4cec-827a-e1df9b5509f7';

try {
    $result = $messagesController->getMessageStatus($messageId);
    print_r($result);
} catch (MessageMediaMessagesLib\APIException $e) {
    echo 'Caught APIException: ',  $e->getMessage(), "\n";
}
?>
```

### Get replies to a message
You can check for replies that are sent to your messages

```php
<?php
require_once "vendor/autoload.php";

use MessageMediaMessagesLib\Models;
use MessageMediaMessagesLib\Exceptions;

$authUserName = 'API_KEY';
$authPassword = 'API_SECRET';
/* You can change this to true when the above keys are HMAC */
$useHmacAuthentication = false;

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

$repliesController = $client->getReplies();

try {
    $result = $repliesController->checkReplies();
    print_r($result);
} catch (MessageMediaMessagesLib\APIException $e) {
    echo 'Caught APIException: ',  $e->getMessage(), "\n";
}
?>
```

### Check Delivery Reports
This endpoint allows you to check for delivery reports to inbound and outbound messages.

```php
<?php
require_once "vendor/autoload.php";

use MessageMediaMessagesLib\Models;
use MessageMediaMessagesLib\Exceptions;

$authUserName = 'API_KEY';
$authPassword = 'API_SECRET';
/* You can change this to true when the above keys are HMAC */
$useHmacAuthentication = false;

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

$deliveryReportsController = $client->getDeliveryReports();

try {
    $result = $deliveryReportsController->checkDeliveryReports();
    print_r($result);
} catch (MessageMediaMessagesLib\APIException $e) {
    echo 'Caught APIException: ',  $e->getMessage(), "\n";
}
?>
```

### Confirm Delivery Reports
This endpoint allows you to mark delivery reports as confirmed so they're no longer returned by the Check Delivery Reports function.

```php
<?php
require_once "vendor/autoload.php";

use MessageMediaMessagesLib\Models;
use MessageMediaMessagesLib\Exceptions;

$authUserName = 'API_KEY';
$authPassword = 'API_SECRET';
/* You can change this to true when the above keys are HMAC */
$useHmacAuthentication = false;

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

$deliveryReportsController = $client->getDeliveryReports();

$body = new Models\ConfirmDeliveryReportsAsReceivedRequest;
$body->deliveryReportIds = array('011dcead-6988-4ad6-a1c7-6b6c68ea628d', '3487b3fa-6586-4979-a233-2d1b095c7718', 'ba28e94b-c83d-4759-98e7-ff9c7edb87a1');

try {
    $result = $deliveryReportsController->confirmDeliveryReportsAsReceived($body);
    print_r($result);
} catch (MessageMediaMessagesLib\APIException $e) {
    echo 'Caught APIException: ',  $e->getMessage(), "\n";
}
?>
```

###  Check credits remaining (Prepaid accounts only)
This endpoint allows you to check for credits remaining on your prepaid account.

```php
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
?>
```

## :closed_book: API Reference Documentation
Check out the [full API documentation](https://developers.messagemedia.com/code/messages-api-documentation/) for more detailed information.

## :confused: Need help?
Please contact developer support at developers@messagemedia.com or check out the developer portal at [developers.messagemedia.com](https://developers.messagemedia.com/)

## :page_with_curl: License
Apache License. See the [LICENSE](LICENSE) file.
