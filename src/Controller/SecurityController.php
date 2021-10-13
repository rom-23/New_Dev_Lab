<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    #[Route(path: '/apiplatform/login', name: 'api_platform_login', methods: ['POST'])]
    public function apiPlatformLogin(): JsonResponse
    {
        $user = $this->getUser();
        return $this->json([
            'username' => $user->getUserIdentifier(),
            'roles'    => $user->getRoles()
        ]);
    }

    #[Route(path: '/logout', name: 'logout', methods: ['POST'])]
    public function apiPlatformLogout()
    {

    }

    /**
     * @Route("/login", name="app_login")
     * @Route("/{vueRouting}", requirements={"vueRouting"="^(?!apiplatform|symfony).+"}, name="vue_routing")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $this->denyAccessUnlessGranted('IS_ANONYMOUS');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
}
