<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @codeCoverageIgnore
 */
class EmptyRestaurantFixtures extends Fixture implements FixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setNom('user')
            ->setPrenom('user')
            ->setRoles(['ROLE_RESTAURATEUR'])
            ->setEmail('user@notaResto.fr')
            ->setPassword($this->encoder->hashPassword($user, 'user'));

        $manager->persist($user);

        $manager->flush();
    }
}
