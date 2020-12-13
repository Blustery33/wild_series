<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $slugify = new Slugify();

        for ($i = 0; $i < 10; $i++) {
            $episode = new Episode();
            $episode->setTitle($faker->streetName);
            $episode->setNumber($faker->numberBetween(1,10));
            $episode->setSynopsis($faker->text);
            $episode->setSeason($this->getReference('season_0'));
            $slug = $slugify->generate($episode->getTitle());
            $episode->setSlug($slug);
            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }

}
