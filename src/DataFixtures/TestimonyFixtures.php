<?php

namespace App\DataFixtures;

use App\Entity\Testimony;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class TestimonyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for($i=0; $i<=10; $i++ ){
            $testimonies = new Testimony();
            $testimonies
                ->setContent($faker->realText(200))
                ->setAuthors($faker->name)
                ->setCreateAt($faker->dateTimeThisYear)
                ->setIsValid(false);
            $manager->persist($testimonies);
        }
        $manager->flush();
    }
}
