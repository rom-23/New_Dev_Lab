<?php

namespace App\Controller\RootAdmin;

use App\Entity\Modelism\Model;
use App\Form\ModelAddType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RootAdminController extends AbstractController
{
    /**
     * @Route("/root/admin/home", name="root_admin_home")
     */
    public function home(Request $request, EntityManagerInterface $em): Response
    {
        return $this->render('root-admin/home.html.twig');
    }
    /**
     * @Route("/root/admin/model/add", name="root_admin_model_add")
     */
    public function modelAdd(Request $request, EntityManagerInterface $em): Response
    {
        $model = new Model();
        $form = $this->createForm(ModelAddType::class,$model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()->getImages() as $image){
                $em->persist($image);
                $model->addImage($image);
            }
            $em->persist($model);
            $em->flush();
            $this->AddFlash('notice', 'Model has been added.');
            return $this->redirectToRoute('root_admin_home');
        }
        return $this->render('root-admin/model_add.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
