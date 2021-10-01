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

class RootAdminDevController extends AbstractController
{
    /**
     * @Route("/root/admin/dev/add", name="root_admin_dev_add")
     */
    public function devAdd(Request $request, EntityManagerInterface $em): Response
    {
        $development = new Development();
        $form = $this->createForm(DevelopmentAddType::class,$development);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $request->files->get('development_add')['file'];
            $development->setFile($file);
            $development->setUpdatedAt(new \DateTime());
            $em->persist($development);
            $em->flush();
            return $this->redirectToRoute('root_admin_home');
        }

        return $this->render('root-admin/development_add.html.twig',[
            'form'=>$form->createView()
        ]);
    }


}
