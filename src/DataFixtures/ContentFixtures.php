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
    const POSTERS = [
        'https://i.f1g.fr/media/figaro/orig/2019/01/01/XVM3d11c4b2-0d0b-11e9-85cf-f4f6a503dd84.jpg',
        'https://4.bp.blogspot.com/-NdVjFFeZJ4U/Vj5Zvz5mdNI/AAAAAAACGiU/uNU5RXp0du4/s1600/1000_Arms_and_sticks3.jpg',
        'https://1.bp.blogspot.com/-qPp_Xv4TdB8/WBnzgeVDZAI/AAAAAAACWrY/SFxJX4BolQEToGu66siN5ocvTWBEcvrkQCEw/s1600/Alexis%2BGruss_02_QUINTESSENCE2016%2B%25C2%25A9Karim%2BEl%2BDib.jpg',
    ];
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
            $content->setPoster(self::POSTERS[$i]);
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