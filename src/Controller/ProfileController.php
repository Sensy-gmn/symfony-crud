<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Recipe;
use App\Form\RecipeType;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig');
    }

    #[Route('/profile/new-recipe', name: 'app_new_recipe')]
    public function RecipeForm(): Response
    {
        $recipe = new Recipe();
        $recipeForm = $this->createForm(RecipeType::class, $recipe);

        return $this->render('profile/form.html.twig', [
            'recipeForm' => $recipeForm
        ]);
    }
}
