<?php

namespace App\Tests\Encriptor;

use App\Service\Encryptor\OpenSSLEncryptorManager;
use PHPUnit\Framework\TestCase;

class OpenSSLEncryptorTest extends TestCase
{
    public function testOpenSSLEncryption()
    {
        $encryptor = new OpenSSLEncryptorManager();

        $data = 'dummy data';
        $passphrase = 'dummy_passphrase';

        $encryptedResult = $encryptor->encrypt($data, $passphrase);

        // test the encryption result is an array and contains expected keys
        $this->assertArrayHasKey('encryptedData', $encryptedResult);
        $this->assertArrayHasKey('iv', $encryptedResult);

        $decryptedData = $encryptor->decrypt($encryptedResult['encryptedData'], $passphrase, $encryptedResult['iv']);

        $this->assertEquals($data, $decryptedData);
    }
}