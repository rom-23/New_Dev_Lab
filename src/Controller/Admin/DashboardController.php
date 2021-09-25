<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Development;
use App\Entity\Image;
use App\Entity\Model;
use App\Entity\Option;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/*
 * @IsGranted("ROLE_ADMIN")
 */

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
                        ->setTitle('Admin Home');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToRoute('Home', 'fas fa-home', 'home'),
            MenuItem::section('Modelism'),
            MenuItem::linkToCrud('Model', 'fas fa-list', Model::class),
            MenuItem::linkToCrud('Category', 'fas fa-list', Category::class),
            MenuItem::linkToCrud('Option', 'fas fa-list', Option::class),
            MenuItem::linkToCrud('Image', 'fas fa-list', Image::class),
            MenuItem::section('Dev'),
            MenuItem::linkToCrud('Development', 'fas fa-list', Development::class),
            MenuItem::section('Users'),
            MenuItem::linkToCrud('User', 'fas fa-list', User::class)
        ];
    }
}
