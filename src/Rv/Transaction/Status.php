<?php
namespace Rv\Transaction;

use Rv\Transaction\AbstractTransaction;
use Rv\Transaction\TransactionInterface;

final class Status extends AbstractTransaction implements
    TransactionInterface
{
    const TRANSACTION_CODE = self::STATUS_CHECK;
}