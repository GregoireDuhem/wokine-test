# Wokine Test — WordPress Theme

WordPress theme with a custom build setup and front-end tooling.

## Setup

- WordPress backend (PHP) and front-end (JS/CSS) discovery and structure
- **Vite** for building: compiles PHP/HTML templates and front-end assets (JS, CSS)

## Features

- **Responsive** — Mobile-friendly layout
- **Animations** — GSAP-based animations
- **Custom products** — PHP custom post type for managing products in the WP admin

## Process

1. **WordPress setup** — Installed WordPress and explored the file/system structure: backend (PHP, templates, admin) vs front-end (JS, CSS, assets).
2. **Build pipeline** — Discovering that the front (JS, CSS) runs and builds on the PHP (HTML). Integrated Vite to handle that build from a single workflow.
3. **Architecture** - Creating php file based on different sections.
4. **Responsive** — Made the theme mobile-responsive across breakpoints.
5. **Animations** — Added GSAP for scroll and interaction animations.
6. **Products** — Registered a custom post type in PHP so products can be created and managed in the WP admin.
7. **Git** - Understanding what files to push on github

## Contenu WordPress (BDD)

- Fichier d’export contenu : `bdd-produits-wokine.xml`
- Pour l’importer : WP admin > Outils > Importer > WordPress > envoyer ce fichier.

## Front-end (Vite)

- Dans le dossier du thème : `cd wp-content/themes/wokine-test/frontend`
- Installer les dépendances : `npm install`
- Lancer le front en dev (Vite) : `npm run dev`
