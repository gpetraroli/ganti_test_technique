<?php

namespace App\Exception\OpenSSL;

class OpenSSLDecryptException extends \RuntimeException
{
    public function __construct(string $message = "OpenSSL decrypt error", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}