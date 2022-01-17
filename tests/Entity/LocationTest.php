<?php

namespace App\Tests\Entity;

use DateTime;
use App\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LocationTest extends KernelTestCase
{
     public function testValide(): void
   {
       $Location = new Location();
       $dateTime = new DateTime();

       $Location
                       ->setTitre('titre')
                       ->setStatus('status')
                       ->setCategories('categorie')
                       ->setDate($dateTime)
                       ->setImages('images')
                       ->setDescription('description')
                       ->setValeur('valeur')
                       ->setAdresse('adresse')
                       ->setAlaune(true)
                       ->setAccessibility(true);
                               
       $this->assertTrue($Location->getTitre() ==='titre');
       $this->assertTrue($Location->getStatus()==='status');
       $this->assertTrue($Location->getCategories()==='categorie');
       $this->assertTrue($Location->getDate()===$dateTime);
       $this->assertTrue($Location->getImages()==='images');
       $this->assertTrue($Location->getDescription()==='description');
       $this->assertTrue($Location->getValeur()==='valeur');
       $this->assertTrue($Location->getAdresse()==='adresse');
       $this->assertTrue($Location->getAlaune()===true);
       $this->assertTrue($Location->getAccessibility()===true);
   }

       public function testError(): void
   {
       
    $Location = new Location();
    $dateTime = new DateTime();

    $Location
                    ->setTitre('titre')
                    ->setStatus('status')
                    ->setCategories('categorie')
                    ->setDate($dateTime)
                    ->setImages('images')
                    ->setDescription('description')
                    ->setValeur('valeur')
                    ->setAdresse('adresse')
                    ->setAlaune(true)
                    ->setAccessibility(true);
                            
    $this->assertFalse($Location->getTitre() !=='titre');
    $this->assertFalse($Location->getStatus() !=='status');
    $this->assertFalse($Location->getCategories() !=='categorie');
    $this->assertFalse($Location->getDate() !== $dateTime);
    $this->assertFalse($Location->getImages() !=='images');
    $this->assertFalse($Location->getDescription() !=='description');
    $this->assertFalse($Location->getValeur() !=='valeur');
    $this->assertFalse($Location->getAdresse() !=='adresse');
    $this->assertFalse($Location->getAlaune() !==true);
    $this->assertFalse($Location->getAccessibility() !==true);
   }

       public function testVide(): void
   {
       $Location = new Location();
       $this->assertEmpty($Location->getTitre());
       $this->assertEmpty($Location->getStatus());
       $this->assertEmpty($Location->getCategories());
       $this->assertEmpty($Location->getDate());
       $this->assertEmpty($Location->getAdresse());
       $this->assertEmpty($Location->getValeur());
       $this->assertEmpty($Location->getAccessibility());
       $this->assertEmpty($Location->getAlaune());
       $this->assertEmpty($Location->getImages());
       $this->assertEmpty($Location->getDescription());
   }
}
