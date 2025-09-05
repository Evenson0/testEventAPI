# testEventAPI

Ce projet est une implémentation complète d’une application de gestion d’événements.

Il comprend :

- **Frontend (TypeScript/JS)** : une petite application utilisant `fetch` pour interroger l’API, un store global pour gérer les états de chargement/réussite/erreur, une fonction de `debounce`, et des tests unitaires en TypeScript.
- **CSS** : un composant « carte d’événement » responsive et respectueux du mode sombre avec un focus visible, sans utiliser `!important` ni `transition: all`.
- **Backend (Laravel/PHP)** : une API REST exposant des endpoints pour lister, afficher et créer des événements, optimiser les requêtes Eloquent pour éviter le problème N+1, mettre en cache les listes et sécuriser l’upload de bannières d’événement.
- **Blade** : des vues composables avec un layout principal et un composant dédié aux événements, incluant des directives d’autorisation (`@can`).

## Structure du dépôt

- `frontend/` : application TypeScript.
- `backend/` : application Laravel.
- `tests/` : tests unitaires pour le frontend (les tests backend sont placés dans `backend/tests`).

## Prérequis

- **Node.js** >= 16
- **PHP** >= 8.2
- **Composer**

## Installation

### Frontend

```bash
cd frontend
npm install
```

Pour lancer le projet en mode développement :

```bash
npm run dev
```

### Backend

```bash
cd backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```

L’API sera disponible sur `http://localhost:8000/api/events`.

### Tests

Tests frontend :

```bash
cd frontend
npm test
```

Tests backend :

```bash
cd backend
php artisan test
```

## Sécurité et bonnes pratiques

Le code applique un typage strict en TypeScript, des politiques d’autorisation dans Laravel et la protection CSRF dans les vues Blade. Les requêtes sont optimisées (cache, `withCount`) et l’upload de fichiers valide le type MIME et la taille.
