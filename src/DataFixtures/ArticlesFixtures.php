<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Doctrine\Persistence\ObjectManager;
use Faker;

class ArticlesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i <= 5; $i++) {
            $articles = new Article();
            $articles
                ->setTitle($faker->word)
                ->setContent($faker->realText('200'))
                ->setDate($faker->dateTimeThisYear)
                ->setPicture('https://picsum.photos/450/350')
                ->setUser($this->getReference('user_'));
            $manager->persist($articles);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
