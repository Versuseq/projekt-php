<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Dish;
use App\Entity\Section;
use App\Form\CategoryType;
use App\Form\DishType;
use App\Form\SectionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class DishesController extends AbstractController
{
    #[Route('/dishes', name: 'dishes_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $repositiory = $em->getRepository(Dish::class);
        $dishes = $repositiory->findAll();
        return $this->render('dishes/index.html.twig', [
            'dishes' => $dishes,
        ]);
    }
    #[Route('/dish/add-dish', name: 'dishes_add_dish')]
    public function addDish(Request $request, EntityManagerInterface $em): Response
    {
        $dish = new Dish();
        $form = $this->createForm(DishType::class,$dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($dish);
            $em->flush();

            $this->addFlash('success',"Added dish    ".$dish->getEnUsName());
            return $this->redirectToRoute('dishes_index');
        }
        
        return $this->render('dishes/add.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/dish/add-section', name: 'dishes_add_section')]
    public function addSection(Request $request, EntityManagerInterface $em): Response
    {
        $section = new Section();
        $form = $this->createForm(SectionType::class,$section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($section);
            $em->flush();

            $this->addFlash('success',"Added ".$section->getEnUsName());
            return $this->redirectToRoute('dishes_index');
        }
        
        return $this->render('dishes/addSection.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/dish/add-category', name: 'dishes_add_category')]
    public function addCategory(Request $request, EntityManagerInterface $em): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            $this->addFlash('success',"Added Category".$category->getEnUsName());
            return $this->redirectToRoute('dishes_index');
        }
        
        return $this->render('dishes/addCategory.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/dish/{id}/edit', name: 'dishes_edit')]
    public function edit(Dish $dish, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(DishType::class,$dish);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($dish);
            $em->flush();

            $this->addFlash('info',"Edited ".$dish->getEnUsName());
            return $this->redirectToRoute('dishes_index');
        }
        return $this->render('dishes/edit.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/dish/{id}/delete', name: 'dishes_delete')]
    public function delete(Request $request, Dish $dish, EntityManagerInterface $em): Response
    {
        if($request->isMethod('POST')){
            $submittedToken = $request->request->get('_token');

            if ($this->isCsrfTokenValid('delete_dish' . $dish->getId(), $submittedToken)) {
                $em->remove($dish);
                $em->flush();

                $this->addFlash('info',"Deleted ".$dish->getEnUsName());

                return $this->redirectToRoute('dishes_index');
            }
        }
        return $this->render('dishes/delete.html.twig', [
                'dish' => $dish
            ]);
    }
}
