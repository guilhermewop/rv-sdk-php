<?php
namespace Rv;

use Rv\Response;
use Zend\Http\Client as HttpClient;
use Zend\Http\Request as HttpRequest;

final class Request
{
    private $uri;

    private $username;

    private $store;

    private $password;

    private $version = '3.94';

    protected $transactionCode;

    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setStore($store)
    {
        $this->store = $store;

        return $this;
    }

    public function getStore()
    {
        return $this->store;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setTransactionCode($transactionCode)
    {
        $this->transactionCode = $transactionCode;

        return $this;
    }

    public function getTransactionCode()
    {
        return $this->transactionCode;
    }

    public function send(array $params)
    {
        $client = new HttpClient($this->uri);
        $client->setMethod(HttpRequest::METHOD_POST);

        $params = array_merge($params, [
            'nome_primario'    => $this->getUsername(),
            'loja_primaria'    => $this->getStore(),
            'senha_primaria'   => $this->getPassword(),
            'versao'           => $this->getVersion(),
            'codigo_transacao' => $this->getTransactionCode(),
        ]);

        $client->setParameterPost($params);

        $response = $client->send();

        return new Response($response);
    }
}