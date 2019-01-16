<?php


namespace MessageMediaMessagesLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class SendMessagesRequest implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @required
     * @var \MessageMediaMessagesLib\Models\Message[] $messages public property
     */
    public $messages;

    /**
     * Constructor to set initial or default values of member properties
     * @param array $messages Initialization value for $this->messages
     */
    public function __construct()
    {
        if (1 == func_num_args()) {
            $this->messages = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['messages'] = $this->messages;

        return $json;
    }
}
