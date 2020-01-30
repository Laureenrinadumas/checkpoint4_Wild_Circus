<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;

class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    const CUSTOMERS = [
        'Adult',
        'Children under 16',
        'Group (more than 10 people)',
        'Person with reduced mobility',
        'School',
    ];

    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::CUSTOMERS as $key => $customerName) {

            $customer = new Customer();
            $customer->setName($customerName);
            $customer->setPrice($this->getReference('price_' . $key));

            $manager->persist($customer);
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
        return [PriceFixtures::class];
    }
}

