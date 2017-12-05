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
     * @param null $authUserName
     * @param null $authPassword
     * @param bool $useHmacAuthentication
     */
    public function __construct(
        $authUserName = null,
        $authPassword = null,
        $useHmacAuthentication = false
    ) {
        if($useHmacAuthentication)
        {
            Configuration::$hmacAuthUserName = $authUserName ? $authUserName : Configuration::$hmacAuthUserName;
            Configuration::$hmacAuthPassword = $authPassword ? $authPassword : Configuration::$hmacAuthPassword;
        }
        else
        {
            Configuration::$basicAuthUserName = $authUserName ? $authUserName : Configuration::$basicAuthUserName;
            Configuration::$basicAuthPassword = $authPassword ? $authPassword : Configuration::$basicAuthPassword;
        }
    }

    /**
     * Singleton access to Messages controller
     *
     * @param null $accountHeaderValue The optional value for the Account header
     * @return Controllers\MessagesController The *Singleton* instance
     */
    public function getMessages($accountHeaderValue = null)
    {
        return Controllers\MessagesController::getInstance($accountHeaderValue);
    }
    /**
     * Singleton access to DeliveryReports controller
     *
     * @param null $accountHeaderValue The optional value for the Account header
     * @return Controllers\DeliveryReportsController The *Singleton* instance
     */
    public function getDeliveryReports($accountHeaderValue = null)
    {
        return Controllers\DeliveryReportsController::getInstance($accountHeaderValue);
    }
    /**
     * Singleton access to Replies controller
     *
     * @param null $accountHeaderValue The optional value for the Account header
     * @return Controllers\RepliesController The *Singleton* instance
     */
    public function getReplies($accountHeaderValue = null)
    {
        return Controllers\RepliesController::getInstance($accountHeaderValue );
    }
}
