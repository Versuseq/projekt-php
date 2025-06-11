<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class UserManagementController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN', message:'You have no access to this section')]
    #[Route('/usermanagement', name: 'user_management_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $userRepository = $entityManager->getRepository(User::class);
        $allUsers = $userRepository->findAll();
        return $this->render('user_management/index.html.twig', [
            'users' => $allUsers,
        ]);
    }
    #[IsGranted('ROLE_ADMIN', message:'You have no access to this section')]
    #[Route('/usermanagement/{id}/addrole/{role}', name: 'user_management_addrole')]
    public function addRole(EntityManagerInterface $entityManager, string $role, int $id):Response
    {
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->find($id);
        $userRole = 'ROLE_'.strtoupper($role);
        $user->addRole($userRole);
        $entityManager->flush();
        return $this->redirectToRoute('user_management_index');
    }
    #[Route('/usermanagement/{id}/deleterole/{role}', name: 'user_management_deleterole')]
    public function deleteRole(EntityManagerInterface $entityManager, string $role, int $id):Response
    {
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->find($id);
        $userRole = 'ROLE_'.strtoupper($role);
        $user->deleteRole($userRole);
        $entityManager->flush();
        return $this->redirectToRoute('user_management_index');
    }
}
