<?php


namespace App\DataFixtures;

use Faker;
use App\Entity\Content;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ContentFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for ($i=0; $i<3; $i++) {
            $content = new Content();
            $content->setTitle($faker->sentence);
            $content->setContent($faker->text);
            $manager->persist($content);
            $content->setCategory($this->getReference('category_' . $i));
        }
        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return class-string[]
     */
    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}