<?php

namespace App\Controller;

use App\Entity\Section;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MenuController extends AbstractController
{
    #[Route('/menu', name: 'menu')]
    public function index(EntityManagerInterface $em): Response
    {
        $rep = $em->getRepository(Section::class);
        $sections = $rep->findAllSorted();
        return $this->render('menu/index.html.twig', [
            'sections' => $sections
        ]);
    }
}
    