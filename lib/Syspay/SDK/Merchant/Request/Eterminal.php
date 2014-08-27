<?php

/**
 * Create an eterminal instance
 *
 * @see https://app.syspay.com/bundles/emiuser/doc/merchant_eterminal.html
 */
class Syspay_Merchant_EterminalRequest extends Syspay_Merchant_Request
{
    const METHOD = 'POST';
    const PATH   = '/api/v1/merchant/eterminal';

    const TYPE_ONESHOT         = 'ONESHOT';
    const TYPE_SUBSCRIPTION    = 'SUBSCRIPTION';
    const TYPE_PAYMENT_PLAN    = 'PAYMENT_PLAN';
    const TYPE_PAYMENT_MANDATE = 'PAYMENT_MANDATE';

    /**
     * @var integer
     */
    protected $website;

    /**
     * @var boolean
     */
    protected $locked;

    /**
     * @var string
     */
    protected $emsUrl;

    /**
     * @var string
     */
    protected $paymentRedirectUrl;

    /**
     * @var string
     */
    protected $eterminalRedirectUrl;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var array
     */
    protected $customer;

    /**
     * @var array
     */
    protected $oneshot;

    /**
     * @var array
     */
    protected $subscription;

    /**
     * @var array
     */
    protected $paymentPlan;

    /**
     * @var array
     */
    protected $paymentMandate;

    /**
     * @var integer
     */
    protected $allowedRetries;


    /**
     * {@inheritDoc}
     */
    public function getMethod()
    {
        return self::METHOD;
    }

    /**
     * {@inheritDoc}
     */
    public function getPath()
    {
        return sprintf(self::PATH);
    }

    /**
     * {@inheritDoc}
     */
    public function buildResponse(stdClass $response)
    {
        if (!isset($response->eterminal)) {
            throw new Syspay_Merchant_UnexpectedResponseException(
                'Unable to retrieve "eterminal" data from response',
                $response
            );
        }

        $eterminal = Syspay_Merchant_Entity_Eterminal::buildFromResponse($response->eterminal);

        return $eterminal;
    }

    /**
     * Gets the value of website.
     *
     * @return integer
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Sets the value of website.
     *
     * @param integer $website the website id
     *
     * @return self
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }


    /**
     * Gets the value of allowedRetries.
     *
     * @return integer
     */
    public function getAllowedRetries()
    {
        return $this->allowedRetries;
    }

    /**
     * Sets the value of allowedRetries.
     *
     * @param integer $allowedRetries
     *
     * @return self
     */
    public function setAllowedRetries($allowedRetries)
    {
        $this->allowedRetries = $allowedRetries;

        return $this;
    }



    /**
     * Gets the value of locked.
     *
     * @return boolean
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Sets the value of locked.
     *
     * @param boolean $locked the locked
     *
     * @return self
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Gets the value of emsUrl.
     *
     * @return string
     */
    public function getEmsUrl()
    {
        return $this->emsUrl;
    }

    /**
     * Sets the value of emsUrl.
     *
     * @param string $emsUrl the emsUrl
     *
     * @return self
     */
    public function setEmsUrl($emsUrl)
    {
        $this->emsUrl = $emsUrl;

        return $this;
    }

    /**
     * Gets the value of paymentRedirectUrl.
     *
     * @return string
     */
    public function getPaymentRedirectUrl()
    {
        return $this->paymentRedirectUrl;
    }

    /**
     * Sets the value of paymentRedirectUrl.
     *
     * @param string $paymentRedirectUrl the paymentRedirectUrl
     *
     * @return self
     */
    public function setPaymentRedirectUrl($paymentRedirectUrl)
    {
        $this->paymentRedirectUrl = $paymentRedirectUrl;

        return $this;
    }

    /**
     * Gets the value of PostProcessRedirectUrl.
     *
     * @return string
     */
    public function getEterminalRedirectUrl()
    {
        return $this->eterminalRedirectUrl;
    }

    /**
     * Sets the value of postProcessRedirectUrl.
     *
     * @param string $postProcessRedirectUrl the postProcessRedirectUrl
     *
     * @return self
     */
    public function setEterminalRedirectUrl($eterminalRedirectUrl)
    {
        $this->eterminalRedirectUrl = $eterminalRedirectUrl;

        return $this;
    }

    /**
     * Gets the value of type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the value of type.
     *
     * @param string $type the type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }


    /**
     * Gets the value of description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the value of description.
     *
     * @param string $description the description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets the value of reference.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Sets the value of reference.
     *
     * @param string $reference the reference
     *
     * @return self
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Gets the value of customer.
     *
     * @return array
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Sets the value of customer.
     *
     * @param array $customer the customer
     *
     * @return self
     */
    public function setCustomer(array $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Gets the value of oneshot.
     *
     * @return array
     */
    public function getOneshot()
    {
        return $this->oneshot;
    }

    /**
     * Sets the value of oneshot.
     *
     * @param array $oneshot the oneshot
     *
     * @return self
     */
    public function setOneshot(array $oneshot)
    {
        $this->oneshot = $oneshot;

        return $this;
    }

    /**
     * Gets the value of subscription.
     *
     * @return array
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * Sets the value of subscription.
     *
     * @param array $subscription the subscription
     *
     * @return self
     */
    public function setSubscription(array $subscription)
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * Gets the value of paymentPlan.
     *
     * @return array
     */
    public function getPaymentPlan()
    {
        return $this->paymentPlan;
    }

    /**
     * Sets the value of paymentPlan.
     *
     * @param array $paymentPlan the paymentPlan
     *
     * @return self
     */
    public function setPaymentPlan(array $paymentPlan)
    {
        $this->paymentPlan = $paymentPlan;

        return $this;
    }

    /**
     * Gets the value of paymentMandate.
     *
     * @return array
     */
    public function getPaymentMandate()
    {
        return $this->paymentMandate;
    }

    /**
     * Sets the value of paymentMandate.
     *
     * @param array $paymentMandate the paymentMandate
     *
     * @return self
     */
    public function setPaymentMandate(array $paymentMandate)
    {
        $this->paymentMandate = $paymentMandate;

        return $this;
    }


    /**
     * Get the data to send to the API for the request
     * @return array An array of data that will be json-encoded by the Syspay_Merchant_Client
     */
    public function getData()
    {
        $data = array();
        $data['locked'] = true == $this->locked ? true : false;
        $data['type'] = $this->type;

        if (false === empty($this->website)) {
            $data['website'] = intval($this->website);
        }

        if (false === empty($this->emsUrl)) {
            $data['ems_url'] = $this->emsUrl;
        }

        if (false == empty($this->paymentRedirectUrl)) {
            $data['payment_page_redirect_url'] = $this->paymentRedirectUrl;
        }

        if (false == empty($this->eterminalRedirectUrl)) {
            $data['eterminal_redirect_url'] = $this->eterminalRedirectUrl;
        }

        if (false === empty($this->description)) {
            $data['description'] = $this->description;
        }

        if (false === empty($this->reference)) {
            $data['reference'] = $this->reference;
        }

        if (false === empty($this->customer)) {
            $data['customer'] = $this->customer;
        }

        if (false === empty($this->oneshot)) {
            $data['oneshot'] = $this->oneshot;
        }

        if (false === empty($this->subscription)) {
            $data['subscription'] = $this->subscription;
        }

        if (false === empty($this->paymentPlan)) {
            $data['payment_plan'] = $this->paymentPlan;
        }

        if (false === empty($this->paymentMandate)) {
            $data['payment_mandate'] = $this->paymentMandate;
        }

        if (false === empty($this->allowedRetries)) {
            $data['allowed_retries'] = $this->allowedRetries;
        }

        return $data;
    }

}
