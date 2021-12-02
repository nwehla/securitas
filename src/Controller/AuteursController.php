<?php

namespace App\Controller;


use App\Entity\Auteurs;
use App\Form\AuteursType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AuteursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
     * @Route("/auteur")
     */
     class AuteursController extends AbstractController
{
     /**
     * @Route("/", name="auteur")
     */
    public function auteur(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Auteurs::class);
        $auteurs=$repo->findAll();
        return $this->render('auteurs/auteur.html.twig', [
            'auteurs'=>$auteurs,
        ]);
    }
    /**
         *@Route("/formulaire",name="aut_formulaire")
         */
        public function formulaire( Request $request,EntityManagerInterFace $manager,UserPasswordEncoderInterface $encoder):Response
        {
            $auteurs= new Auteurs();
            $form=$this->createForm(AuteursType::class);
            $form->handleRequest($request);
            if($form->isSubmitted()&&$form->isValid()){
                $passwordCrypte=$encoder->encodePassword($auteurs,$auteurs->getPassword());
                $auteurs->setPassword($passwordCrypte);
                $auteurs=$form->getData();
                $manager->persist($auteurs);
                $manager->flush();
    
                return $this->redirectToRoute('affi_auteur',[
                    'id'=>$auteurs->getId(),
                ]);
    
            }
            return $this->render('auteurs/formulaire.html.twig', [
                
                'form'=>$form->createView(),
            ]);
        }
    
    /**
         *@Route("/connection",name="aut_connection")
         */
        public function connecter():Response
        {

            return $this->render('auteurs/connection.html.twig') ;
        }
    
    /**
     * @Route("/{id}", name="affi_auteur", methods={"GET"})
     */
    
        public function afficheauteur(Auteurs $auteur): Response
        {
            return $this->render("auteurs/affiche.html.twig",[
                "id"=>$auteur->getId(),
             'article'=>$auteur->getArticle(),
                'auteur'=>$auteur,
               
            ]);
        }
    
    

    /**
     * @Route("/{id}/edit",name="edit_auteur", methods={"GET" , "POST"})
     */
    public function editer(EntityManagerInterface $manager,Request $request,Auteurs $auteur): Response
    {
        $form=$this->createForm(AuteursType::class,$auteur);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $manager->flush();
                return $this->redirectToRoute('affi_auteur',[
                    'id'=>$auteur->getId(),
                ]);            }
            

        return $this->render('auteurs/formulaire.html.twig', [
            'form'=>$form->createView(),
        ]);
    }
}     

