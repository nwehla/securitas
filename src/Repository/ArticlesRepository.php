<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ArticlesRepository as RepositoryArticlesRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }
    public function findByArticleStatus(){
        $qb = $this->createQueryBuilder('a');

        $qb
            ->select('a')
            ->where('a.status =:status ')
            ->setParameter('status', 'Publié')
            ->orderBy('a.titre', 'ASC');

        return $qb->getQuery()->getResult();
    
    }

    // /**
    //  * @return Articles[] Returns an array of Articles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Articles
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * Ceci est 1 exmple 
     * Affiche en details d'un article
     * @param $id
     * @param ArticlesRepository, $articlesrepo 
     * @Route("article/{id}", name="article_id", methods={"GET"})
    */
    public function affichage($id, ArticlesRepository $articlesrepo  ) 
    {
        // Appel à Doctrine & au repository
        // $articlesrepo = $this->getDoctrine()->getRepository(Autheur::class);
        //Recherche d'un article avec son identifaint
        $article = $articlesrepo->find($id);
        // Passage à Twig de tableau avec des variables à utiliser
       
               if (!$article) {
            throw $this->createNotFoundException(
                'Desolé il y a Aucun article pour ce id : '.$id
            );
        }
        return $this->render('article/article2.html.twig', [
            'article' => $article
        ]);
}
}
