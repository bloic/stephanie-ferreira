<?php

namespace App\Controller\Admin;

use App\Entity\Testimony;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TestimonyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Testimony::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','témoignage');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Authors'),
            TextField::new('content'),
            DateField::new('createAt'),
            BooleanField::new('isValid')
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW);
    }

}
