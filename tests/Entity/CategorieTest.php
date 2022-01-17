<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Categorie;


class CategorieTest extends KernelTestCase
{
    public function testnonValide(): void

    {
        $categorie = new Categorie();
        $categorie->setResume("la belle fille")
                    ->setTitre("le titre");
    
       // $this->assertTrue(true);
       $this->assertFalse($categorie->getResume() !== "la belle fille");
       $this->assertFalse($categorie->getTitre() !== "le titre");
   }
        
    public function testValide(): void

    {
        $categorie = new Categorie();
        $categorie->setResume("la belle fille")
                    ->setTitre("le titre");
    
       // $this->assertTrue(true);
       $this->assertTrue($categorie->getResume() === "la belle fille");
       $this->assertTrue($categorie->getTitre() === "le titre");
   }
    public function testVide(): void

    {
        $categorie = new Categorie();
       
       // $this->assertTrue(true);
       $this->assertEmpty($categorie->getResume());
       $this->assertEmpty($categorie->getTitre());
   }
    
        

    
    
}
