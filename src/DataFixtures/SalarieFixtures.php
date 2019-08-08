<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Salarie;
use App\Entity\Contrat;

class SalarieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        
                    //Créer entre 5 et 15 salarié
        for($j = 1; $j <= mt_rand(5, 15); $j++){
            $salarie = new Salarie();
            $salarie->setNom($faker->lastname())
                    ->setPrenom($faker->firstName())
                    ->setTelephone($faker->e164PhoneNumber())
                    ->setAdresse($faker->address())
                    ->setEmail($faker->email())
                    ->setVilleNaissance($faker->city())
                    ->setPaysNaissance($faker->country())
                    ->setNationalite($faker->countryCode());

            $manager->persist($salarie);
//Créer 3 catégories fakées
            for($i = 1; $i <=3; $i){
                $contrat = new Contrat();
                $contrat->setIntitul($faker->name())
                        ->setType($faker->currencyCode())
                        ->setDuree($faker->randomDigitNotNull())
                        ->setHorairesHebdo($faker->dayOfMonth())
                        ->setIsValid($faker->boolean())
                        ->setTotalConges($faker->biasedNumberBetween())
                        ->setTotalTeletravail($faker->biasedNumberBetween());

                $manager->persist($contrat);

            }
        }
        $manager->flush();
    }
}
