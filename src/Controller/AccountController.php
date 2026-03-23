<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Contrôleur pour la gestion du compte utilisateur (Dashboard utilisateur).
 */
final class AccountController extends AbstractController
{
    /**
     * Affiche la page du compte utilisateur.
     * Accessible uniquement aux utilisateurs connectés.
     */
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
