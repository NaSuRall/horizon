# 🏍️ Horizon Moto - Dashboard & Site

Bienvenue sur le projet **Horizon Moto**, une application Laravel avec un **dashboard administrateur** et un **site vitrine**.  
Ce projet permet de gérer les produits, catégories, marques, membres et actualités du magasin, avec une interface moderne en **Tailwind CSS**.

---

## 🚀 Fonctionnalités principales

- **Site vitrine**
    - Page d’accueil avec les derniers produits
    - Page Actualités avec affichage en cartes + modal "Plus d’infos"
    - Pages Contact & Présentation
    - Modal automatique sur l’accueil avec la dernière actualité

- **Dashboard (admin)**
    - Gestion des **produits** (CRUD complet)
    - Gestion des **catégories** et **marques**
    - Gestion des **membres**
    - Gestion des **actualités** (CRUD avec limite de 500 caractères pour la description)
    - Système d’authentification sécurisé (login, middleware `is_admin`)

---

## 🛠️ Stack technique

- **Backend** : [Laravel 12](https://laravel.com/) (PHP 8.2+)
- **Frontend** : [Tailwind CSS](https://tailwindcss.com/) + Blade
- **Base de données** : MySQL / MariaDB
- **Authentification** : Laravel Breeze / Auth routes
- **Gestion des rôles** : Middleware `is_admin`

---

## 📦 Installation

1. **Cloner le projet**
   ```bash
   git clone https://github.com/ton-compte/horizon-moto.git
   cd horizon-moto
