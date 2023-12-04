<?php

namespace App\Service\Encryptor;

class OpenSSLEncryptorManager
{
    public function encrypt(string $data, string $passphrase, string $algo = "aes-256-cbc"): array
    {
        $iv = openssl_random_pseudo_bytes(16);

        $encryptedData = openssl_encrypt($data, $algo, $passphrase, 0, $iv);

        return [
            'encryptedData' => $encryptedData,
            'iv' => $iv,
        ];
    }

    public function decrypt(string $data, string $passphrase, string $iv, string $algo = "aes-256-cbc"): string
    {
        $decryptedData = openssl_decrypt($data, $algo, $passphrase, 0, $iv);

        return $decryptedData;
    }
}