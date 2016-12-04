<?php
namespace Rv\Transaction;

use Rv\Transaction;
use Rv\Request;

abstract class AbstractTransaction
{
    /**
     * Consulta de crédito
     */
    const CREDIT_LIMIT = 9;

    /**
     * Recarga online
     */
    const ONLINE_RECHARGE = 5;

    /**
     * Consulta de status
     */
    const STATUS_CHECK = 6;

    /**
     * @var Rv\Transaction
     */
    protected $transaction;

    /**
     * @var Rv\Request
     */
    protected $request;

    protected $params = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function send(array $params = [])
    {
        if (! empty($params)) {
            $this->setParams($params);
        }

        $this->transaction = new Transaction($this::TRANSACTION_CODE);
        return $this->transaction->setRequest($this->request)
                                 ->setParams($this->getParams())
                                 ->send();
    }
}