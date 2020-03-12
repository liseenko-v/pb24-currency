<?php
require_once __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11');

$available_ccy = ['USD', 'EUR', 'RUR', 'BTC'];

if ($response->getStatusCode() == 200) {
    $res = $response->getBody();
    $currencies = json_decode($res);
    
    $ccy = [];
    //CCY key: USD, EUR, RUR, BTC
    foreach($currencies as $currency) {
        $ccy[$currency->ccy] = [
            'ccy' => $currency->ccy,
            'base_ccy' => $currency->base_ccy,
            'buy' => $currency->buy,
            'sale' => $currency->sale 
        ];
    }

    if (isset($_GET['ccy']) && in_array($_GET['ccy'], $available_ccy)) {
        makeResponse($ccy[$_GET['ccy']]);
    } else {
        makeResponse($ccy);
    }
} else {
    makeResponse(['status_code' => $response->getStatusCode()]);
}

function makeResponse($data)
{
    header('Access-Control-Allow-Origin: *');
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($data);
}