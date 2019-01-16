<?php


namespace MessageMediaMessagesLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class ConfirmDeliveryReportsAsReceivedRequest1 implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @required
     * @maps delivery_report_ids
     * @var array $deliveryReportIds public property
     */
    public $deliveryReportIds;

    /**
     * Constructor to set initial or default values of member properties
     * @param array $deliveryReportIds Initialization value for $this->deliveryReportIds
     */
    public function __construct()
    {
        if (1 == func_num_args()) {
            $this->deliveryReportIds = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['delivery_report_ids'] = $this->deliveryReportIds;

        return $json;
    }
}
