<?php

namespace App\DataFixtures;

use App\Entity\Commentary;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CommentariesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i=0; $i <= 5; $i++) {
        $commentaries = new Commentary();
        $commentaries->setAuthors($faker->name)
            ->setComment($faker->realText(200,3))
            ->setCreateAt($faker->dateTimeThisYear)
            ->setIsValid(false);
        $manager->persist($commentaries);
    }
        $manager->flush();
    }
}
