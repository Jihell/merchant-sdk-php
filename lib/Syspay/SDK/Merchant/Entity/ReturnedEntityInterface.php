<?php

/**
 * Entities that are built based on an API call response must implement this
 */
interface Syspay_Merchant_Entity_ReturnedEntityInterface
{
    /**
     * Creates an entity using the data provided by the API
     * (turned into an stdCalass)
     *
     * @param  stdClass $response The raw response data
     *
     * @return self
     */
    public static function buildFromResponse(stdClass $response);
}
