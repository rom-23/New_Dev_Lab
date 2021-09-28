<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\Development\DevelopmentRepository;
use App\Repository\ModelRepository;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;


class ApiController extends AbstractController
{

    /**
     * @Route("/api/all-users", name="api_all_users", methods="GET")
     * @param SerializerInterface $serializer
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function getAllUsers(SerializerInterface $serializer, UserRepository $userRepository): JsonResponse
    {
        $data = $serializer->serialize($userRepository->findAll(['id' => 'DESC']), JsonEncoder::FORMAT);
        return new JsonResponse($data, Response::HTTP_CREATED, [], true);
    }

    /**
     * @Route("/api/all-models", name="api_all_models", methods="GET")
     * @param ModelRepository $modelRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAllModels(ModelRepository $modelRepository, SerializerInterface $serializer): JsonResponse
    {
        $models = $modelRepository->findModelPng();
//        $encoder        = new JsonEncoder();
//        $normalizer     = new ObjectNormalizer();
//        $serializer     = new Serializer([$normalizer], [$encoder]);

//        return new JsonResponse($serializer->serialize($models, 'json', [
////            'attributes'                 => ['name', 'filename', 'images' => ['path'], 'description', 'categories' => ['name', 'id']],
//            'groups' => ['get']
////            'circular_reference_handler' => function ($object) {
////                return $object->getId();
////            }
//        ]), Response::HTTP_CREATED, [], true);
        return $this->json($models, 200, [], ['groups' => 'get']);
    }

    /**
     * @Route("/api/users/add", name="api_add_user", methods="POST")
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function addUser(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $json = json_encode(json_decode($request->getContent())->params);
        $user = $serializer->deserialize($json, User::class, 'json');
        $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
        $em->persist($user);
        $em->flush();
        return $this->json($user, 201, []);
    }
}
