<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Location;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class LocationFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {$faker = Faker\Factory::create('fr_FR');
        $stat=["Actif","Désactivé","Occupé"];
        shuffle($stat);

        // Creer occurence de 200 locations
        for ($k = 0; $k<2000; $k++) {
            $locations= new Location();
            shuffle($stat);
            $locations->setTitre($faker->title())
                ->setDate(new \Datetime)
                ->setImages($faker->imageUrl())
                ->setCategories($faker->company())
                ->setDescription($faker->sentence())
                ->setAdresse($faker->address())
                ->setStatus($stat[0])
                ->setValeur(mt_rand(1,1000))
                ->setAccessibility($faker->boolean(50))
                ->setAlaune($faker->boolean(50));


            $manager->persist($locations);
        }
        
        $manager->flush();
    } 
    public static function getGroups(): array
  {
     return ['group4'];
  }     

    
      
  
    }

