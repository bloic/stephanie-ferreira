<?php



namespace App\Controller\Admin;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextField::new('picture'),
            TextEditorField::new('content'),
        ];
    }

    /**
     * @phpstan-ignore-next-line
     */
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
     if ($entityInstance instanceof Article) {
         $entityInstance->setUser($this->getUser()); /**@phpstan-ignore-line */
        parent::persistEntity($entityManager,$entityInstance);
     };
    }
}
