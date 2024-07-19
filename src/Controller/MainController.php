<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'session' => 'bst_31',
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        
        return $this->render('main/about.html.twig');
    }
}
