<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class CategoriesFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
  {

      
      for ($i=0; $i<100 ; $i++ ) 

      { 
          $cat = new Categorie();
          $cate=["fiction","thriller","policier","jeunesse","adulte"];
        shuffle($cate);
        
          $cat->setTitre($cate[0])
                  ->setResume(" Resume de la categorie N° $i ") ;  
          
          $manager->persist($cat);
      }
   $manager->flush();
  }  
  public static function getGroups(): array
  {
     return ['group2'];
  }     

}
