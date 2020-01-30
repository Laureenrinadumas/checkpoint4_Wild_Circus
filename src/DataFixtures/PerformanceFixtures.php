<?php

namespace App\DataFixtures;

use App\Entity\Performance;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class PerformanceFixtures extends Fixture
{
    const DURATIONS = [
        [
            'duration' => 3,
            'poster' => 'https://cdn-s-www.estrepublicain.fr/images/9a1e01a0-f1ad-487c-88b3-87ec86352684/BES_06/illustration-hotel-cirque-eloize_1-1566298442.jpg'

        ],
        [
            'duration' => 2,
            'poster' => 'https://static.cnews.fr/sites/default/files/2019_redaction/toruk4_1.jpg'

        ],
        [
            'duration' => 4,
            'poster' => 'https://bonlieu-annecy.com/wp-content/uploads/2019/06/Teh-Dar_Credit-Photo-Dragon-Images-02-1920x1280.jpg'

        ],
        [
            'duration' => 2,
            'poster' => 'https://co-events.com/fr/wp-content/uploads/sites/2/2019/09/Spectacle-cirque-complet-2.jpg'

        ],
        [
            'duration' => 2,
            'poster' => 'https://lvdneng.rosselcdn.net/sites/default/files/dpistyles_v2/ena_16_9_extra_big/2018/11/01/node_480454/39835515/public/2018/11/01/B9717436943Z.1_20181101182706_000%2BGPECB2TQA.1-0.jpg?itok=Z69uHnXS1541160174'

        ],
        [
            'duration' => 4,
            'poster' => 'https://cdn-s-www.republicain-lorrain.fr/images/5D53F192-0DC9-42C0-A949-A69CAC7F7756/NW_raw/le-cirque-national-de-chine-s-installe-le-temps-d-une-representation-a-la-saarlandhalle-a-sarrebruck-ce-dimanche-photo-dr-1579019076.jpg'

        ],

    ];

    /**
     * Load data fixtures with the passed EntityManager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        for ($i = 1; $i < 6; $i++) {
            $performance = new Performance();
            $performance->setName($faker->name);
            $performance->setTitle($faker->sentence(3));
            $performance->setDescription($faker->sentence(30));
            $performance->setDuration(self::DURATIONS[$i]['duration']);
            $performance->setPoster(self::DURATIONS[$i]['poster']);
            $manager->persist($performance);
        }
            $manager->flush();
    }
}