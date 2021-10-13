<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route("/app/vue-js", name="vuejs_app")
     */
    public function vueApp(): Response
    {
        return $this->render('vue-js-app/home.html.twig');
    }

    /**
     * @Route("/symfony", name="symfony_app")
     */
    public function symfonyApp(): Response
    {
        return $this->render('symfony-app/home.html.twig');
    }

    /**
     * @Route("/app/{vueRouting}", name="vue_app")
     */
    public function redirectToApp(): Response
    {
        return $this->redirectToRoute('home');
    }



}
