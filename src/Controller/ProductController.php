<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * Contrôleur pour l'affichage public des produits.
 */
final class ProductController extends AbstractController
{
    /**
     * Affiche la liste de tous les produits.
     * Accessible par tous les utilisateurs. Supporte la recherche par nom via le paramètre 'q'.
     * 
     * @param Request $request La requête HTTP.
     * @param ProductRepository $productRepository Le repository pour accéder aux données des produits.
     * @return Response La vue rendu avec la liste des produits (filtrée ou non).
     */
    #[Route('/product', name: 'app_product')]
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        $query = $request->query->get('q', '');
        
        if (!empty($query)) {
            $products = $productRepository->findBySearchQuery($query);
        } else {
            $products = $productRepository->findAll();
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'searchTerm' => $query,
        ]);
    }
}
