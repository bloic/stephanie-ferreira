<?php

namespace App\Controller\Admin;

use App\Entity\Commentary;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class CommentaryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentary::class;

    }


    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            //TextField::new('title'),
             TextEditorField::new('comment'),


        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Action::NEW);
    }

}
