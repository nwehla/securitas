<?php

namespace App\Tests\Entity;

use App\Entity\Utilisateurs;
use PHPUnit\Framework\TestCase;
use DateTime;

class UtilisateursTest extends TestCase
{
    public function testValide(): void
    {
        $utilisateurs = new Utilisateurs();
        $dateTime = new DateTime();

        $utilisateurs
                        ->setCivilite('mme')
                        ->setNom('nome')
                        ->setPrenom('prenoms')
                        ->setDatedenaissance($dateTime)
                        ->setAdresse('adresse')
                        ->setLogin('login')
                        ->setPassword('password')
                        ->setPhoto('photo')
                        ->setEmail('eamail@mail.com')
                        ->setStatus('1');
                                
        $this->assertTrue($utilisateurs->getCivilite() ==='mme');
        $this->assertTrue($utilisateurs->getNom()==='nome');
        $this->assertTrue($utilisateurs->getPrenom()==='prenoms');
        $this->assertTrue($utilisateurs->getDatedenaissance()===$dateTime);
        $this->assertTrue($utilisateurs->getAdresse()==='adresse');
        $this->assertTrue($utilisateurs->getLogin()==='login');
        $this->assertTrue($utilisateurs->getPassword()==='password');
        $this->assertTrue($utilisateurs->getPhoto()==='photo');
        $this->assertTrue($utilisateurs->getEmail()==='eamail@mail.com');
        $this->assertTrue($utilisateurs->getStatus()==='1');
    }

        public function testError(): void
    {
        $utilisateurs = new Utilisateurs();
        $dateTime = new DateTime();

        $utilisateurs
                        ->setCivilite('mme')
                        ->setNom('nome')
                        ->setPrenom('prenoms')
                        ->setDatedenaissance($dateTime)
                        ->setAdresse('adresse')
                        ->setLogin('login')
                        ->setPassword('password')
                        ->setPhoto('photo')

                        ->setEmail('eamail@mail.com')
                        ->setStatus('1');
                                
        $this->assertFalse($utilisateurs->getCivilite() !=='mme');
        $this->assertFalse($utilisateurs->getNom()!=='nome');
        $this->assertFalse($utilisateurs->getPrenom()!=='prenoms');
        $this->assertFalse($utilisateurs->getDatedenaissance()!==$dateTime);
        $this->assertFalse($utilisateurs->getAdresse()!=='adresse');
        $this->assertFalse($utilisateurs->getPhoto()!=='photo');
        $this->assertFalse($utilisateurs->getPassword()!=='password');
        $this->assertFalse($utilisateurs->getLogin()!=='login');
        $this->assertFalse($utilisateurs->getEmail()!=='eamail@mail.com');
        $this->assertFalse($utilisateurs->getStatus()!=='1');

    }

        public function testVide(): void
    {
        $utilisateurs = new Utilisateurs();
        $this->assertEmpty($utilisateurs->getCivilite());
        $this->assertEmpty($utilisateurs->getNom());
        $this->assertEmpty($utilisateurs->getPrenom());
        $this->assertEmpty($utilisateurs->getDatedenaissance());
        $this->assertEmpty($utilisateurs->getAdresse());
        $this->assertEmpty($utilisateurs->getLogin());
        $this->assertEmpty($utilisateurs->getPassword());
        $this->assertEmpty($utilisateurs->getPhoto());
        $this->assertEmpty($utilisateurs->getEmail());
        $this->assertEmpty($utilisateurs->getStatus());
    }
}