<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @codeCoverageIgnore
 */
class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setNom('NomDuClient')
            ->setPrenom('PrenomDuClient')
            ->setRoles(['ROLE_USER'])
            ->setEmail('client@notaResto.fr')
            ->setPassword($this->encoder->hashPassword($user, 'client'));
        $manager->persist($user);

        for ($i = 0; $i < 20; $i++) {
            $restaurant = new Restaurant();
            $restaurant->setPostalCode('63370')
                ->setImage('https://picsum.photos/300')
                ->setNomRestaurant('Delices Romain');
            $manager->persist($restaurant);
        }

        $manager->flush();
    }
}
