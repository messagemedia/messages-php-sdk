<?php

namespace MessageMediaMessagesLib;

use MessageMediaMessagesLib\Controllers;

/**
 * MessageMediaMessages client class
 */
class MessageMediaMessagesClient
{
    /**
     * Constructor with authentication and configuration parameters
     * @param null $authUserName
     * @param null $authPassword
     * @param bool $useHmacAuthentication
     */
    public function __construct(
        $authUserName = null,
        $authPassword = null,
        $useHmacAuthentication = false
    ) {
        if ($useHmacAuthentication) {
            Configuration::$hmacAuthUserName = $authUserName ? $authUserName : Configuration::$hmacAuthUserName;
            Configuration::$hmacAuthPassword = $authPassword ? $authPassword : Configuration::$hmacAuthPassword;
        } else {
            Configuration::$basicAuthUserName = $authUserName ? $authUserName : Configuration::$basicAuthUserName;
            Configuration::$basicAuthPassword = $authPassword ? $authPassword : Configuration::$basicAuthPassword;
        }
    }

    /**
     * Singleton access to Messages controller
     * @return Controllers\MessagesController The *Singleton* instance
     */
    public function getMessages()
    {
        return Controllers\MessagesController::getInstance();
    }
    /**
     * Singleton access to DeliveryReports controller
     * @return Controllers\DeliveryReportsController The *Singleton* instance
     */
    public function getDeliveryReports()
    {
        return Controllers\DeliveryReportsController::getInstance();
    }
    /**
     * Singleton access to Replies controller
     * @return Controllers\RepliesController The *Singleton* instance
     */
    public function getReplies()
    {
        return Controllers\RepliesController::getInstance();
    }
}
