<?php

if (!extension_loaded('curl')) {
    throw new Exception('This library requires the curl extension to be loaded.');
}

if (!extension_loaded('json')) {
    throw new Exception('This library requires the json extension to be loaded');
}

$base = dirname(__FILE__) . '/lib/Syspay/SDK/Merchant/';

$required = array(
    'Client',
    'EMS',
    'Entity',
    'Entity/AstroPayBank',
    'Entity/BillingAgreement',
    'Entity/Chargeback',
    'Entity/Creditcard',
    'Entity/Customer',
    'Entity/Eterminal',
    'Entity/Payment',
    'Entity/PaymentMethod',
    'Entity/PaymentRecipient',
    'Entity/Plan',
    'Entity/Refund',
    'Entity/Subscription',
    'Entity/SubscriptionEvent',
    'Exception/EMS',
    'Exception/Redirect',
    'Exception/Request',
    'Exception/UnexpectedResponse',
    'Redirect',
    'Request',
    'Request/AstroPayBanks',
    'Request/BillingAgreementCancellation',
    'Request/BillingAgreementInfo',
    'Request/BillingAgreementList',
    'Request/BillingAgreement',
    'Request/ChargebackInfo',
    'Request/ChargebackList',
    'Request/Confirm',
    'Request/Eterminal',
    'Request/IpAddresses',
    'Request/Payment',
    'Request/PaymentInfo',
    'Request/PaymentList',
    'Request/Plan',
    'Request/PlanInfo',
    'Request/Rebill',
    'Request/Refund',
    'Request/RefundInfo',
    'Request/RefundList',
    'Request/Subscription',
    'Request/SubscriptionCancellation',
    'Request/SubscriptionInfo',
    'Request/SubscriptionRebill',
    'Request/Void',
    'Utils',
);

foreach ($required as $req) {
    require_once($base . $req . '.php');
}
