<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ErrorController extends AbstractController
{
    #[Route('/access-denied', name: 'app_error_denied')]
    public function index(): Response
    {
        return $this->render('error/denied.html.twig');
    }
}
