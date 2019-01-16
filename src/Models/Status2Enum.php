<?php

namespace MessageMediaMessagesLib\Models;

/**
 * The status of the message as per the delivery report
 */
class Status2Enum
{
    /**
     * TODO: Write general description for this element
     */
    const ENROUTE = "enroute";

    /**
     * TODO: Write general description for this element
     */
    const FAILED = "failed";

    /**
     * TODO: Write general description for this element
     */
    const SUBMITTED = "submitted";

    /**
     * TODO: Write general description for this element
     */
    const DELIVERED = "delivered";

    /**
     * TODO: Write general description for this element
     */
    const EXPIRED = "expired";

    /**
     * TODO: Write general description for this element
     */
    const REJECTED = "rejected";

    /**
     * TODO: Write general description for this element
     */
    const UNDELIVERABLE = "undeliverable";
}
