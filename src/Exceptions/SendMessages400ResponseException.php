<?php


namespace MessageMediaMessagesLib\Exceptions;

use MessageMediaMessagesLib\APIException;
use MessageMediaMessagesLib\APIHelper;

/**
 * @todo Write general description for this model
 */
class SendMessages400ResponseException extends APIException
{
    /**
     * @todo Write general description for this property
     * @required
     * @var string $message public property
     */
    public $message;

    /**
     * Constructor to set initial or default values of member properties
     */
    public function __construct($reason, $context)
    {
        parent::__construct($reason, $context);
    }

    /**
     * Unbox response into this exception class
     */
    public function unbox()
    {
        APIHelper::deserialize(self::getResponseBody(), $this, false, false);
    }
}
