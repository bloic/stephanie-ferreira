<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentary;
use App\Form\CommentaryType;
use App\Repository\ArticleRepository;
use App\Repository\CommentaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/blog')]
class BlogController extends AbstractController
{
    #[Route('/', name: 'blog')]
    public function index(ArticleRepository $articles): Response
    {
        return $this->render('blog/index.html.twig', [
            'articles' => $articles->findBy([], ['date' => 'DESC'])
        ]);
    }


    #[Route('/{id}', name: 'detailPost', methods: ['GET', 'POST'])]
    public function detailPost(
        ArticleRepository      $article,
        Request                $request,
        CommentaryRepository   $commentaryRepository,
        EntityManagerInterface $entityManager,
        Article                $id
    ): Response {
        $commentaries = new Commentary();
        $form = $this->createForm(CommentaryType::class, $commentaries);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commentaries->setArticle($id);
            $entityManager->persist($commentaries);
            $entityManager->flush();
        }

        return $this->render('blog/detailPost.html.twig', [
            'article' => $article->findOneBy(['id' => $id]),
            'commentaries' => $commentaryRepository->findBy(['article' => $id], ['createAt'=>'DESC']),
            'form' => $form->createView(),
        ]);
    }
}
