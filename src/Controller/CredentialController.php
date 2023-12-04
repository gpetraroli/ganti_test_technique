<?php

namespace App\Controller;

use App\Entity\Credential;
use App\Form\CredentialType;
use App\Service\Encryptor\OpenSSLEncryptorManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/credential', name: 'app_credential')]
class CredentialController extends AbstractController
{
    public function __construct(
        private OpenSSLEncryptorManager $openSSLEncryptorManager,
        private EntityManagerInterface $em,
    )
    {
    }

    #[Route('/new', name: '_new')]
    public function new(Request $request)
    {
        $credential = new Credential();

        $form = $this->createForm(CredentialType::class, $credential);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encryptedResult = $this->openSSLEncryptorManager->encrypt(
                $request->get('credential')['plainPassword']['first'],
                getenv('openssl_encrypt_passphrase')
            );

            $credential->setPassword($encryptedResult['encryptedData']);
            $credential->setIv($encryptedResult['iv']);

            $this->em->persist($credential);
            $this->em->flush();

            $this->addFlash('success', 'Credential created successfully!');
        }

        return $this->render('credential/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}