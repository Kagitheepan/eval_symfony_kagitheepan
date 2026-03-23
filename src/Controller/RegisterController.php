<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Contrôleur gérant l'inscription des nouveaux utilisateurs.
 */
final class RegisterController extends AbstractController
{
    /**
     * Affiche le formulaire d'inscription et traite la création de l'utilisateur.
     * 
     * @param Request $request La requête HTTP.
     * @param EntityManagerInterface $doctrine Le gestionnaire d'entités de Doctrine.
     * @param UserPasswordHasherInterface $passwordHasher Le service pour hasher les mots de passe.
     * @return Response La vue du formulaire d'inscription ou une redirection après succès.
     */
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hachage du mot de passe avant enregistrement
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);

            // Gestion du rôle selon la sélection
            $roleSelection = $form->get('role_selection')->getData();
            if ($roleSelection === 'seller') {
                $user->setRoles(['ROLE_ADMIN']);
            } else {
                $user->setRoles(['ROLE_USER']);
            }
            
            $doctrine->persist($user);
            $doctrine->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
