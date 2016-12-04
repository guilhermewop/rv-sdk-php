# SDK for RV Tecnologia XML API

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

A simple SDK to access RV Tecnologia XML API.

## Requirements

* PHP 5.4.x
* Zend Framework HTTP Module >= 2.5

## Installation
### Using composer (recommended)

```bash
php composer.phar require guilhermewop/rv-sdk-php:dev-master
```

[Package information on Packagist](https://packagist.org/packages/guilhermewop/rv-sdk-php)

### Usage
Example using the generic transaction class:

```php
try {
    // All transactions require a request (put it in your config files)
    $request = new Rv\Request;
    $request->setUri('api host')
            ->setUsername('your primary username')
            ->setStore('your primary store')
            ->setPassword('your primary password');

    // All operations require a transaction code
    $transactionCode = 5; // online recharge code
    $transaction = new Rv\Transaction($transactionCode);
    $transaction->setRequest($request);
    $response = $transaction->send([
        'compra'  => '100000000',
        'produto' => '1488',
        'ddd'     => '11',
        'fone'    => '987654321',
    ]); // returns Rv\Response object
} catch (\Exception $e) {
    // ... 
}
```

Example using specific transaction implementation:

```php
try {
    // All transactions require a request (put it in your config files)
    $request = new Rv\Request;
    $request->setUri('api host')
            ->setUsername('your primary username')
            ->setStore('your primary store')
            ->setPassword('your primary password');

    // A online mobile recharge
    $recharge = new Rv\Transaction\Recharge\Online($request);
    $recharge->setOperator('oi')
             ->setMsisdn('11987654321')
             ->setAmount('10.00')

    $response = $recharge->send(); // returns Rv\Response object
} catch (\Exception $e) {
    // ... 
}
```