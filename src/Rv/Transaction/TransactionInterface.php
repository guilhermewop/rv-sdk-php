<?php
namespace Rv\Transaction;

interface TransactionInterface
{
    public function send(array $params);
}