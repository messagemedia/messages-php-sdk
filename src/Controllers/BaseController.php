<?php
/*
 * MessageMediaMessages
 *
 */

namespace MessageMediaMessagesLib\Controllers;

use MessageMediaMessagesLib\Configuration;
use MessageMediaMessagesLib\Http\HttpCallBack;
use MessageMediaMessagesLib\Http\HttpContext;
use MessageMediaMessagesLib\Http\HttpResponse;
use MessageMediaMessagesLib\APIException;
use \apimatic\jsonmapper\JsonMapper;
use Unirest\Request;

/**
* Base controller
*/
class BaseController
{
    public static $UserAgent = 'messagemedia-messages-php-sdk-1.1.0';


    /**
     * HttpCallBack instance associated with this controller
     * @var HttpCallBack
     */
    private $httpCallBack = null;

     /**
     * Constructor that sets the timeout of requests
     */

    /**
     * Set HttpCallBack for this controller
     * @param HttpCallBack $httpCallBack Http Callbacks called before/after each API call
     */
    public function setHttpCallBack(HttpCallBack $httpCallBack)
    {
        $this->httpCallBack = $httpCallBack;
    }

    /**
     * Get HttpCallBack for this controller
     * @return HttpCallBack The HttpCallBack object set for this controller
     */
    public function getHttpCallBack()
    {
        return $this->httpCallBack;
    }

    /**
     * Get a new JsonMapper instance for mapping objects
     * @return \apimatic\jsonmapper\JsonMapper JsonMapper instance
     */
    protected function getJsonMapper()
    {
        $mapper = new JsonMapper();
        return $mapper;
    }

    protected function addAccountHeaderTo($headers, $accountHeaderValue = null)
    {
        if ($accountHeaderValue != null)
        {
            $headers["Account"] = $accountHeaderValue;
        }

        return $headers;
    }

    protected function validateResponse(HttpResponse $response, HttpContext $_httpContext)
    {
        if (($response->getStatusCode() < 200) || ($response->getStatusCode() > 208))
        { //[200,208] = HTTP OK
            throw new APIException('HTTP Response Not OK', $_httpContext);
        }
    }

    protected function addAuthorizationHeadersTo($headers, $url, $body = null)
    {
        if($this->hmacIsConfigured())
        {
            return $this->addHmacHeadersTo($headers, $url, $body);
        }
        else
        {

            if(strlen(Configuration::$basicAuthUserName) !== 20 || strlen(Configuration::$basicAuthPassword) !== 30) {
              echo "~~~~~ It appears as though your REST API Keys are invalid. Please check and make sure they are correct. ~~~~~";
            }

            Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

            return $headers;
        }
    }


    protected function addHmacHeadersTo($headers, $url, $body = null)
    {
        if(!$this->hmacIsConfigured())
        {
            return $headers;
        }

        $contentSignature = "";
        $dateHeader = gmdate('D, d M Y H:i:s T');
        $authContent = "";

        if($body != null)
        {
            $contentHash = md5($body);
            $contentSignature = "x-content-md5: ".$contentHash."\n";
            $authContent = "x-content-md5 ";
            $headers["x-content-md5"] = $contentHash;
        }

        $headers["date"] = $dateHeader;

        $signature = $this->getHmacEncodingFor($dateHeader, $contentSignature, $body, $url, $headers);

        $authorizationHeader = "hmac username=\"".Configuration::$hmacAuthUserName."\", algorithm=\"hmac-sha1\", ".
                                "headers=\"date ".$authContent."request-line\", signature=\"".$signature."\"";

        $headers["Authorization"] = $authorizationHeader;

        return $headers;
    }

    private function getHmacEncodingFor($date, $contentSignature, $body, $url, $headers)
    {
        $requestType = "GET";

        if($body != null)
        {
            $requestType = "POST";
        }

        $signingString = "date: ".$date."\n".$contentSignature.$requestType." ".$url." HTTP/1.1";

        return base64_encode(hash_hmac('sha1', $signingString, Configuration::$hmacAuthPassword, true));
    }

    private function hmacIsConfigured()
    {
        return Configuration::$hmacAuthUserName != null && Configuration::$hmacAuthPassword != null;
    }
}
