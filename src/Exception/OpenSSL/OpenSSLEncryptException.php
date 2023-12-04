<?php

namespace App\Exception\OpenSSL;

class OpenSSLEncryptException extends \RuntimeException
{
    public function __construct(string $message = "OpenSSL encrypt error", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}