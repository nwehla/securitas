<?php

namespace App\Tests\Entity;

use DateTime;
use App\Entity\Commentaires;
use PHPUnit\Framework\TestCase;

class CommentairesTest extends TestCase
{
    public function testValide(): void
    {
        $Commentaires = new Commentaires();
        $dateTime = new DateTime();

        $Commentaires
                        ->setAuteur('Auteur')
                        ->setDate($dateTime)
                        ->setMail('mail')
                        ->setCommentaire('commentaire');
                                 
        $this->assertTrue($Commentaires->getAuteur() ==='Auteur');
        $this->assertTrue($Commentaires->getDate()===$dateTime);
        $this->assertTrue($Commentaires->getMail()==='mail');
        $this->assertTrue($Commentaires->getCommentaire()==='commentaire');
    }
        

        public function testError(): void
    {
        $Commentaires = new Commentaires();
        $dateTime = new DateTime();

        $Commentaires
                        ->setAuteur('Auteur')
                        ->setDate($dateTime)
                        ->setMail('mail')
                        ->setCommentaire('commentaire');
        

                
                                
        $this->assertFalse($Commentaires->getAuteur() !=='Auteur');
        $this->assertFalse($Commentaires->getDate()!== $dateTime);
        $this->assertFalse($Commentaires->getMail()!=='mail');
        $this->assertFalse($Commentaires->getCommentaire()!=='commentaire');
        
    }

        public function testVide(): void
    {
        $Commentaires = new Commentaires();
        $this->assertEmpty($Commentaires->getAuteur());
        $this->assertEmpty($Commentaires->getDate());
        $this->assertEmpty($Commentaires->getMail());
        $this->assertEmpty($Commentaires->getCommentaire());
        
    }
}
