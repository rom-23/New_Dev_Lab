<?php

namespace App\Controller\RootAdmin;

use App\Entity\Development\Development;
use App\Entity\Modelism\Model;
use App\Form\DevelopmentAddType;
use App\Form\ModelAddType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RootAdminModelController extends AbstractController
{
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
            return $this->redirectToRoute('root_admin_home');
        }
        return $this->render('root-admin/model_add.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
