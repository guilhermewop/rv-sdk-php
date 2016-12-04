<?php
namespace Rv\Transaction\Recharge;

use Rv\Transaction\AbstractTransaction;
use Rv\Transaction\TransactionInterface;
use Rv\Transaction\Recharge\Product;

final class Online extends AbstractTransaction implements
    TransactionInterface
{
    const TRANSACTION_CODE = self::ONLINE_RECHARGE;

    protected $operator;

    protected $msisdn;

    protected $amount;

    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }

    public function getOperator()
    {
        return $this->operator;
    }

    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;

        return $this;
    }

    public function getMsisdn()
    {
        return $this->msisdn;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    protected function buildParams()
    {
        $productCode = Product::amountToCode($operator, $amount);
    }
}