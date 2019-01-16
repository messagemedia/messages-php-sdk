<?php

namespace MessageMediaMessagesLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class ConfirmRepliesAsReceivedRequest1 implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @required
     * @maps reply_ids
     * @var array $replyIds public property
     */
    public $replyIds;

    /**
     * Constructor to set initial or default values of member properties
     * @param array $replyIds Initialization value for $this->replyIds
     */
    public function __construct()
    {
        if (1 == func_num_args()) {
            $this->replyIds = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['reply_ids'] = $this->replyIds;

        return $json;
    }
}
