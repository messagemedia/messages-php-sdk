<?php

namespace MessageMediaMessagesLib\Models;

use JsonSerializable;
use MessageMediaMessagesLib\Utils\DateTimeHelper;

/**
 * @todo Write general description for this model
 */
class Message implements JsonSerializable
{
    /**
     * URL replies and delivery reports to this message will be pushed to
     * @maps callback_url
     * @var string|null $callbackUrl public property
     */
    public $callbackUrl;

    /**
     * Content of the message
     * @required
     * @var string $content public property
     */
    public $content;

    /**
     * Destination number of the message
     * @required
     * @maps destination_number
     * @var string $destinationNumber public property
     */
    public $destinationNumber;

    /**
     * Request a delivery report for this message
     * @maps delivery_report
     * @var bool|null $deliveryReport public property
     */
    public $deliveryReport;

    /**
     * Format of message, SMS or TTS (Text To Speech).
     * @var string|null $format public property
     */
    public $format;

    /**
     * Date time after which the message expires and will not be sent
     * @maps message_expiry_timestamp
     * @factory \MessageMediaMessagesLib\Utils\DateTimeHelper::fromRfc3339DateTime
     * @var \DateTime|null $messageExpiryTimestamp public property
     */
    public $messageExpiryTimestamp;

    /**
     * Metadata for the message specified as a set of key value pairs, each key can be up to 100 characters
     * long and each value can be up to 256 characters long
     * ```
     * {
     * "myKey": "myValue",
     * "anotherKey": "anotherValue"
     * }
     * ```
     * @var object|null $metadata public property
     */
    public $metadata;

    /**
     * Scheduled delivery date time of the message
     * @factory \MessageMediaMessagesLib\Utils\DateTimeHelper::fromRfc3339DateTime
     * @var \DateTime|null $scheduled public property
     */
    public $scheduled;

    /**
     * @todo Write general description for this property
     * @maps source_number
     * @var string|null $sourceNumber public property
     */
    public $sourceNumber;

    /**
     * Type of source address specified, this can be INTERNATIONAL, ALPHANUMERIC or SHORTCODE
     * @maps source_number_type
     * @var string|null $sourceNumberType public property
     */
    public $sourceNumberType;

    /**
     * Unique ID of this message
     * @maps message_id
     * @var string|null $messageId public property
     */
    public $messageId;

    /**
     * The status of the message
     * @var string|null $status public property
     */
    public $status;

    /**
     * The media is used to specify the url of the media file that you are trying to send. Supported file
     * formats include png, jpeg and gif. format parameter must be set to MMS for this to work.
     * @var array|null $media public property
     */
    public $media;

    /**
     * The subject field is used to denote subject of the MMS message and has a maximum size of 64
     * characters long
     * @var string|null $subject public property
     */
    public $subject;

    /**
     * Constructor to set initial or default values of member properties
     * @param string    $callbackUrl            Initialization value for $this->callbackUrl
     * @param string    $content                Initialization value for $this->content
     * @param string    $destinationNumber      Initialization value for $this->destinationNumber
     * @param bool      $deliveryReport         Initialization value for $this->deliveryReport
     * @param string    $format                 Initialization value for $this->format
     * @param \DateTime $messageExpiryTimestamp Initialization value for $this->messageExpiryTimestamp
     * @param object    $metadata               Initialization value for $this->metadata
     * @param \DateTime $scheduled              Initialization value for $this->scheduled
     * @param string    $sourceNumber           Initialization value for $this->sourceNumber
     * @param string    $sourceNumberType       Initialization value for $this->sourceNumberType
     * @param string    $messageId              Initialization value for $this->messageId
     * @param string    $status                 Initialization value for $this->status
     * @param array     $media                  Initialization value for $this->media
     * @param string    $subject                Initialization value for $this->subject
     */
    public function __construct()
    {
        switch (func_num_args()) {
            case 14:
                $this->callbackUrl            = func_get_arg(0);
                $this->content                = func_get_arg(1);
                $this->destinationNumber      = func_get_arg(2);
                $this->deliveryReport         = func_get_arg(3);
                $this->format                 = func_get_arg(4);
                $this->messageExpiryTimestamp = func_get_arg(5);
                $this->metadata               = func_get_arg(6);
                $this->scheduled              = func_get_arg(7);
                $this->sourceNumber           = func_get_arg(8);
                $this->sourceNumberType       = func_get_arg(9);
                $this->messageId              = func_get_arg(10);
                $this->status                 = func_get_arg(11);
                $this->media                  = func_get_arg(12);
                $this->subject                = func_get_arg(13);
                break;

            default:
                $this->deliveryReport = false;
                break;
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        if ($this->callbackUrl != null){
          $json['callback_url']           = $this->callbackUrl;
        }
        $json['content']                  = $this->content;
        $json['destination_number']       = $this->destinationNumber;
        if ($this->deliveryReport != null){
          $json['delivery_report']        = $this->deliveryReport;
        }
        if ($this->format != null){
          $json['format']                 = $this->format;
        }
        if ($this->messageExpiryTimestamp != null){
          $json['message_expiry_timestamp'] = isset($this->messageExpiryTimestamp) ?
            DateTimeHelper::toRfc3339DateTime($this->messageExpiryTimestamp) : null;
        }
        if ($this->metadata != null){
          $json['metadata']               = $this->metadata;
        }
        $json['scheduled']                = isset($this->scheduled) ?
            DateTimeHelper::toRfc3339DateTime($this->scheduled) : null;
        if ($this->sourceNumber != null){
          $json['source_number']          = $this->sourceNumber;
        }
        if ($this->sourceNumberType != null){
          $json['source_number_type']     = $this->sourceNumberType;
        }
        if ($this->messageId != null){
          $json['message_id']             = $this->messageId;
        }
        if ($this->status != null){
          $json['status']                 = $this->status;
        }
        if ($this->media != null){
          $json['media']                  = $this->media;
        }
        if ($this->subject != null){
          $json['subject']                = $this->subject;
        }

        return $json;
    }
}
