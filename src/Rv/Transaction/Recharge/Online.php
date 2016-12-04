<?php
namespace Rv\Transaction\Recharge;

use Rv\Transaction\AbstractTransaction;
use Rv\Transaction\TransactionInterface;
use Rv\Transaction\Recharge\Product;
use Rv\Helper;

final class Online extends AbstractTransaction implements
    TransactionInterface
{
    const TRANSACTION_CODE = self::ONLINE_RECHARGE;

    protected $operator;

    protected $phone;

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

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
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
        $productCode = Product::amountToCode($this->getOperator(), $this->getAmount());

        $phone = $this->getPhone();
        $splittedPhone = Helper::splitPhoneNumberAreaCode($phone);

        $this->setParams([
            'compra'  => '100000000',
            'produto' => $productCode,
            'ddd'     => $splittedPhone['area_code'],
            'fone'    => $splittedPhone['phone'],
        ]);
    }
}