<?php

namespace App\Controller\Api;

use App\Repository\ModelRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
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

        return new JsonResponse($data, Response::HTTP_CREATED, [], true);
    }

    /**
     * @Route("/api/all-models", name="api_all_models", methods="GET")
     * @Route("/{vueRouting}", requirements={"route"="^.+"}, name="vue_routing")
     * @param ModelRepository $modelRepository
     * @return JsonResponse
     */
    public function getAllModels(ModelRepository $modelRepository): JsonResponse
    {
        $models =$modelRepository->findModelPng();
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
        $serializer = new Serializer([$normalizer], [$encoder]);

        return new JsonResponse($serializer->serialize($models, 'json',['attributes'=>['name','filename','images'=>['path'],'description','categories'=>['name','id']]]), Response::HTTP_CREATED, [], true);
    }


}
