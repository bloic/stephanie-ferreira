<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Commentary;
use App\Entity\Testimony;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    #[route('/admin', name: 'admin_home')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bienvenue Stephanie Ferreira');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Article', 'fa fa-newspaper', Article::class);
        yield MenuItem::linkToCrud('commentaire', 'fa fa-comment', Commentary::class);
        yield MenuItem::linkToCrud('témoignage', 'fa fa-comment-dots', Testimony::class);
    }
}
