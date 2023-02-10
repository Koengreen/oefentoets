<?php

namespace App\Controller;

use App\Entity\Bestelregel;
use App\Entity\Category;
use App\Entity\Klant;
use App\Entity\Pizza;
use App\Entity\Besteling;
use App\Form\CategoryType;
use App\Repository\BestelingRepository;
use App\Repository\BestelregelRepository;
use App\Repository\CategoryRepository;
use App\Repository\KlantRepository;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    #[Route('/', name: 'blog_list')]
    public function show(BestelingRepository $bestelingRepository, BestelregelRepository $bestelregel, PizzaRepository $pizzaRepository, KlantRepository $klantRepository)
    {


        $klanten = $klantRepository->findAll();
        $aantalbestellingen = $bestelregel->findAll();
        $evt = $bestelingRepository->findAll();
        $pizza = $pizzaRepository->findAll();
        return $this->render('pizza/index.html.twig', [
            'evt' => $evt, 'bestelregel ' => $aantalbestellingen, 'pizza' => $pizza, 'klant' => $klanten
        ]);
    }

    #[Route('/menu', name: 'menu')]
    public function menu(CategoryRepository $categoryRepository, PizzaRepository $pizzaRepository)
    {
        $categories = $categoryRepository->findAll();
        $pizzas = $pizzaRepository->findAll();
        return $this->render('pizza/menu.html.twig',[
            'pizza' => $pizzas,  'categorie' => $categories


        ]);

    }
    #[Route('/add/category', name: 'app_pizza_addcategory')]
    public function addcategory(CategoryRepository $categoryRepository, PizzaRepository $pizzaRepository, Request $request, EntityManagerInterface $entityManager)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('menu');
        }
        return $this->render('pizza/addcategoryform.html.twig', [
            'form' => $form->createView()
        ]);
    }




}

