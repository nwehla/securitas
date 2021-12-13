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
        $sta=array('Publié','Dépublié','Archivé');
       $cat=['thriller','policier','ado','bande_dessinee','roman'];
       $rand=mt_rand(3,5);


        // Creer occurence de 5 Auteurs
        for ($k = 0; $k<5; $k++) {
         

            $auteurs = new Auteurs();
            $auteurs->setNom($faker->firstName())
                ->setPrenom($faker->lastName())
                ->setUsername($faker->lastName())
                ->setPassword(password_hash('mdp', PASSWORD_DEFAULT))
                ->setMail($faker->email());
            $manager->persist($auteurs);
                // Mainteannt je cree mes Categories
            for ($i = 0; $i < $rand; $i++) {
                $categories = new Categorie();
                shuffle($cat);
                $categories->setTitre($cat[0])
                    ->setResume($faker->sentence());

                $manager->persist($categories);
                     

                // Mainteannt je cree mes Articles

                for ($j = 0; $j < 10; $j++) {

                    shuffle($sta);
                    $articles = new Articles();

                    $articles->setTitre($faker->sentence())
                        ->setImages($faker->imageUrl())
                        ->setResume($faker->sentence())
                        ->setContenu($faker->sentence())
                        ->setStatus($sta[0])
                        ->setDate(new \DateTime())
                        ->setCategorie($categories)
                        ->setAuteurs($auteurs);
                        $manager->persist($articles);

                             //je mets des commentaires

                for($l=0;$l<5;$l++)
           {
                $commentaires=new Commentaires();

                $commentaires->setAuteur($faker->lastName())
                             ->setMail($faker->email())
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
