<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Form\CommentaryType;
use App\Repository\CommentaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commentary')]
class CommentaryController extends AbstractController
{

    #[Route('/new', name: 'commentary_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commentary = new Commentary();
        $form = $this->createForm(CommentaryType::class, $commentary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commentary);
            $entityManager->flush();

            return $this->redirectToRoute('commentary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commentary/new.html.twig', [
            'commentary' => $commentary,
            'form' => $form,
        ]);
    }


}
