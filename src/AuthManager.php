<?php


namespace MessageMediaMessagesLib;

use Unirest\Request;

/**
 * Authentication manager
 */
class AuthManager
{
    public static function apply($headers, $url, $body = null)
    {
        if (static::isHmacConfigured()) {
            return static::addHmacHeadersTo($headers, $url, $body);
        } else {
            Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);
            return $headers;
        }
    }


    private static function addHmacHeadersTo($headers, $url, $body = null)
    {
        if (!static::isHmacConfigured()) {
            return $headers;
        }

        $contentSignature = "";
        $dateHeader = gmdate('D, d M Y H:i:s T');
        $authContent = "";

        if ($body != null) {
            $contentHash = md5($body);
            $contentSignature = "x-content-md5: ".$contentHash."\n";
            $authContent = "x-content-md5 ";
            $headers["x-content-md5"] = $contentHash;
        }

        $headers["date"] = $dateHeader;

        $signature = static::getHmacEncodingFor($dateHeader, $contentSignature, $body, $url, $headers);

        $authorizationHeader = "hmac username=\"". Configuration::$hmacAuthUserName . "\", algorithm=\"hmac-sha1\", " .
                                "headers=\"date " . $authContent . "request-line\", signature=\"" . $signature . "\"";

        $headers["Authorization"] = $authorizationHeader;

        return $headers;
    }

    private static function getHmacEncodingFor($date, $contentSignature, $body, $url, $headers)
    {
        $requestType = "GET";

        if ($body != null) {
            $requestType = "POST";
        }

        $signingString = "date: " . $date . "\n" . $contentSignature . $requestType . " " . $url . " HTTP/1.1";

        return base64_encode(hash_hmac('sha1', $signingString, Configuration::$hmacAuthPassword, true));
    }

    private static function isHmacConfigured()
    {
        return Configuration::$hmacAuthUserName != null && Configuration::$hmacAuthPassword != null;
    }
}
