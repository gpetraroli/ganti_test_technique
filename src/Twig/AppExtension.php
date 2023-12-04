<?php

namespace App\Twig;

use App\Service\Encryptor\OpenSSLEncryptorManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('getenv', [$this, 'getEnv']),
        ];
    }

    public function getEnv(string $name): string
    {
        return getenv($name);
    }
}