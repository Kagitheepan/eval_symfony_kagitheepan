<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Contrôleur pour la page des tarifs.
 */
final class PricingController extends AbstractController
{
    /**
     * Affiche la page des tarifs du service.
     */
    #[Route('/pricing', name: 'app_pricing')]
    public function index(): Response
    {
        return $this->render('pricing/index.html.twig', [
            'controller_name' => 'PricingController',
        ]);
    }
}
