<?php

namespace App\DataFixtures;


use DateTime;
//use Faker\Factory;
use App\Entity\Utilisateurs;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker;

class UtilisateursFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $faker= Faker\Factory::create('fr_FR');

        for ($i=0; $i<20 ; $i++ ) 
      { 
          $utilisateurs = new Utilisateurs();
          $nom=["Moussa","Ndao","Nwehla","Michot","Balouka","Follereau"];
          $prenom=["Konate","Modou","Valery","Frederique","Roger","Fabrice"];
           $rol=array('locataire','propriétaire','gestionnaire','administrateur');
          shuffle($rol);
          shuffle($nom);
          shuffle($prenom);
          
          $utilisateurs->setNom($nom[0])
                  ->setPrenom($prenom[0])   
                  ->setPhoto($faker->imageUrl())  
                  ->setDatedenaissance( new DateTime())    
                  ->setLogin($faker->sentence())    
                  ->setAdresse($faker->address())    
                  ->setEmail($faker->email())    
                  ->setPassword(password_hash('mdp', PASSWORD_DEFAULT));
                  //   ->setRoles($rol); 
                   
          $manager->persist($utilisateurs);
      }
   $manager->flush();
  }   
    
}
