<?php

/**
 * Process a payment
 *
 * @see https://app.syspay.com/bundles/emiuser/doc/merchant_api.html#hosted-payment-request
 * @see https://app.syspay.com/bundles/emiuser/doc/merchant_api.html#server-to-server-credit-card-payment
 */
class Syspay_Merchant_BillingAgreementRequest extends Syspay_Merchant_Request
{
    const FLOW_API     = 'API';
    const FLOW_BUYER   = 'BUYER';
    const FLOW_SELLER  = 'SELLER';

    const MODE_BOTH     = 'BOTH';
    const MODE_ONLINE   = 'ONLINE';
    const MODE_TERMINAL = 'TERMINAL';

    const METHOD_ASTROPAY_BANKTRANSFER   = 'ASTROPAY_BANKTRANSFER';
    const METHOD_ASTROPAY_BOLETOBANCARIO = 'ASTROPAY_BOLETOBANCARIO';
    const METHOD_ASTROPAY_DEBITCARD      = 'ASTROPAY_DEBITCARD';
    const METHOD_CLICKANDBUY             = 'CLICKANDBUY';
    const METHOD_CREDITCARD              = 'CREDITCARD';
    const METHOD_IDEAL                   = 'IDEAL';
    const METHOD_PAYSAFECARD             = 'PAYSAFECARD';
    const METHOD_POSTFINANCE             = 'POSTFINANCE';

    const METHOD = 'POST';
    const PATH   = '/api/v1/merchant/billing-agreement';

    /**
     * @var string
     */
    private $flow;
    /**
     * @var string
     */
    private $mode;

    /**
     * @var string
     */
    private $paymentMethod;


    /**
     * @var string
     */
    private $threatMetrixSessionId;

    /**
     * @var boolean
     */
    private $billingAgreement = false;

    /**
     * @var string
     */
    private $emsUrl;

    /**
     * @var string
     */
    private $redirectUrl;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $agent;

    /**
     * @var integer
     */
    private $allowedRetries;

    /**
     * @var Syspay_Merchant_Entity_Payment
     */
    private $payment;

    /**
     * @var Syspay_Merchant_Entity_Customer
     */
    private $customer;

    /**
     * @var Syspay_Merchant_Entity_Creditcard
     */
    private $creditcard;

    /**
     * @var string
     */
    private $bankCode;

    /**
     * @var String
     */
    private $reference;

    /**
     * @var String
     */
    private $currency;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $extra;

    /**
     * Consructor
     *
     * @param String $flow
     */
    public function __construct($flow)
    {
        if (!in_array($flow, array(self::FLOW_API, self::FLOW_BUYER, self::FLOW_SELLER))) {
            throw new InvalidArgumentException('Invalid flow: ' . $flow);
        }

        $this->flow = $flow;
    }

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
        return self::PATH;
    }

    /**
     * {@inheritDoc}
     */
    public function buildResponse(stdClass $response)
    {
        if (!isset($response->billing_agreement)) {
            throw new Syspay_Merchant_UnexpectedResponseException(
                'Unable to retrieve "billing_agreement" data from response',
                $response
            );
        }

        if ($response->billing_agreement) {
            $billingAgreement = Syspay_Merchant_Entity_BillingAgreement::buildFromResponse($response->billing_agreement);
        } else {
            $billingAgreement = new Syspay_Merchant_Entity_BillingAgreement();
        }

        if (isset($response->redirect) && !empty($response->redirect)) {
            $billingAgreement->setRedirect($response->redirect);
        }

        return $billingAgreement;
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        $data = array();
        $data['flow'] = $this->flow;

        if (false === empty($this->billingAgreement)) {
            $data['billing_agreement'] = $this->billingAgreement?1:0;
        }

        if (false === empty($this->mode)) {
            $data['mode'] = $this->mode;
        }

        if (false == empty($this->threatMetrixSessionId)) {
            $data['threatmetrix_session_id'] = $this->threatMetrixSessionId;
        }

        if (false === empty($this->paymentMethod)) {
            $data['method'] = $this->paymentMethod;
        }

        if (false === empty($this->website)) {
            $data['website'] = $this->website;
        }

        if (false === empty($this->agent)) {
            $data['agent'] = $this->agent;
        }

        if (false === empty($this->redirectUrl)) {
            $data['redirect_url'] = $this->redirectUrl;
        }

        if (false === empty($this->emsUrl)) {
            $data['ems_url'] = $this->emsUrl;
        }

        if (false === empty($this->creditcard)) {
            $data['creditcard'] = $this->creditcard->toArray();
        }

        if (false === empty($this->customer)) {
            $data['customer'] = (array) $this->customer->toArray();
        }

        if (false === empty($this->bankCode)) {
            $data['bank_code'] = $this->bankCode;
        }

        if (false === empty($this->reference)) {
            $data['reference'] = $this->reference;
        }

        if (false === empty($this->currency)) {
            $data['currency'] = $this->currency;
        }

        if (false === empty($this->description)) {
            $data['description'] = $this->description;
        }

        if (false === empty($this->allowedRetries)) {
            $data['allowed_retries'] = $this->allowedRetries;
        }

        if (false === empty($this->extra)) {
            $data['extra'] = $this->extra;
        }

        return $data;
    }

    /**
     * Gets the value of flow.
     *
     * @return string
     */
    public function getFlow()
    {
        return $this->flow;
    }

    /**
     * Sets the value of flow.
     *
     * @param string $flow the flow
     *
     * @return self
     */
    public function setFlow($flow)
    {
        $this->flow = $flow;

        return $this;
    }

    /**
     * Get the value of mode
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }
    /**
     * Sets the value of mode
     *
     * @param string $mode
     *
     * @return self
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * Sets the value of threatMetrixSessionId
     *
     * @param string $threatMetrixSessionId
     *
     * @return self
     */
    public function setThreatMetrixSessionId($threatMetrixSessionId)
    {
        $this->threatMetrixSessionId = $threatMetrixSessionId;

        return $this;
    }

    /**
     * Get the value of threatMetrixSessionId
     *
     * @return string
     */
    public function getThreatMetrixSessionId()
    {
        return $this->threatMetrixSessionId;
    }


    /**
     * Gets the value of billingAgreement.
     *
     * @return boolean
     */
    public function getBillingAgreement()
    {
        return $this->billingAgreement;
    }

    /**
     * Sets the value of billingAgreement.
     *
     * @param boolean $billingAgreement the billingAgreement
     *
     * @return self
     */
    public function setBillingAgreement($billingAgreement)
    {
        $this->billingAgreement = $billingAgreement;

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
     * Gets the value of redirectUrl.
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * Sets the value of redirectUrl.
     *
     * @param string $redirectUrl the redirectUrl
     *
     * @return self
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }

    /**
     * Gets the value of customer.
     *
     * @return Syspay_Merchant_Entity_Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Sets the value of customer.
     *
     * @param Syspay_Merchant_Entity_Customer $customer the customer
     *
     * @return self
     */
    public function setCustomer(Syspay_Merchant_Entity_Customer $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Gets the value of creditcard.
     *
     * @return Syspay_Merchant_Entity_Creditcard
     */
    public function getCreditcard()
    {
        return $this->creditcard;
    }

    /**
     * Sets the value of creditcard.
     *
     * @param Syspay_Merchant_Entity_Creditcard $creditcard the creditcard
     *
     * @return self
     */
    public function setCreditcard(Syspay_Merchant_Entity_Creditcard $creditcard)
    {
        $this->creditcard = $creditcard;

        return $this;
    }

    /**
     * Gets the value of paymentMethod.
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Sets the value of paymentMethod.
     *
     * @param string $paymentMethod the paymentMethod
     *
     * @return self
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Gets the value of website.
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Sets the value of website.
     *
     * @param string $website the website
     *
     * @return self
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Gets the agent
     * @return string
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Sets the value of agent.
     *
     * @param string $agent the agent id
     *
     * @return self
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;

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
     * @param integer $allowedRetries the allowed retries
     *
     * @return self
     */
    public function setAllowedRetries($allowedRetries)
    {
        $this->allowedRetries = $allowedRetries;

        return $this;
    }

    /**
     * Gets the value of bankCode.
     *
     * @return string
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }

    /**
     * Sets the value of bankCode.
     *
     * @param string $bankCode the bank code
     *
     * @return self
     */
    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;

        return $this;
    }

    /**
    * Gets the value of reference.
    *
    * @return String
    */
    public function getReference()
    {
        return $this->reference;
    }

    /**
    * Sets the value of reference.
    * @param String $reference the reference
    *
    * @return self
    */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
    * Gets the value of currency.
    * @return String
    */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
    * Sets the value of currency.
    * @param String $currency the currency
    *
    * @return self
    */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
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
     * Gets the value of extra.
     *
     * @return string
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Sets the value of extra.
     *
     * @param string $extra the extra
     *
     * @return self
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;

        return $this;
    }
}
