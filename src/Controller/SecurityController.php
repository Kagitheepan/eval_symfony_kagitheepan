<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Contrôleur gérant l'authentification des utilisateurs (Connexion / Déconnexion).
 */
class SecurityController extends AbstractController
{
    /**
     * Affiche le formulaire de connexion et gère les erreurs d'authentification.
     * 
     * @param AuthenticationUtils $authenticationUtils Utilitaires pour récupérer le dernier nom d'utilisateur et l'erreur.
     * @return Response La vue du formulaire de connexion.
     */
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         // Si l'utilisateur est déjà connecté, on le redirige vers son compte
         if ($this->getUser()) {
             return $this->redirectToRoute('app_account');
         }

        // Récupère l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // Dernier nom d'utilisateur saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * Gère la déconnexion.
     * Cette méthode peut rester vide - elle sera interceptée par la clé logout du firewall dans security.yaml.
     */
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('Cette méthode peut rester vide - elle sera interceptée par la clé logout du firewall.');
    }
}