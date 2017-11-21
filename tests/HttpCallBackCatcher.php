<?php
/*
 * MessageMediaMessages
 *
 */

namespace MessageMediaMessagesLib\Tests;

use MessageMediaMessagesLib\Http\HttpCallBack;

/**
 * An HTTPCallBack that captures the request and response for use later
 */
class HttpCallBackCatcher extends HttpCallBack
{
    /**
     * Http request
     * @var MessageMediaMessagesLib\Http\HttpRequest
     */
    private $request;

    /**
     * Http Response
     * @var MessageMediaMessagesLib\Http\HttpResponse
     */
    private $response;

    /**
     * Create instance
     */
    public function __construct()
    {
        $instance = $this;
        parent::__construct(null, function ($httpContext) use ($instance) {
            $instance->request = $httpContext->getRequest();
            $instance->response = $httpContext->getResponse();
        });
    }

    /**
     * Get the HTTP Request object associated with this API call
     * @return MessageMediaMessagesLib\Http\HttpRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get the HTTP Response object associated with this API call
     * @return MessageMediaMessagesLib\Http\HttpResponse
     */
    public function getResponse()
    {
        return $this->response;
    }
}
