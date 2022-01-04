<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private string $hashPassword;

    public function __construct(UserPasswordHasherInterface $hashPassword)
    {
        $this->hashPassword = $hashPassword;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@stephanieferreira.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->hashPassword->hashPassword(
            $user,
            'Adminpassword'
        ));
        $manager->persist($user);

        $manager->flush();
    }
}
