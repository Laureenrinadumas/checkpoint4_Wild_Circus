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
        [
            'price' => 20,
            'customer' => 'Adult'

        ],
        [
            'price' =>  10,
            'customer' => 'Children under 16',

        ],
        [
            'price' =>80,
            'customer' =>  'Group (more than 10 people)',

        ],
        [
            'price' =>  8,
            'customer' => 'Person with reduced mobility',

        ],
        [
            'price' => 95,
            'customer' => 'School',

        ],
    ];

    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     *
     */
    public function load(ObjectManager $manager)
    {
        for ($i=0 ; $i<5; $i++) {

            $price = new Price();
            $price->setAmount(self::PRICES[$i]['price']);
            $price->setCustomer(self::PRICES[$i]['customer']);
            $manager->persist($price);
        }
        $manager->flush();
    }
}