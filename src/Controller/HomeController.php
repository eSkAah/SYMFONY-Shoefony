<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'main_homepage', methods:['GET'])]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/presentation', name: 'main_presentation', methods:['GET'])]
    public function presentation(): Response
    {
        return $this->render('home/presentation.html.twig', [
            
        ]);
    }
    
   

    #[Route('/contact', name: 'main_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
    
        ]);
    }


}
