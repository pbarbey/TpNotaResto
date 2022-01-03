<?php

namespace App\Tests;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HomePageTest extends WebTestCase
{
    // public function testLogin(ContainerInterface $container): void
    public function testLogin(): void
    {
        // En tant qu'utilisateur de l'application,
        // $userRepository = $container->get(UserRepository::class);
        // $user = $userRepository->findOneByEmail('client@notaresto.fr');
        $user = new User();
        $this->assertEquals('ROLE_USER',$user->getRoles()[0]);

        // Lorsque j'arrive sur la page d'accueil
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $client->followRedirect();
        $this->assertResponseIsSuccessful();

        // Je souhaite pouvoir me connecter/déconnecter de mon compte
        $client->loginUser($user);
        $this->assertResponseIsSuccessful();

    }
}
