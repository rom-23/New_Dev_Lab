<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Route("/{vueRouting}", requirements={"vueRouting"="^(?!admin).+"}, name="vue_routing")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'symfonyRoutes' => [
                'edit_data' => $this->generateUrl('test')
            ]]);
    }

    /**
     * @Route("/app/{vueRouting}", name="vue_app")
     * @Route("/{vueRouting}", requirements={"route"="^.+"}, name="vue_routing")
     */
    public function redirectToApp(): Response
    {
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/test", name="test")
     * @Route("/{vueRouting}", requirements={"route"="^.+"}, name="vue_routing")
     */
    public function test(): Response
    {
        return $this->render('home/test.html.twig');
    }

}
