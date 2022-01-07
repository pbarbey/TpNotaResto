<?php

namespace App\Tests;

use App\Entity\Restaurant;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class EntitiesTest extends TestCase
{
    public function testCreateUser(): void
    {
        $user = new User();
        $user->setNom('Nom')
            ->setPrenom('Prenom')
            ->setEmail('email@notaResto.fr')
            ->setRoles(['ROLE_USER'])
            ->setPassword('password');

        $this->assertTrue($user->getId() === null);
        $this->assertTrue($user->getNom() == 'Nom');
        $this->assertTrue($user->getPrenom() == 'Prenom');
        $this->assertTrue($user->getEmail() == 'email@notaResto.fr');
        $this->assertTrue($user->getUserIdentifier() == 'email@notaResto.fr');
        $this->assertTrue($user->getUsername() == 'email@notaResto.fr');
        $this->assertTrue($user->getRoles() == ['ROLE_USER']);
        $this->assertTrue($user->getPassword() == 'password');
    }

    public function testRestaurant(): void
    {
        $restaurant = new Restaurant();
        $restaurant->setPostalCode('63370')
            ->setImage('/path/to/image')
            ->setNomRestaurant('Delices Romain');

        $this->assertTrue($restaurant->getId() === null);
        $this->assertTrue($restaurant->getPostalCode() == '63370');
        $this->assertTrue($restaurant->getImage() == '/path/to/image');
        $this->assertTrue($restaurant->getNomRestaurant() == 'Delices Romain');
    }
}
