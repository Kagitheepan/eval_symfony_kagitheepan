<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Contrôleur pour la page d'accueil de l'application.
 * Présente les fonctionnalités principales aux utilisateurs.
 */
final class AccueilController extends AbstractController
{
    /**
     * Affiche la landing page (page de présentation) de l'application.
     */
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
