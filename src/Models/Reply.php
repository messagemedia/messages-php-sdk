<?php

namespace MessageMediaMessagesLib\Models;

use JsonSerializable;
use MessageMediaMessagesLib\Utils\DateTimeHelper;

/**
 * @todo Write general description for this model
 */
class Reply implements JsonSerializable
{
    /**
     * The URL specified as the callback URL in the original submit message request
     * @maps callback_url
     * @var string|null $callbackUrl public property
     */
    public $callbackUrl;

    /**
     * Content of the reply
     * @var string|null $content public property
     */
    public $content;

    /**
     * Date time when the reply was received
     * @maps date_received
     * @factory \MessageMediaMessagesLib\Utils\DateTimeHelper::fromRfc3339DateTime
     * @var \DateTime|null $dateReceived public property
     */
    public $dateReceived;

    /**
     * Address from which this reply was sent to
     * @maps destination_number
     * @var string|null $destinationNumber public property
     */
    public $destinationNumber;

    /**
     * Unique ID of the original message
     * @maps message_id
     * @var string|null $messageId public property
     */
    public $messageId;

    /**
     * Any metadata that was included in the original submit message request
     * @var object|null $metadata public property
     */
    public $metadata;

    /**
     * Unique ID of this reply
     * @maps reply_id
     * @var string|null $replyId public property
     */
    public $replyId;

    /**
     * Address from which this reply was received from
     * @maps source_number
     * @var string|null $sourceNumber public property
     */
    public $sourceNumber;

    /**
     * @todo Write general description for this property
     * @maps vendor_account_id
     * @var \MessageMediaMessagesLib\Models\VendorAccountId|null $vendorAccountId public property
     */
    public $vendorAccountId;

    /**
     * Constructor to set initial or default values of member properties
     * @param string           $callbackUrl       Initialization value for $this->callbackUrl
     * @param string           $content           Initialization value for $this->content
     * @param \DateTime        $dateReceived      Initialization value for $this->dateReceived
     * @param string           $destinationNumber Initialization value for $this->destinationNumber
     * @param string           $messageId         Initialization value for $this->messageId
     * @param object           $metadata          Initialization value for $this->metadata
     * @param string           $replyId           Initialization value for $this->replyId
     * @param string           $sourceNumber      Initialization value for $this->sourceNumber
     * @param VendorAccountId  $vendorAccountId   Initialization value for $this->vendorAccountId
     */
    public function __construct()
    {
        if (9 == func_num_args()) {
            $this->callbackUrl       = func_get_arg(0);
            $this->content           = func_get_arg(1);
            $this->dateReceived      = func_get_arg(2);
            $this->destinationNumber = func_get_arg(3);
            $this->messageId         = func_get_arg(4);
            $this->metadata          = func_get_arg(5);
            $this->replyId           = func_get_arg(6);
            $this->sourceNumber      = func_get_arg(7);
            $this->vendorAccountId   = func_get_arg(8);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['callback_url']       = $this->callbackUrl;
        $json['content']            = $this->content;
        $json['date_received']      = isset($this->dateReceived) ?
            DateTimeHelper::toRfc3339DateTime($this->dateReceived) : null;
        $json['destination_number'] = $this->destinationNumber;
        $json['message_id']         = $this->messageId;
        $json['metadata']           = $this->metadata;
        $json['reply_id']           = $this->replyId;
        $json['source_number']      = $this->sourceNumber;
        $json['vendor_account_id']  = $this->vendorAccountId;

        return $json;
    }
}
