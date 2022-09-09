<?php

declare(strict_types=1);

/*
 * MessagesLib
 *
 * This file was automatically generated by APIMATIC v3.0 ( https://www.apimatic.io ).
 */

namespace MessagesLib\Tests;

class ClientFactory
{
    public static function create(HttpCallBackCatcher $httpCallback): \MessagesLib\MessagesClient
    {
        $client = (new \MessagesLib\MessagesClient(static::getConfigurationFromEnvironment()))
            ->withConfiguration(static::getTestConfiguration($httpCallback));
        return $client;
    }

    public static function getTestConfiguration(HttpCallBackCatcher $httpCallback): array
    {
        return ['httpCallback' => $httpCallback];
    }

    public static function getConfigurationFromEnvironment(): array
    {
        $config = [];
        $timeout = getenv('MESSAGES_LIB_TIMEOUT');
        $numberOfRetries = getenv('MESSAGES_LIB_NUMBER_OF_RETRIES');
        $maximumRetryWaitTime = getenv('MESSAGES_LIB_MAXIMUM_RETRY_WAIT_TIME');
        $environment = getenv('MESSAGES_LIB_ENVIRONMENT');
        $basicAuthUserName = getenv('MESSAGES_LIB_BASIC_AUTH_USER_NAME');
        $basicAuthPassword = getenv('MESSAGES_LIB_BASIC_AUTH_PASSWORD');

        if ($timeout !== false && \is_numeric($timeout)) {
            $config['timeout'] = intval($timeout);
        }

        if ($numberOfRetries !== false && \is_numeric($numberOfRetries)) {
            $config['numberOfRetries'] = intval($numberOfRetries);
        }

        if ($maximumRetryWaitTime !== false && \is_numeric($maximumRetryWaitTime)) {
            $config['maximumRetryWaitTime'] = intval($maximumRetryWaitTime);
        }

        if ($environment !== false) {
            $config['environment'] = $environment;
        }

        if ($basicAuthUserName !== false) {
            $config['basicAuthUserName'] = $basicAuthUserName;
        }

        if ($basicAuthPassword !== false) {
            $config['basicAuthPassword'] = $basicAuthPassword;
        }

        return $config;
    }
}
