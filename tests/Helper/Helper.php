<?php

namespace App\Tests\Helper;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Form;

class Helper extends WebTestCase
{
    static public function loginHelper(KernelBrowser $client, string $email, string $password): Form
    {
        $client->request('GET', '/');
        $crawler = $client->followRedirect();
        static::assertResponseIsSuccessful();

        $form = $crawler->selectButton('Sign in')->form([
            'email' => $email,
            'password' => $password
        ]);

        return $form;
    }
}
