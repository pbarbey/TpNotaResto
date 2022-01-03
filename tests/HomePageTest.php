<?php

namespace App\Tests;

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
        $this->assertEquals('ROLE_USER',$user->getRoles()[0]);

        // Lorsque j'arrive sur la page d'accueil
        $crawler = $client->request('GET', '/');
        $client->followRedirect();
        $this->assertResponseIsSuccessful();

        // Je souhaite pouvoir me connecter/déconnecter de mon compte
        $client->loginUser($user);
        $this->assertResponseIsSuccessful();
    }
}
