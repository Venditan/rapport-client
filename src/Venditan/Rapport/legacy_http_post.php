<?php

namespace Venditan\Rapport;

/**
 * Send a request using the response headers available before PHP 8.4.
 *
 * @param string $endpoint
 * @param resource $context
 * @return array
 */
function legacyHttpPost($endpoint, $context)
{
    $response = file_get_contents($endpoint, false, $context);

    return [
        'headers' => isset($http_response_header) ? $http_response_header : null,
        'response' => trim($response),
    ];
}
