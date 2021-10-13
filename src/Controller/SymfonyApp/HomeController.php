<?php

namespace App\Controller\SymfonyApp;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private const BASE_PATH = 'http://127.0.0.1:8000/apiplatform/';

    #[Route('/symfony/developments', name: 'development_list')]
    public function index(): Response
    {
        $allDev_json = json_decode(file_get_contents(self::BASE_PATH.'developments'));
        return $this->render('symfony-app/development-list.html.twig', [
            'developments' => $allDev_json
        ]);
    }

    #[Route('/symfony/development/{id<\d+>}', name: 'development_view')]
    public function view(Request $request): Response
    {
        $dev_json = json_decode(file_get_contents(self::BASE_PATH.'developments/'.$request->attributes->get('id')));
        $html= $this->renderView('symfony-app/development-view.html.twig', [
            'dev'  => $dev_json
        ]);
        return $this->json(['view' => $html]);
    }

    #[Route('/symfony/section/{id<\d+>}', name: 'section_view')]
    public function viewBySection(Request $request): Response
    {
        $dev_json = json_decode(file_get_contents(self::BASE_PATH.'developments/section/'.$request->attributes->get('id')));
        $html= $this->renderView('symfony-app/development-section.html.twig', [
            'dev'  => $dev_json
        ]);
        return $this->json(['view' => $html]);
    }

}
