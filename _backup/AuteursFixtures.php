<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Auteurs;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
 use Faker;

class AuteursFixtures extends Fixture implements FixtureGroupInterface

 {
     public function load(ObjectManager $manager): void
 
     {
     $faker = Faker\Factory::create('fr_FR');
     for ($j=0; $j<200 ; $j++ ) 
     { 
         $auteurs= new Auteurs();
         
         $auteurs->setNom("nom $j")
                 ->setPrenom("Prénom de $j")
                 ->setMail("mail de $j")
                 ->setPassword("password de $j")
                 ->setUsername("username de $j")
                 ->setArticle( );
                 

             $manager->persist($auteurs);
     }
 
$manager->flush();

}
public static function getGroups(): array
  {
     return ['group3'];
  }     
  

 }
