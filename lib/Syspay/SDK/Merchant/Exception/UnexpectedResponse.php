<?php

/**
 * Exception thrown when the response received from the API could not be parsed
 */
class Syspay_Merchant_UnexpectedResponseException extends RuntimeException
{
    private $response;

    public function __construct($message = null, $response = null, $code = 0, $previous = null)
    {
        $this->response = $response;
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            parent::__construct($message, $code, $previous);
        } else {
            parent::__construct($message, $code);
        }
    }

    /**
     * Get the raw response
     * @return string Raw API response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
