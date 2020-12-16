<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class EpisodesFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        for ($i = 0; $i <= 150; $i++) {
            $episode = new Episode();
            $episode->setTitle($faker->text($maxNbChars = 50));
            $episode->setNumber(($faker->numberBetween(1,10)));
            $episode->setSynopsis($faker->text);
            $episode->setSeason($this->getReference('season_' . $i % 18));
            $manager->persist($episode);
            $manager->flush();
        }
        $manager->flush();
    }
}