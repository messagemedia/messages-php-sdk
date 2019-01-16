<?php

namespace MessageMediaMessagesLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class VendorAccountId implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @maps vendor_id
     * @var string|null $vendorId public property
     */
    public $vendorId;

    /**
     * The account used to submit the original message.
     * @maps account_id
     * @var string|null $accountId public property
     */
    public $accountId;

    /**
     * Constructor to set initial or default values of member properties
     * @param string $vendorId  Initialization value for $this->vendorId
     * @param string $accountId Initialization value for $this->accountId
     */
    public function __construct()
    {
        if (2 == func_num_args()) {
            $this->vendorId  = func_get_arg(0);
            $this->accountId = func_get_arg(1);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['vendor_id']  = $this->vendorId;
        $json['account_id'] = $this->accountId;

        return $json;
    }
}
