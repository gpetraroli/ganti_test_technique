<?php

namespace App\Twig;

use App\Service\Encryptor\OpenSSLEncryptorManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class OpenSSLExtension extends AbstractExtension
{
    public function __construct(private OpenSSLEncryptorManager $openSSLEncryptorManager)
    {
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('decrypt_openssl', [$this, 'decrypt']),
        ];
    }

    public function decrypt(string $data, string $passphrase, string $iv, string $algo = "aes-256-cbc"): string
    {
        return $this->openSSLEncryptorManager->decrypt($data, $passphrase, $iv, $algo);
    }
}