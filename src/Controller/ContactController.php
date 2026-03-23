<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Contrôleur pour la page de contact.
 */
final class ContactController extends AbstractController
{
    /**
     * Affiche et gère le formulaire de contact.
     * 
     * @param Request $request La requête HTTP.
     * @return Response La vue de la page de contact.
     */
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Ici, vous pourriez envoyer un email avec les données du formulaire
            $this->addFlash('success', 'Merci ! Votre message a bien été envoyé. Notre équipe vous répondra dans les plus brefs délais.');
            
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
