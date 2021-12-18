<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Mailer\ContactMailer;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Transport\TransportInterface;

class HomeController extends AbstractController
{
    private ContactMailer $mailer;

    public function __construct(ContactMailer $mailer){
        $this->mailer= $mailer;
    }


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
    public function contact(Request $request): Response
    {

        //Instanciation d'un nouveau Contact via notre Entity Contact::class
        $contact = new Contact(); 

        $form = $this->createForm(ContactType::class, $contact); 

        //Demande au formulaire du framework d'interpreter la requete
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            
            $this->addFlash('success', 'Merci, votre message a été pris en compte !');
            
            try{
                $this->mailer->send($contact);
            }catch(TransportExceptionInterface){
                
            }
            

            return $this->redirectToRoute('main_contact');
        }


        return $this->render('home/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
