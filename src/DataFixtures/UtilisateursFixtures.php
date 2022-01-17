<?php

namespace App\DataFixtures;


use Faker;
//use Faker\Factory;
use DateTime;
use App\Entity\Utilisateurs;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class UtilisateursFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
      $faker= Faker\Factory::create('fr_FR');

        for ($i=0; $i<1000 ; $i++ ) 
      { 
          $utilisateurs = new Utilisateurs();
          $nom=["Moussa","Ndao","Nwehla","Michot","Balouka","Follereau"];
          $prenom=["Konate","Modou","Valery","Frederique","Roger","Fabrice"];
           $rol=array('locataire','propriétaire','gestionnaire','administrateur');
           $civ=array('Homme','Femme');
           $sta=array('Publié','Dépublié','Archivé');
          
           shuffle($rol);
          shuffle($nom);
          shuffle($prenom);
          shuffle($civ);
          shuffle($sta);

          
          $utilisateurs->setNom($nom[0])
                  ->setPrenom($prenom[0])   
                  ->setPhoto($faker->imageUrl())  
                  ->setDatedenaissance( new DateTime())    
                  ->setLogin($faker->sentence())    
                  ->setAdresse($faker->address())    
                  ->setEmail($faker->email())    
                  ->setCivilite($civ[0])    
                  ->setStatus($sta[0])    
                  ->setPassword(password_hash('mdp', PASSWORD_DEFAULT));
                  //   ->setRoles($rol); 
                   
          $manager->persist($utilisateurs);
      }
   $manager->flush();
  }
  public static function getGroups(): array
  {
     return ['group1'];
  }     
   
    
}
