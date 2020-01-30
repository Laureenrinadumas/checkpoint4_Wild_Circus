<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Price;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;

class PriceFixtures extends Fixture
{
    const PRICES = [
        20,
        10,
        80,
        8,
        95,

    ];

    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     *
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::PRICES as $key => $sellingPrice) {
            $price = new Price();
            $price->setSellingPrice($sellingPrice);
            $this->addReference('price_' . $key, $price);
            $manager->persist($price);
        }
        $manager->flush();
    }
}