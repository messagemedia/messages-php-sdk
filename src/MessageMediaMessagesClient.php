<?php
/*
 * MessageMediaMessages
 *
 */

namespace MessageMediaMessagesLib;

use MessageMediaMessagesLib\Controllers;

/**
 * MessageMediaMessages client class
 */
class MessageMediaMessagesClient
{
    /**
     * Constructor with authentication and configuration parameters
     */
    public function __construct(
        $basicAuthUserName = null,
        $basicAuthPassword = null
    ) {
        Configuration::$basicAuthUserName = $basicAuthUserName ? $basicAuthUserName : Configuration::$basicAuthUserName;
        Configuration::$basicAuthPassword = $basicAuthPassword ? $basicAuthPassword : Configuration::$basicAuthPassword;
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
