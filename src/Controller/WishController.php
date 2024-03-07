<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use App\Service\Censurator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('/list', name: 'list')]
    public function list(WishRepository $wishRepository): Response
    {
        $wishes = $wishRepository->findLastWishes();

        return $this->render('wish/list.html.twig', [
            'wishes' => $wishes
        ]);
    }

    #[Route('/details/{id}', name: 'details')]
    public function details(Wish $wish): Response
    {
        return $this->render('wish/details.html.twig', [
            'wish' => $wish
        ]);
    }

    #[Route('/add', name: 'add')]
    #[IsGranted('ROLE_USER')]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        Censurator $censurator
    ) : Response
    {
        $wish = new Wish();
        $wish->setAuthor($this->getUser()->getUserIdentifier());
        $form = $this->createForm(WishType::class, $wish);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $wish->setTitle($censurator->purify($wish->getTitle()));

            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success', 'Votre souhait est bien créé!');

            return $this->redirectToRoute('wish_details', ['id' => $wish->getid()]);
        }
        return $this->render('wish/add.html.twig', [
            'formWish' => $form
        ]);
    }
}
