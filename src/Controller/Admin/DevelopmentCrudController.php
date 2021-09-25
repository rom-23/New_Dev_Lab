<?php

namespace App\Controller\Admin;

use App\Entity\Development;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DevelopmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Development::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('title'),
            TextEditorField::new('content')
        ];
    }
}
