<?php

namespace App\Service\Encryptor;

use App\Exception\OpenSSL\OpenSSLDecryptException;
use App\Exception\OpenSSL\OpenSSLEncryptException;

class OpenSSLEncryptorManager
{
    public function encrypt(string $data, string $passphrase, string $algo = "aes-256-cbc"): array
    {
        $iv = openssl_random_pseudo_bytes(16);

        $encryptedData = openssl_encrypt($data, $algo, $passphrase, 0, $iv);
        $encryptedData = false;
        if ($encryptedData === false) {
            throw new OpenSSLEncryptException();
        }

        return [
            'encryptedData' => $encryptedData,
            'iv' => $iv,
        ];
    }

    public function decrypt(string $data, string $passphrase, string $iv, string $algo = "aes-256-cbc"): string
    {
        $decryptedData = openssl_decrypt($data, $algo, $passphrase, 0, $iv);

        if ($decryptedData === false) {
            throw new OpenSSLDecryptException();
        }

        return $decryptedData;
    }
}