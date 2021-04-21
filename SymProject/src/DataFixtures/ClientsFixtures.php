<?php

namespace App\DataFixtures;

use App\Entity\Clients;
use App\Entity\Factures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create("fr_FR");
        for ($i = 1; $i<=15;$i++){
            $client = new Clients();
            $client->setName($faker->firstName)
                    ->setAdress($faker->address)
                    ->setFirstname($faker->lastName)
                    ->setPhoneNumber($faker->numberBetween($min = 10000000, $max = 2000000))
                    ->setTvaNumber($faker->numberBetween($min = 10000000, $max = 2000000));
            $manager->persist($client);

            for ($j = 1; $j<=15;$j++){
                $facture = new Factures();
                $facture->setAmount($faker->numberBetween(1000,25000))
                    ->setClient($client)
                    ->setTva(20);

                $manager->persist($facture);
            }
        }
        $manager->flush();
    }
}
