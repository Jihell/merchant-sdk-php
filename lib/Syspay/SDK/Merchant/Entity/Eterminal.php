<?php

/**
 * An Eterminal instance
 */
class Syspay_Merchant_Entity_Eterminal extends Syspay_Merchant_Entity
{
    /**
     * The full URL to the Eterminal instance
     * @var string
     */
    private $url;

    /**
     * {@inheritDoc}
     */
    public static function buildFromResponse(stdClass $response)
    {
        $eterminal = new self();
        $eterminal->setUrl(isset($response->url)?$response->url:null);
        return $eterminal;
    }

    /**
     * Gets the The full URL to the eterminal instance
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the The full URL to the eterminal instance
     *
     * @param string $url The url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}
