# MessageMedia Messages NodeJS SDK
[![Travis Build Status](https://api.travis-ci.org/messagemedia/messages-php-sdk.svg?branch=master)](https://travis-ci.org/messagemedia/messages-php-sdk)

The MessageMedia Messages API provides a number of endpoints for building powerful two-way messaging applications.

## ⭐️ Installing via Composer
Add the following to the dependencies section of your composer.json:
```json
{
    "require": {
        "messagemedia/messages-sdk": "1.0.0"
    },
    "repositories": [
        {
            "type": "vcs",
            "url":  "git@github.com:messagemedia/messages-php-sdk.git"
        }
    ]
}
```

## 🎬 Get Started
It's easy to get started. Simply enter the API Key and secret you obtained from the [MessageMedia Developers Portal](https://developers.messagemedia.com) into the code snippet below and a mobile number you wish to send to.

### 🚀 Send an SMS
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
         "content":"My first message",
         "destination_number":"YOUR_MOBILE_NUMBER"
      }
   ]
}';


$body = MessageMediaMessagesLib\APIHelper::deserialize($bodyValue);

$result = $messages->createSendMessages($body);
?>
```

## 📕 Documentation
The NodeJS SDK Documentation can be viewed [here](DOCUMENTATION.md)

## 😕 Got Stuck?
Please contact developer support at developers@messagemedia.com or check out the developer portal at [developers.messagemedia.com](https://developers.messagemedia.com/)
