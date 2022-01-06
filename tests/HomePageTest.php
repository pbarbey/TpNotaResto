<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Tests\Helper\Helper;

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
        $form = Helper::loginHelper($client, 'client@notaResto.fr', 'client');

        // Je souhaite pouvoir me connecter/déconnecter de mon compte

        /* V1 test */
        // $buttonForm = $crawler->selectButton('Sign in');
        // $form = $buttonForm->form();

        // $client->submitForm('Sign in', [
        //     'email' => 'client@notaResto.fr',
        //     'password' => 'client'
        // ]);

        $client->submit($form);
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $client->request('GET', '/logout');
        $client->followRedirect();
        $this->assertResponseRedirects('/login', Response::HTTP_FOUND);
    }

    public function testCreateAccount(): void
    {
        $client = static::createClient();

        //En tant qu'utilisateur de l'application,
        //Lorsque j'arrive sur la page d'accueil
        //Je souhaite pouvoir me créer un compte
        $crawler = $client->request('GET', '/createAccount');
        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Créer un compte')->form([
            'user[nom]' => 'Nom',
            'user[prenom]' => 'Prenom',
            'user[email]' => 'email@notaResto.fr',
            'user[roles][0]' => 'ROLE_USER',
            'user[password][first]' => 'password',
            'user[password][second]' => 'password'
        ]);

        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('div', 'Votre compte a été créer');
    }

    public function testPageAccueilEmptyData(): void
    {
        // En tant qu'utilisateur, après m'être connecté,
        // J'arrive sur la page d'accueil.
        $client = static::createClient();
        $form = Helper::loginHelper($client, 'client@notaResto.fr', 'client');
        $client->submit($form);
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        // Je veux visualiser les restaurants dans une liste,
        // si il n'y a pas de restaurant le message "Pas encore de restaurant enregistrés" apparait.
        $this->assertSelectorTextContains('div', 'Pas de restaurant rensaigné pour l\'instant');

    }

    public function testPageAccueilWithData(): void
    {
        // En tant qu'utilisateur, après m'être connecté,
        // J'arrive sur la page d'accueil.
        $client = static::createClient();
        $form = Helper::loginHelper($client, 'client@notaResto.fr', 'client');
        $client->submit($form);
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        // Je veux visualiser les restaurants dans une liste,
        $this->assertSelectorExists('.card');

    }
}
