<?php

namespace App\Controller;
use App\Entity\Utilisateurs;


use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilsateursRepository;

use App\Repository\UtilisateursRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/utilisateur")
 */
class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="utilisateur")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Utilisateurs::class);
        $utilisateurs = $repo->findAll();

        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
            "utilisateurs" => $utilisateurs,
            "nbutilisateurs"=> count($utilisateurs),
        ]);
    }
/**
     * @Route("/utilisateurs2", name="utilisateurs_index", methods={"GET"})
     */
    public function usersByCivilité(UtilisateursRepository $utilisateursRepository): Response
    {
         $utilisateurs= $utilisateursRepository->findByUtilisateursCivilites();
         return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
    }
    /**
     * @Route("/status" ,name="utilisateur_status",methods={"GET"})
     */
    public function usersByStatus(UtilisateursRepository $utilisateursRepository): Response
    {
         $utilisateurs= $utilisateursRepository->findByUtilisateursStatus();
         return $this->render('utilisateur/recherche.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
    }

    /**
     * @Route("/form" , name="form_uti")
     */
    public function formuler(Request $request, EntityManagerInterface $manager): Response
    {        $utilisateurs = new Utilisateurs();
        $form = $this->createForm(UtilisateurType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateurs = $form->getData();
            $manager->persist($utilisateurs);
            $manager->flush();
            return $this->redirectToRoute("uti_affiche",["id"=>$utilisateurs->getId()]);
        }
        return $this->render("utilisateur/form2.html.twig", [
            "form" => $form->createView(),
        ]);
    }




    /**
     *@Route("/{id}",name="uti_affiche")
     */
    public function afficheUtilisateur( Utilisateurs $Utilisateurs, Request $Request, EntityManagerInterFace $Manager): Response
    {
        return $this->render("utilisateur/affiche.html.twig", [
            "id" => $Utilisateurs->getId(),
            "uti" => $Utilisateurs,
        ]);
    }

    /**
    *@Route("/{id}/edit",name="edit_utilisateur")
    */
        public function editer(Request $request,EntityManagerInterface $manager,Utilisateurs $utilisateurs ):Response
        {
            $form=$this->createForm(UtilisateurType::class,$utilisateurs);
            $form->handleRequest($request);
            if($form->isSubmitted()&& $form->isValid()){
                $manager->flush();
                return $this->redirectToRoute("uti_affiche",["id"=>$utilisateurs->getId()]);
            }
            return $this->render("utilisateur/form2.html.twig", [
                "form" => $form->createView(),
            ]);
            }
        
     
        /**
         *@Route("/{id}/supprimer",name="suppr_utilisateur")
         */
        public function supprimer(Request $request,EntityManagerInterface $manager,Utilisateurs  $utilisateurs):Response
        {       $manager->remove($utilisateurs);
                $manager->flush();
                return $this->redirectToRoute('utilisateur');
            }

}