<?php

namespace App\Tests;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{
    public function testLogin(): void
    {
        $client = static::createClient();

        // En tant qu'utilisateur de l'application,
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneByEmail('client@notaresto.fr');
        $this->assertEquals('ROLE_USER', $user->getRoles()[0]);

        // Lorsque j'arrive sur la page d'accueil
        $crawler = $client->request('GET', '/');
        $crawler = $client->followRedirect();
        $this->assertResponseIsSuccessful();

        // Je souhaite pouvoir me connecter/déconnecter de mon compte
        $buttonForm = $crawler->selectButton('Sign in');
        $form = $buttonForm->form();

        $client->submitForm('Sign in', [
            'email' => 'client@notaResto.fr',
            'password' => 'client'
        ]);

        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertResponseIsSuccessful();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $client->request('GET', '/logout');
        $client->followRedirect();
        $this->assertResponseRedirects('/login', 302);
    }

    // public function testCreateAccount(): void
    // {
    //     $client = static::createClient();

    //     //En tant qu'utilisateur de l'application,
    //     //Lorsque j'arrive sur la page d'accueil
    //     //Je souhaite pouvoir me créer un compte
    //     $crawler = $client->request('GET', '/createAccount');
    //     $this->assertResponseIsSuccessful();

    //     $buttonForm = $crawler->selectButton('Créer un compte');
    //     $form = $buttonForm->form();

    //     $client->submitForm('Créer un compte', [
    //         'user[nom]' => 'Nom',
    //         'user[prenom]' => 'Prenom',
    //         'user[email]' => 'email@notaResto.fr',
    //         'user[role]' => ['ROLE_USER'],
    //         'user[password]' => 'password'
    //     ]);

    //     $client->submit($form);
    //     $this->assertResponseIsSuccessful();
    //     $this->assertSelectorTextContains('div','Votre compte a été créer');
    // }
}
