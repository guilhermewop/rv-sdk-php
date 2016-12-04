<?php
require 'vendor/autoload.php';

use Rv\Transaction;
use Rv\Request;
use Rv\Transaction\Status;
use Rv\Transaction\Recharge\Online as OnlineRecharge;
use Rv\Misc;

$request = new Request;
$request->setUri('https://xml.cellcard.com.br/teste/integracao_xml.php')
        ->setUsername('teste')
        ->setStore('teste')
        ->setPassword('teste');

// $status = new Status($request);
// $response = $status->send(['cod_online' => 39947]);
// print_r($response);

$recharge = new OnlineRecharge($request);
$recharge->setOperator('oi')
         ->setPhone('11980953733')
         ->setAmount('15.00');

$response = $recharge->send();
print_r($recharge);
print_r($response);


/*
$transaction = new Transaction(5);
$transaction->setRequest($request);
$response = $transaction->send([
    'compra'  => '100000000',
    'produto' => '1488',
    'ddd'     => '11',
    'fone'    => '980953733',
]);

print_r($response);
*/
