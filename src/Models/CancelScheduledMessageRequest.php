<?php

namespace MessageMediaMessagesLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class CancelScheduledMessageRequest implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @required
     * @var string $status public property
     */
    public $status;

    /**
     * Constructor to set initial or default values of member properties
     * @param string $status Initialization value for $this->status
     */
    public function __construct()
    {
        switch (func_num_args()) {
            case 1:
                $this->status = func_get_arg(0);
                break;

            default:
                $this->status = 'cancelled';
                break;
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['status'] = $this->status;

        return $json;
    }
}
