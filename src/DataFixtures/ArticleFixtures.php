<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class ArticleFixtures extends Fixture
{
    const POSTERS = [
        'https://cdn.pixabay.com/photo/2018/07/09/21/16/soap-bubble-3527306_960_720.jpg',
        'https://cdn.pixabay.com/photo/2018/02/11/21/39/weightlifter-3146825_960_720.jpg',
        'https://cdn.pixabay.com/photo/2018/04/12/23/06/magic-3315128_960_720.jpg',
        'https://cdn.pixabay.com/photo/2017/10/04/17/52/the-magician-2817039_960_720.jpg',
        'https://cdn.pixabay.com/photo/2016/11/30/16/27/circus-1873241_960_720.jpg',
        'https://cdn.pixabay.com/photo/2013/02/05/13/53/acrobats-78047_960_720.jpg'
        ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        for ($i = 0; $i < 6; $i++) {
            $article = new Article();
            $article->setTitle($faker->sentence(4));
            $article->setDate($faker->dateTime);
            $article->setDescription($faker->sentence(100));
            $article->setPoster(self::POSTERS[$i]);
            $manager->persist($article);
        }
            $manager->flush();
    }
}
