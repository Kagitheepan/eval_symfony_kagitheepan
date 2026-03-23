# Évaluation Symfony - Gestion de Produits

Ce projet est une application Symfony permettant la gestion d'un catalogue de produits avec des accès restreints.

## Fonctionnalités

- **Catalogue Public** : Consultation des produits via la route `/product`.
- **Gestion Admin** : Ajout, édition et suppression de produits réservés aux Administrateurs (`ROLE_ADMIN`).
- **Dashboard Admin** : accessible directement via un bouton sur la page produit pour les utilisateurs connectés en tant qu'admin.
- **Sécurité** : Firewall configuré pour protéger les routes `/admin` et `/account`.

## Installation

1. Cloner le projet.
2. Installer les dépendances :
   ```bash
   composer install
   ```
3. Configurer la base de données dans le fichier `.env` (`DATABASE_URL`).
4. Créer la base de données et les migrations :
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

## Utilisation

- Pour accéder aux fonctionnalités d'administration, connectez-vous avec un compte ayant le rôle `ROLE_ADMIN`.
- Les produits sont gérés dans le namespace `App\Controller\Admin`.
- La vue publique utilise `App\Controller\ProductController`.

## Structure des dossiers

- `src/Entity` : Contient l'entité `Product` et `User`.
- `src/Controller` : Contient les contrôleurs publics et d'administration.
- `src/Form` : Contient les types de formulaires (ex: `ProductType`).
- `templates/` : Contient les vues Twig, organisées par contrôleur.
