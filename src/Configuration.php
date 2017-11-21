<?php
/*
 * MessageMediaMessages
 *
 */

namespace MessageMediaMessagesLib;

/**
 * All configuration including auth info and base URI for the API access
 * are configured in this class.
 */
class Configuration
{
    /**
     * The base Uri for API calls
     * @var string
     */
    public static $BASEURI = 'https://api.messagemedia.com';

    /**
     * The username to use with basic authentication
     * @var string
     */
    public static $basicAuthUserName = 'TODO: Replace';

    /**
     * The password to use with basic authentication
     * @var string
     */
    public static $basicAuthPassword = 'TODO: Replace';
}
