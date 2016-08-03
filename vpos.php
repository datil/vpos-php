<?php

require 'vendor/autoload.php';
use Noodlehaus\Config;

// Setup templates
$templates = new League\Plates\Engine('templates');

// Load configuration
$conf = new Config('config.yaml');

// Setup API URLs
$payment_request_url = sprintf($conf['payment_req_url'],
                               $conf['env'],
                               $conf['client_id']);

$payment_response_url = sprintf($conf['payment_res_url'],
                                $conf['env'],
                                $conf['client_id']);

// Generate a random order identificator for the purpose of this demo.
// In a production environment, your e-commerce software or ERP should
// generate a unique order id for each payment request.
// It must be a numeric id of length 11.
// Reference: http://stackoverflow.com/questions/13169025/generate-a-random-number-with-pre-defined-length-php
function randomNumber($length) {
    $result = '';
    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }
    return $result;
}

// Define a test payment request
$test_payment = ['interest_amount' => '000',
                 'ice_tax_amount' => '000',
                 'iva_tax_exempt_amount' => '000',
                 'language' => 'SP',
                 'purchase_currency_code' => '840',
                 'commerce_mall_id' => '1',
                 'purchase_operation_number' => randomNumber(11),
                 'net_amount' => '1000',
                 'iva_tax_amount' => '140',
                 'purchase_amount' => '1140'];

// Get a payment request object comprised of:
// - ciphered_xml
// - ciphered_session_key
// - ciphered_signature
// With this data, you can build the payment form
function getPaymentRequest($conf, $payment_req, $req_url) {
    $r = Requests::post($req_url,
                        ['Content-Type' => 'application/json',
                         'x-api-key' => $conf['datil_api_key']],
                        json_encode($payment_req));
    return json_decode($r->body);
}

function renderPaymentForm($conf, $payment_req, $req_url) {
    $req = getPaymentRequest($conf, $payment_req, $req_url);
    return $GLOBALS['templates']->render(
        'vpos',
        ['payment_request' => json_encode($payment_req),
         'acquirer_id' => $conf['acquirer_id'],
         'commerce_id' => $conf['commerce_id'],
         'ciphered_xml' => $req->ciphered_xml,
         'ciphered_signature' => $req->ciphered_signature,
         'ciphered_session_key' => $req->ciphered_session_key]);
}

echo renderPaymentForm($conf, $test_payment, $payment_request_url);
?>
