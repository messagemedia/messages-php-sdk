<?php


namespace MessageMediaMessagesLib\Models;

use JsonSerializable;
use MessageMediaMessagesLib\Utils\DateTimeHelper;

/**
 * @todo Write general description for this model
 */
class DeliveryReport implements JsonSerializable
{
    /**
     * The URL specified as the callback URL in the original submit message request
     * @maps callback_url
     * @var string|null $callbackUrl public property
     */
    public $callbackUrl;

    /**
     * The date and time at which this delivery report was generated in UTC.
     * @maps date_received
     * @factory \MessageMediaMessagesLib\Utils\DateTimeHelper::fromRfc3339DateTime
     * @var \DateTime|null $dateReceived public property
     */
    public $dateReceived;

    /**
     * Deprecated, no longer in use
     * @var integer|null $delay public property
     */
    public $delay;

    /**
     * Unique ID for this delivery report
     * @maps delivery_report_id
     * @var string|null $deliveryReportId public property
     */
    public $deliveryReportId;

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
     * Text of the original message.
     * @maps original_text
     * @var string|null $originalText public property
     */
    public $originalText;

    /**
     * Address from which this delivery report was received
     * @maps source_number
     * @var string|null $sourceNumber public property
     */
    public $sourceNumber;

    /**
     * The status of the message as per the delivery report
     * @var string|null $status public property
     */
    public $status;

    /**
     * The date and time when the message status changed in UTC. For a delivered DR this may indicate the
     * time at which the message was received on the handset.
     * @maps submitted_date
     * @factory \MessageMediaMessagesLib\Utils\DateTimeHelper::fromRfc3339DateTime
     * @var \DateTime|null $submittedDate public property
     */
    public $submittedDate;

    /**
     * @todo Write general description for this property
     * @maps vendor_account_id
     * @var \MessageMediaMessagesLib\Models\VendorAccountId|null $vendorAccountId public property
     */
    public $vendorAccountId;

    /**
     * Constructor to set initial or default values of member properties
     * @param string           $callbackUrl      Initialization value for $this->callbackUrl
     * @param \DateTime        $dateReceived     Initialization value for $this->dateReceived
     * @param integer          $delay            Initialization value for $this->delay
     * @param string           $deliveryReportId Initialization value for $this->deliveryReportId
     * @param string           $messageId        Initialization value for $this->messageId
     * @param object           $metadata         Initialization value for $this->metadata
     * @param string           $originalText     Initialization value for $this->originalText
     * @param string           $sourceNumber     Initialization value for $this->sourceNumber
     * @param string           $status           Initialization value for $this->status
     * @param \DateTime        $submittedDate    Initialization value for $this->submittedDate
     * @param VendorAccountId  $vendorAccountId  Initialization value for $this->vendorAccountId
     */
    public function __construct()
    {
        if (11 == func_num_args()) {
            $this->callbackUrl      = func_get_arg(0);
            $this->dateReceived     = func_get_arg(1);
            $this->delay            = func_get_arg(2);
            $this->deliveryReportId = func_get_arg(3);
            $this->messageId        = func_get_arg(4);
            $this->metadata         = func_get_arg(5);
            $this->originalText     = func_get_arg(6);
            $this->sourceNumber     = func_get_arg(7);
            $this->status           = func_get_arg(8);
            $this->submittedDate    = func_get_arg(9);
            $this->vendorAccountId  = func_get_arg(10);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['callback_url']       = $this->callbackUrl;
        $json['date_received']      = isset($this->dateReceived) ?
            DateTimeHelper::toRfc3339DateTime($this->dateReceived) : null;
        $json['delay']              = $this->delay;
        $json['delivery_report_id'] = $this->deliveryReportId;
        $json['message_id']         = $this->messageId;
        $json['metadata']           = $this->metadata;
        $json['original_text']      = $this->originalText;
        $json['source_number']      = $this->sourceNumber;
        $json['status']             = $this->status;
        $json['submitted_date']     = isset($this->submittedDate) ?
            DateTimeHelper::toRfc3339DateTime($this->submittedDate) : null;
        $json['vendor_account_id']  = $this->vendorAccountId;

        return $json;
    }
}
