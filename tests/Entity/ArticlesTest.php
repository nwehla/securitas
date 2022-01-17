<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Articles;


class ArticlesTest extends TestCase
{
    public function testnonValide(): void

    {
        $article = new Articles();
        $article->setContenu("la belle fille")
                    ->setTitre("le titre");
    
       // $this->assertTrue(true);
       $this->assertFalse($article->getContenu() !== "la belle fille");
       $this->assertFalse($article->getTitre() !== "le titre");
   }
}
   
