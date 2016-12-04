<?php
namespace Rv\Exception;

class ApiException
{
    const ORDER_NOT_FOUND_CODE = 14;

    public static function exception($code, $message)
    {
        switch ($code) {
            case self::ORDER_NOT_FOUND_CODE:
                throw new OrderNotFoundException($message, $code);

            default:
                throw new RuntimeException($message, $code);
        }
    }
}
