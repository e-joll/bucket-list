<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home()
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/about-us', name: 'main_about_us')]
    public function about_us()
    {
        $team = file_get_contents('../data/team.json');
        $authors = json_decode($team);
        return $this->render('main/about_us.html.twig', [
            'authors' => $authors
        ]);
    }
}