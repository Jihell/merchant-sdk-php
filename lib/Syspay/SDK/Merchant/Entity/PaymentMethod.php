<?php

/**
 * A payment method object (this gives displayable information about a payment method used for a payment)
 */
class Syspay_Merchant_Entity_PaymentMethod extends Syspay_Merchant_Entity implements
    Syspay_Merchant_Entity_ReturnedEntityInterface
{
    const TYPE = 'payment_method';

    const TYPE_CREDITCARD  = 'CREDITCARD';
    const TYPE_PAYSAFECARD = 'PAYSAFECARD';
    const TYPE_CLICKANDBUY = 'CLICKANDBUY';
    const TYPE_POSTFINANCE = 'POSTFINANCE';
    const TYPE_IDEAL       = 'IDEAL';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $display;

    /**
     * Build a paymentMethod entity based on a json-decoded payment_method stdClass
     *
     * @param  stdClass $response The payment method data
     * @return Syspay_Merchant_Entity_PaymentMethod The payment method object
     */
    public static function buildFromResponse(stdClass $response)
    {
        $paymentMethod = new self();
        $paymentMethod->setType(isset($response->type)?$response->type:null);
        $paymentMethod->setDisplay(isset($response->display)?$response->display:null);

        $paymentMethod->raw = $response;

        return $paymentMethod;
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
     * Gets the value of display.
     *
     * @return string
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * Sets the value of display.
     *
     * @param string $display the display
     *
     * @return self
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }
}
