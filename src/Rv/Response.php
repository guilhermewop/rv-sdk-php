<?php
namespace Rv;

use Zend\Http\Response as HttpResponse;
use Rv\Exception\RuntimeException;
use Rv\Exception\ApiException;

final class Response
{
    private $success = true;

    private $ok = true;

    private $content;

    public function __construct(HttpResponse $response)
    {
        $this->success = $response->isSuccess();
        $this->ok      = $response->isOk();

        if (! $response->isSuccess()) {
            throw new RuntimeException('Erro');
        }

        $this->parseXml($response->getBody());
    }

    private function parseXml($content)
    {
        $this->content = (array) simplexml_load_string($content);

        if (isset($this->content['erro'])) {
            $this->ok = false;

            $error = (array) $this->content['erro'];

            $code    = $error['codigo'];
            $message = $error['mensagem'];

            ApiException::exception($code, $message);
        }
    }

    public function getContent()
    {
        return $this->content;
    }

    public function isSuccess()
    {
        return $this->success;
    }

    public function isOk()
    {
        return $this->ok;
    }

}