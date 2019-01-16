<?php

namespace MessageMediaMessagesLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class CheckRepliesResponse implements JsonSerializable
{
    /**
     * The oldest 100 unconfirmed replies
     * @var \MessageMediaMessagesLib\Models\Reply[]|null $replies public property
     */
    public $replies;

    /**
     * Constructor to set initial or default values of member properties
     * @param array $replies Initialization value for $this->replies
     */
    public function __construct()
    {
        if (1 == func_num_args()) {
            $this->replies = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['replies'] = $this->replies;

        return $json;
    }
}
