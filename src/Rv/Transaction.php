<?php
namespace Rv;

use Rv\Exception\InvalidArgumentException;
use Rv\Request;

class Transaction
{
    protected $request;

    protected $transactionCode;

    protected $params = [];

    public function __construct($transactionCode)
    {
        $this->transactionCode = $transactionCode;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
        if (is_int($this->transactionCode)) {
            $this->request->setTransactionCode($this->transactionCode);
        }

        return $this;
    }

    public function getRequest()
    {
        if (empty($this->request)) {
            $this->request = new Request();
        }

        return $this->request;
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

    public function send(array $params = [], Request $request = null)
    {
        if ($request !== null) {
            $this->setRequest($request);
        }

        if (! empty($params)) {
            $this->setParams($params);
        }

        return $this->getRequest()
                    ->setTransactionCode($this->transactionCode)
                    ->send($this->getParams());
    }
}