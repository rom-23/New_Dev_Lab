<?php

namespace App\Controller\RootAdmin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RootAdminController extends AbstractController
{
    /**
     * @Route("/root/admin", name="root_admin")
     */
    public function index(): Response
    {
        return $this->render('root-admin/index.html.twig', [
            'symfonyRoutes' => [
                'edit_data' => $this->generateUrl('test')
            ]]);
    }

    /**
     * @Route("/app/{vueRouting}", name="vue_app")
     */
    public function redirectToApp(): Response
    {
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(): Response
    {
        return $this->render('home/test.html.twig');
    }

}
