<?php
namespace Rv\Transaction\Recharge;

use Rv\Transaction\AbstractTransaction;
use Rv\Transaction\TransactionInterface;
use Rv\Operator;
use Rv\Exception\FromToProductException;

final class Product
{
    private static $operatorProducts = [
        Operator::OI = [ // OI
            '10.00' => 1488,
            '15.00' => 1927,
            '20.00' => 1018,
        ]
    ]

    public static function amountToCode($operator, $amount)
    {
        if (! isset(self::$operatorProducts[$operator])) {
            throw new FromToProductException(sprintf(
                'Operadora não listada no de/para de produtos. Operadora: %s',
                $operator
            ));
        }

        if (! isset(self::$operatorProducts[$operator][$amount])) {
            throw new FromToProductException(sprintf(
                'Valor de recarga não listado no de/para de produtos. Operadora: %s, valor: %s',
                $operator, $amount
            ));
        }

        return self::$operatorProducts[$operator][$amount];
    }
}