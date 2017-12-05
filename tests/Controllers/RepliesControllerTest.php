<?php
/*
 * MessageMediaMessages
 *
 */

namespace MessageMediaMessagesLib\Tests;

use MessageMediaMessagesLib\APIException;
use MessageMediaMessagesLib\Exceptions;
use MessageMediaMessagesLib\APIHelper;
use MessageMediaMessagesLib\Models;

class RepliesControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \MessageMediaMessagesLib\Controllers\RepliesController Controller instance
     */
    protected static $controller;

    /**
     * @var HttpCallBackCatcher Callback
     */
    protected $httpResponse;

    /**
     * Setup test class
     */
    public static function setUpBeforeClass()
    {
        TestHelper::getAuthorizationFromEnvironment();
        $client = new \MessageMediaMessagesLib\MessageMediaMessagesClient();
        self::$controller = $client->getReplies();
    }

    /**
     * Setup test
     */
    protected function setUp()
    {
        $this->httpResponse = new HttpCallBackCatcher();
    }

    /**
     * Mark a reply message as confirmed so it is no longer returned in check replies requests.
The confirm replies endpoint is intended to be used in conjunction with the check replies endpoint
to allow for robust processing of reply messages. Once one or more reply messages have been processed
they can then be confirmed using the confirm replies endpoint so they are no longer returned in
subsequent check replies requests.
The confirm replies endpoint takes a list of reply IDs as follows:
```json
{
    "reply_ids": [
        "011dcead-6988-4ad6-a1c7-6b6c68ea628d",
        "3487b3fa-6586-4979-a233-2d1b095c7718",
        "ba28e94b-c83d-4759-98e7-ff9c7edb87a1"
    ]
}
```
Up to 100 replies can be confirmed in a single confirm replies request.
     */
    public function testConfirmRepliesAsReceived1()
    {
        // Parameters for the API call
        $body = APIHelper::deserialize(
            '{"reply_ids":["011dcead-6988-4ad6-a1c7-6b6c68ea628d","3487b3fa-6586-4979-a2'.
            '33-2d1b095c7718","ba28e94b-c83d-4759-98e7-ff9c7edb87a1"]}',
            new Models\ConfirmRepliesAsReceivedRequest()
        );

        // Set callback and perform API call
        $result = null;
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            $result = self::$controller->createConfirmRepliesAsReceived($body);
        } catch (APIException $e) {
        }

        // Test response code
        $this->assertEquals(
            202,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 202"
        );

        // Test headers
        $headers = [];
        $headers['Content-Type'] = null ;
        
        $this->assertTrue(
            TestHelper::areHeadersProperSubsetOf($headers, $this->httpResponse->getResponse()->getHeaders(), true),
            "Headers do not match"
        );
    }

    /**
     *  Make sure our SDK fails when passed an invalid account id
     */
    public function testConfirmRepliesAsReceived1WithDummyAccount()
    {
        // Parameters for the API call
        $body = APIHelper::deserialize(
            '{"reply_ids":["011dcead-6988-4ad6-a1c7-6b6c68ea628d","3487b3fa-6586-4979-a2'.
            '33-2d1b095c7718","ba28e94b-c83d-4759-98e7-ff9c7edb87a1"]}',
            new Models\ConfirmRepliesAsReceivedRequest()
        );

        // Set callback and perform API call
        $result = null;
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            self::$controller->createConfirmRepliesAsReceived($body,"INVALID ACCOUNT");
        } catch (APIException $e) {
            $this->assertEquals(403, $e->getResponseCode());
            $this->assertEquals("{\"message\":\"Invalid account 'INVALID ACCOUNT' in header Account\"}\n", $e->getResponseBody());
        }

        // Test response code
        $this->assertEquals(
            403,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 403"
        );
    }

    /**
     * Check for any replies that have been received.
        Replies are messages that have been sent from a handset in response to a message sent by an
        application or messages that have been sent from a handset to a inbound number associated with
        an account, known as a dedicated inbound number (contact <support@messagemedia.com> for more
        information on dedicated inbound numbers).
        Each request to the check replies endpoint will return any replies received that have not yet
        been confirmed using the confirm replies endpoint. A response from the check replies endpoint
        will have the following structure:
        ```json
        {
            "replies": [
                {
                    "metadata": {
                        "key1": "value1",
                        "key2": "value2"
                    },
                    "message_id": "877c19ef-fa2e-4cec-827a-e1df9b5509f7",
                    "reply_id": "a175e797-2b54-468b-9850-41a3eab32f74",
                    "date_received": "2016-12-07T08:43:00.850Z",
                    "callback_url": "https://my.callback.url.com",
                    "destination_number": "+61491570156",
                    "source_number": "+61491570157",
                    "vendor_account_id": {
                        "vendor_id": "MessageMedia",
                        "account_id": "MyAccount"
                    },
                    "content": "My first reply!"
                },
                {
                    "metadata": {
                        "key1": "value1",
                        "key2": "value2"
                    },
                    "message_id": "8f2f5927-2e16-4f1c-bd43-47dbe2a77ae4",
                    "reply_id": "3d8d53d8-01d3-45dd-8cfa-4dfc81600f7f",
                    "date_received": "2016-12-07T08:43:00.850Z",
                    "callback_url": "https://my.callback.url.com",
                    "destination_number": "+61491570157",
                    "source_number": "+61491570158",
                    "vendor_account_id": {
                        "vendor_id": "MessageMedia",
                        "account_id": "MyAccount"
                    },
                    "content": "My second reply!"
                }
            ]
        }
        ```
        Each reply will contain details about the reply message, as well as details of the message the reply was sent
        in response to, including any metadata specified. Every reply will have a reply ID to be used with the
        confirm replies endpoint.
        *Note: The source number and destination number properties in a reply are the inverse of those
        specified in the message the reply is in response to. The source number of the reply message is the
        same as the destination number of the original message, and the destination number of the reply
        message is the same as the source number of the original message. If a source number
        wasn't specified in the original message, then the destination number property will not be present
        in the reply message.*
        Subsequent requests to the check replies endpoint will return the same reply messages and a maximum
        of 100 replies will be returned in each request. Applications should use the confirm replies endpoint
        in the following pattern so that replies that have been processed are no longer returned in
        subsequent check replies requests.
        1. Call check replies endpoint
        2. Process each reply message
        3. Confirm all processed reply messages using the confirm replies endpoint
        *Note: It is recommended to use the Webhooks feature to receive reply messages rather than polling
        the check replies endpoint.*
     */
    public function testCheckReplies1()
    {

        // Set callback and perform API call
        $result = null;
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            $result = self::$controller->getCheckReplies();
        } catch (APIException $e) {
        }

        // Test response code
        $this->assertEquals(
            200,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 200"
        );

        // Test headers
        $headers = [];
        $headers['Content-Type'] = null ;
        
        $this->assertTrue(
            TestHelper::areHeadersProperSubsetOf($headers, $this->httpResponse->getResponse()->getHeaders(), true),
            "Headers do not match"
        );

        // Test whether the captured response is as we expected
        $this->assertNotNull($result, "Result does not exist");

        $this->assertStringStartsWith('{"replies":[', $this->httpResponse->getResponse()->getRawBody(),
            "Result should start with the replies JSON ");
    }

    /**
     *  Make sure our SDK fails when passed an invalid account id
     */
    public function testCheckRepliesWithDummyAccount()
    {
        // Set callback and perform API call
        $result = null;
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            $result = self::$controller->getCheckReplies("INVALID ACCOUNT");
        } catch (APIException $e) {
            $this->assertEquals(403, $e->getResponseCode());
            $this->assertEquals("{\"message\":\"Invalid account 'INVALID ACCOUNT' in header Account\"}\n", $e->getResponseBody());
        }

        // Test response code
        $this->assertEquals(
            403,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 403"
        );
    }
}
