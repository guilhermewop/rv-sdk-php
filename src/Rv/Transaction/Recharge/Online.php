<?php
namespace Rv\Transaction\Recharge;

use Rv\Transaction\AbstractTransaction;
use Rv\Transaction\TransactionInterface;

final class Online extends AbstractTransaction implements
    TransactionInterface
{
    const TRANSACTION_CODE = self::ONLINE_RECHARGE;
}