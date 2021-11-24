<?php

namespace App\DataFixtures;

use Faker;
use DateTime;
use App\Entity\Auteurs;
use App\Entity\Articles;
use App\Entity\Categorie;
use App\Entity\Commentaires;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Validator\Constraints\Date;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void

    {
        $faker = Faker\Factory::create('fr_FR');

        // Creer occurence de 5 Auteurs
        for ($k = 0; $k<5; $k++) {
            $auteurs = new Auteurs();
            $auteurs->setNom($faker->firstName())
                ->setPrenom($faker->lastName())
                ->setMail($faker->sentence());
            $manager->persist($auteurs);
                // Mainteannt je cree mes Categories
            for ($i = 0; $i < 5; $i++) {
                $categories = new Categorie();
                $categories->setTitre($faker->sentence())
                    ->setResume($faker->sentence());

                $manager->persist($categories);
                     

                // Mainteannt je cree mes Articles

                for ($j = 0; $j < 10; $j++) {
                    $articles = new Articles();

                    $articles->setTitre($faker->sentence())
                        ->setImages($faker->imageUrl())
                        ->setResume($faker->sentence())
                        ->setContenu($faker->sentence())
                        ->setDate(new \DateTime())
                        ->setCategorie($categories)
                        ->setAuteurs($auteurs);
                        $manager->persist($articles);

                             //je mets des commentaires

                for($l=0;$l<6;$l++)
           {
                $commentaires=new Commentaires();

                $commentaires->setAuteur($faker->lastName())
                             ->setMail($faker->sentence())
                             ->setDate(new \Datetime)
                             ->setCommentaire($faker->sentence())
                             ->setArticle($articles);

                             $manager->persist($commentaires);

                             

                }
           
                    
                }
            
            }
        }
        

        $manager->flush();
    }
}
