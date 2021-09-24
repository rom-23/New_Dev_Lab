<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;


class ApiController extends AbstractController
{

    /**
     * @Route("/api/all-users", name="api_all_users", methods="GET")
     * @Route("/{vueRouting}", requirements={"route"="^.+"}, name="vue_routing")
     * @param SerializerInterface $serializer
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function getAllUsers(SerializerInterface $serializer, UserRepository $userRepository): JsonResponse
    {
        $data = $serializer->serialize($userRepository->findAll(), JsonEncoder::FORMAT);

        $this->generateUrl('api_all_users');

        return new JsonResponse($data, Response::HTTP_CREATED, [], true);
    }


}
