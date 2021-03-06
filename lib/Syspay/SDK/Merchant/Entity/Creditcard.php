<?php

/**
 * A creditcard object
 */
class Syspay_Merchant_Entity_Creditcard extends Syspay_Merchant_Entity
{
    const TYPE = 'creditcard';

    /**
     * @var string
     */
    protected $number;

    /**
     * @var string
     */
    protected $cardholder;

    /**
     * @var integer
     */
    protected $cvc;

    /**
     * @var integer
     */
    protected $exp_month;

    /**
     * @var integer
     */
    protected $exp_year;

    /**
     * @var string
     */
    protected $token;

    /**
     * {@inheritDoc}
     *
     * If a token is set, use it, otherwise use the full card data
     */
    public function toArray()
    {
        $data = array();
        if (true === empty($this->token)) {
            $data['number']     = $this->number;
            $data['cardholder'] = $this->cardholder;
            $data['cvc']        = $this->cvc;
            $data['exp_month']  = $this->exp_month;
            $data['exp_year']   = $this->exp_year;
        } else {
            $data['token']      = $this->token;
        }

        return $data;
    }

    /**
     * Gets the value of token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Sets the value of token.
     *
     * @param string $token the token
     *
     * @return self
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Gets the value of number.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Sets the value of number.
     *
     * @param string $number the number
     *
     * @return self
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Gets the value of cardholder.
     *
     * @return string
     */
    public function getHolder()
    {
        return $this->cardholder;
    }

    /**
     * Sets the value of cardholder.
     *
     * @param string $holder the cardholder
     *
     * @return self
     */
    public function setHolder($holder)
    {
        $this->cardholder = $holder;

        return $this;
    }

    /**
     * Gets the value of cvc.
     *
     * @return integer
     */
    public function getCvc()
    {
        return $this->cvc;
    }

    /**
     * Sets the value of cvc.
     *
     * @param integer $cvc the cvc
     *
     * @return self
     */
    public function setCvc($cvc)
    {
        $this->cvc = $cvc;

        return $this;
    }

    /**
     * Gets the value of exp_month.
     *
     * @return integer
     */
    public function getExpMonth()
    {
        return $this->exp_month;
    }

    /**
     * Sets the value of exp_month.
     *
     * @param integer $expMonth the exp_month
     *
     * @return self
     */
    public function setExpMonth($expMonth)
    {
        $this->exp_month = $expMonth;

        return $this;
    }

    /**
     * Gets the value of exp_year.
     *
     * @return integer
     */
    public function getExpYear()
    {
        return $this->exp_year;
    }

    /**
     * Sets the value of exp_year.
     *
     * @param integer $expYear the exp_year
     *
     * @return self
     */
    public function setExpYear($expYear)
    {
        $this->exp_year = $expYear;

        return $this;
    }
}
