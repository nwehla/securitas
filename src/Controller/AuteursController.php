<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteursController extends AbstractController
{
    /**
     * @Route("/auteurs", name="auteurs")
     */
    public function index(): Response
    {
        return $this->render('auteurs/index.html.twig', [
            'controller_name' => 'AuteursController',
        ]);
    }
}
