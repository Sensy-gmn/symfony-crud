<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;
use App\Form\CategoryType;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CategoryRepository;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(UserRepository $userRepo, CategoryRepository $catRepo): Response
    {
        if (!in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('app_home');
        }


        return $this->render('dashboard/index.html.twig', [
            'users' => $userRepo->findAll(),
            'categories' => $catRepo->findAll(),
        ]);
    }

    #[Route('/dashboard/new-category', name: 'app_new_category')]
    #[Route('/dashboard/edit-category/{category}', name: 'app_edit_category')]
    public function categoryForm(?Category $category, Request $request, EntityManagerInterface $entityManager): Response
    {
        $editMode = true;
        if (!$category) {
            $editMode = false;
            $category = new Category();
        }

        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {


            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard');
        }

        return $this->render('dashboard/category/form.html.twig', [
            'categoryForm' => $categoryForm,
            'editMode' => $editMode
        ]);
    }

    #[Route('/dashboard/delete-category/{category}', name: 'app_delete_category')]
    public function deleteCategory(?Category $category, EntityManagerInterface $entityManager): Response
    {
        if ($category) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard');
    }
}
