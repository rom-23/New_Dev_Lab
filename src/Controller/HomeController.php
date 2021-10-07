<?php

namespace App\Controller;

use App\Form\Contact\ContactType;
use App\Service\SendMailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/app/{vueRouting}", name="vue_app")
     */
    public function redirectToApp(): Response
    {
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, SendMailService $mail)
    {
        $form = $this->createForm(ContactType::class);
        $contact = $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $context = [
                'mail' => $contact->get('email')->getData(),
                'sujet' => $contact->get('sujet')->getData(),
                'message' => $contact->get('message')->getData(),
            ];
            $mail->send(
                $contact->get('email')->getData(),
                'romain.laurent23@gmail.com',
                'Contact depuis le site PetitesAnnonces',
                'contact',
                $context
            );
            $this->addFlash('message', 'Mail de contact envoyé');
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
