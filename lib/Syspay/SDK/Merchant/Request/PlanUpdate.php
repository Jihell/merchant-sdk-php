<?php

/**
 * Uodate a plan
 * @see https://app.syspay.com/docs/api/merchant_subscription.html#update-a-plan
 */
class Syspay_Merchant_PlanUpdateRequest extends Syspay_Merchant_Request
{
    const METHOD = 'PUT';
    const PATH   = '/api/v1/merchant/plan/%d';

    /**
     * @var integer
     */
    private $plan_id;

    /**
     * @var integer
     */
    protected $trial_amount;

    /**
     * @var integer
     */
    protected $initial_amount;

    /**
     * @var integer
     */
    protected $billing_amount;

    /**
     * @var integer
     */
    protected $default_capture_delay;

    /**
     * PlanUpdate Constuctor
     *
     * @param int $plan_id
     */
    public function __construct($plan_id = null)
    {
        if (null !== $plan_id) {
            $this->setPlanId($plan_id);
        }
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
        return sprintf(self::PATH, $this->plan_id);
    }

    /**
     * Gets the value of planId.
     *
     * @return integer
     */
    public function getPlanId()
    {
        return $this->plan_id;
    }

    /**
     * Sets the value of planId.
     *
     * @param integer $planId the planId
     *
     * @return self
     */
    public function setPlanId($plan_id)
    {
        $this->plan_id = $plan_id;

        return $this;
    }

    /**
     * Gets the value of trial_amount.
     *
     * @return integer
     */
    public function getTrialAmount()
    {
        return $this->trial_amount;
    }

    /**
     * Sets the value of trial_amount.
     *
     * @param integer $trial_amount the trial_amount
     *
     * @return self
     */
    public function setTrialAmount($trial_amount)
    {
        $this->trial_amount = $trial_amount;

        return $this;
    }

    /**
     * Gets the value of initial_amount.
     *
     * @return integer
     */
    public function getInitialAmount()
    {
        return $this->initial_amount;
    }

    /**
     * Sets the value of initial_amount.
     *
     * @param integer $initial_amount the initial_amount
     *
     * @return self
     */
    public function setInitialAmount($initial_amount)
    {
        $this->initial_amount = $initial_amount;

        return $this;
    }

    /**
     * Gets the value of billing_amount.
     *
     * @return integer
     */
    public function getBillingAmount()
    {
        return $this->billing_amount;
    }

    /**
     * Sets the value of billing_amount.
     *
     * @param integer $billing_amount the billing_amount
     *
     * @return self
     */
    public function setBillingAmount($billing_amount)
    {
        $this->billing_amount = $billing_amount;

        return $this;
    }

    /**
     * Gets the value of $default_capture_delay.
     *
     * @return int
     */
    public function getDefaultCaptureDelay()
    {
        return $this->default_capture_delay;
    }

    /**
     * Sets the value of $default_capture_delay.
     *
     * @param int $default_capture_delay
     *
     * @return self
     */
    public function setDefaultCaptureDelay($default_capture_delay)
    {
        $this->default_capture_delay = $default_capture_delay;

        return $this;
    }


    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        $data = array();
        $data['plan_id'] = $this->plan_id;

        if ($this->trial_amount !== null) {
            $data['trial_amount'] = $this->trial_amount;
        }

        if ($this->initial_amount !== null) {
            $data['initial_amount'] = $this->initial_amount;
        }

        if ($this->billing_amount !== null) {
            $data['billing_amount'] = $this->billing_amount;
        }

        if ($this->default_capture_delay !== null) {
            $data['default_capture_delay'] = $this->default_capture_delay;
        }

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function buildResponse(stdClass $response)
    {
        if (!isset($response->plan)) {
            throw new Syspay_Merchant_UnexpectedResponseException(
                'Unable to retrieve "plan" data from response',
                $response
            );
        }

        $plan = Syspay_Merchant_Entity_Plan::buildFromResponse($response->plan);

        return $plan;
    }
}
