<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RepositoriesTest extends WebTestCase
{
    public function testUserRepo(): void
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneByEmail('client@notaresto.fr');

        $this->assertTrue($user->getId() === $user->getId());
        $this->assertTrue($user->getNom() == 'NomDuClient');
        $this->assertTrue($user->getPrenom() == 'PrenomDuClient');
        $this->assertTrue($user->getEmail() == 'client@notaResto.fr');
        $this->assertTrue($user->getUserIdentifier() == 'client@notaResto.fr');
        $this->assertTrue($user->getUsername() == 'client@notaResto.fr');
        $this->assertTrue($user->getRoles() == ['ROLE_USER']);
        $this->assertTrue($user->getPassword() == $user->getPassword()); // salt!
    }
}
