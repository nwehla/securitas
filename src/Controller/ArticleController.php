<?php

namespace App\Controller;
use App\Entity\Auteurs;
use App\Entity\Articles;
use App\Entity\Recherche;
use App\Form\ArticlesType;
use App\Form\RechercheType;
use App\Entity\Commentaires;
use App\Entity\RechercheCategorie;
use App\Entity\Categorie;
use App\Form\CommentaireType;
use App\Form\RechercheCategorieType;
use Doctrine\ORM\EntityManager;
use App\Repository\ArticlesRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/articles")
 */

class ArticleController extends AbstractController
{
    // /**
    //  * @Route("/", name="article")
    //  */
    // public function index(Request $request ,ArticlesRepository $repo,CategorieRepository $cate): Response
    
    // {

    //     $rechercheCategorie = new RechercheCategorie();
    //     $formCategorie = $this->createForm(RechercheCategorieType::class);
    //     $formCategorie->handleRequest($request);
    //     if($formCategorie->isSubmitted() && $formCategorie->isValid()){
    //         $catego = $rechercheCategorie->getCategorie();
    //         $categorie = $catego;
    //         if($catego!=''){
    //             // faire une recherche
    //             $categorie = $cate->findByArticlesCategorie(["titre"=>$catego]);
    //         }else{
    //             $categorie = $cate->findAll();
    //         }

    //     }

    //     $recherche = new Recherche();

    //     $form = $this->createForm(RechercheType::class,$recherche);

    //     $form->handleRequest($request);
       
    //     if($form->isSubmitted() && $form->isValid()){

    //         $titre = $recherche->getTitre();
    //         if($titre!=""){
    //             //faire une recherche
    //             $articles = $repo->findBy(["titre"=>$titre]);

    //         }else{
    //             $articles = $repo->findAll();
    //         }
    //     }
        

    //     return $this->render('article/index.html.twig', [
    //         'controller_name' => 'ArticleController',
    //         "articles"=>$articles,
    //         "form"=>$form->createview(),
    //          "formCategorie"=>$formCategorie->createView(),
    //          "articles"=>$categorie,
        
    //     ]);

    // 

    /**
     * @Route("/_publie" ,name="CatAuteurPublie",methods={"GET"})
     */
    public function articleAuteurPublie(ArticlesRepository $repo) :Response{
        $articles = $repo->articlePublieAuteur();
        return $this->render("article/RechercheAuteurPublié.html.twig",[
            "articles"=> $articles,
        ]);
    }
    
    /**
     * @Route("/" ,name="article",methods={"GET"})
     */
    public function index(ArticlesRepository $repo) :Response{
        $articles = $repo->findAll();
        return $this->render("article/index.html.twig",[
            "articles"=> $articles,
        ]);
    }
    

       
    /**
     * @Route("/status" ,name="article_status",methods={"GET"})
     */
        public function articleParStatus(ArticlesRepository $repo) :Response{
            $articles = $repo-> findByArticleStatus();
            return $this->render('article/recherche.html.twig', [
                'articles' => $articles,
            ]);
        }
    
    // /**
    //  * @Route("/categorie" ,name="article_categorie",methods={"GET"})
    //  */
    //     public function findByArticlesCategorie(ArticlesRepository $repo) :Response{
    //         $articles = $repo-> findByArticleStatus();
    //         return $this->render('article/rechercheCategorie.html.twig', [
    //             'articles' => $articles,
    //         ]);
    //     }
    
    /**
     * @Route("/categorie" ,name="articleduneCategorie",methods={"GET"})
     */
        public function findByArticleduneCategorie(ArticlesRepository $repo) :Response{
            $articles = $repo-> findByArticlesduneCategorie();
            return $this->render('article/rechercheCategorie.html.twig', [
                'articles' => $articles,
            ]);
        }
    
    /**
     * @Route("/Article_auteur" ,name="articledunAuteur",methods={"GET"})
     */
        public function findByArticleAuteur(ArticlesRepository $repo) :Response{
            $articles = $repo-> findByArticlesduneAuteur();
            return $this->render('article/rechercheAuteur.html.twig', [
                'articles' => $articles,
            ]);
        }
    
    /**
     * @Route("/ajouter",name="ajouter_article_form")
     */
    public function ajouter_form_article(Request $request,EntityManagerInterface $manager):Response
    {
        $articles= new Articles();
        $form = $this->createForm(ArticlesType::class);
               $form->handleRequest($request);
               if($form->isSubmitted() && $form->isValid()){
                   $articles=$form->getData();
                   $manager->persist($articles);
                   $manager->flush();
                   $this->addFlash("Article","Vous avez bien ajouté avec succès!");

                   return $this->redirectToRoute("article");
               }
               return $this->render("article/new2.html.twig",[
                   "form"=>$form->createView(),
               ]);
            
    }
    
    /**
     * @Route("/nouvelarticle", name="aarticle.nouvelarticle", methods={"GET", "POST"})
     */
        // Ici on Fait une Enregistrement avec une Formulaire

        public function pageForm(Request $request, EntityManagerInterface $manager)
    {
        $articles =new Articles(); // Instanciation


        // Creation de mon Formulaire
        $form = $this->createFormBuilder($articles) 
                    ->add('titre')
                    ->add('resume')
                    ->add('contenu')
                    ->add('date')
                    ->add('images')

            // Demande le résultat
            ->getForm();

        // Analyse des Requetes & Traitement des information 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($articles); 
            $manager->flush();

            return $this->redirectToRoute('article', 
            ['id'=>$articles->getId()]); // Redirection vers la page
        }

        // Redirection du Formulaire vers le TWIG pour l’affichage avec
        return $this->render('article/new2.html.twig', [
            'formArticle' => $form->createView()
        ]);
    }

     /**
     * @Route("/nouveau", name="articles_nouveau", methods={"GET", "POST"})
     */
    public function nouveau(Request $request, EntityManagerInterface $em): Response
    {

       $articles = new Articles();

       // Ici je fais un enregistrement Manuel, on verra la suite avec le  Formulaire
       $articles->setTitre(" Titre de mon Article");
       $articles->setImages(" photo de mon Article");
       $articles->setResume(" Titre de mon Article");
       $articles->setContenu(" Contenu de mon Article Contenu de mon ArticleContenu de mon ArticleContenu de mon ArticleContenu de mon Article");
       
       $articles->setDate(new  \DateTime());
       // Je persiste Mon Enregistrement
       $em->persist($articles);
       $em->flush();

       // J'envoie au niveau du temple pour l'enregistrement
       return $this->render('article/nouveau.html.twig', [
           'articles' => $articles,
       ]);
    }


     /**
     * Ceci est 1 exmple 
     * Affiche en details d'un Auteur
     * @param $id
     * @param ArticlesRepository, $auteursrepo 
     * @Route("/recherche", name="search", methods={"GET"})
    */
    public function recherche(ArticlesRepository $articleRepo  ){

        $article =  $articleRepo->findBy (array 
        (
            'titre' => 'Est aliquid eveniet et et occaecati. ',
        ), array ('categorie'=>"DESC"), 1,0);

        return $this->render('article/search.html.twig', [
            'article' => $article,
            dump('artilce'),
        ]);
    }


    
//     /**
//      * Ceci est 1 exmple 
//      * Affiche en details d'un article
//      * @Route("/{slug}", name="article_id", methods={"GET"})
//     */
//     public function affichage( /*ArticlesRepository $articlesrepo */ Articles $article ) 
//     {
//         // Appel à Doctrine & au repository
// //$articlesrepo = $this->getDoctrine()->getRepository(Articles::class);
//         //Recherche d'un article avec son identifaint
//         //$article = $articlesrepo->find($slug);
//         // Passage à Twig de tableau avec des variables à utiliser
       
//         //        if (!$article) {
//         //     // throw $this->createNotFoundException(
//         //         return $this->render("article/article2.html.twig"); 
                
        
           
//         // }
//         return $this->render('article/affichage.html.twig', [
//            //'slug' => $article->getSlug(),
//             'articles' => $article
//         ]);
// }
    
    /**
     * Ceci est 1 exmple 
     * Affiche en details d'un article
     * @Route("/{slug}", name="article_id", methods={"GET"})
    */
    public function affichage( /*ArticlesRepository $articlesrepo */ Articles $article ) 
    {
        
        return $this->render('article/affichage.html.twig', [
           'slug' => $article->getSlug(),
            'articles' => $article
        ]);
// }
    }
    
    


     
    //deuxième méthode
    /**
     * @Route("/{slug}", name="art_affichage",methods={"GET","POST"})
     */
    public function montrer(Articles $articles ,EntityManagerInterface $manager,Request $request): Response
    {

        $commentaire = new Commentaires;
        $form=$this->createForm(CommentaireType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $commentaire=$form->getData();
            $manager->persist($commentaire);
            $articles->addCommentaire($commentaire);
            $manager->flush();

            // return $this->redirectToRoute('affi_commetaire',[
                // 'id'=>$commentaire->getId(),
                return $this->redirectToRoute('art_affiche',  ['slug' => $articles->getSlug()

            ]);

        }

        return $this->render('article/affichage.html.twig', [
            //  'id' => $articles->getId(),
             'slug' => $articles->getSlug(),
            'articles' => $articles,
            'auteur'=>$articles->getAuteurs(),
                'form'=>$form->createView(),
            
    
        ]);
    }
    /**
         *@Route("/{id}/edit",name="edit_article")
         */
        public function editer(Request $request,EntityManagerInterface $manager,Articles $article  ):Response
        {
            $form=$this->createForm(ArticlesType::class,$article);
            $form->handleRequest($request);
            if($form->isSubmitted()&& $form->isValid()){
                $manager->flush();
                return $this->redirectToRoute('art_affichage', ['id'=>$article->getId()]);
            }
            return $this->render("article/formulaire.html.twig",[
                "form"=>$form->createView(),
            ]);
        }
        
        /**
         *@Route("/{id}/supprimer",name="suppr_article")
         */
        public function supprimmer(Request $request,EntityManagerInterface $manager,Articles $articles ):Response
        {       $manager->remove($articles);
                $manager->flush();
                return $this->redirectToRoute('article');
        
        }
}
                
