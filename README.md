# 🎮 GameCafé Manager

Application web développée pour digitaliser la gestion du café de jeux **Aji L3bo Café**.

---

## 🎯 Contexte

Actuellement, la gestion du café est manuelle :

* réservations sur papier 📄
* inventaire dans un cahier 📘
* suivi des sessions chaotique ❌

👉 Cette application permet de :

* gérer les jeux 🎲
* gérer les réservations 📅
* suivre les sessions en temps réel 🕹️

---

## 👨‍💻 Équipe

Projet réalisé en trinôme :

* Dev 1 : [Zineb]
* Dev 2 : [Khadija]
* Dev 3 : [Hassan]

---

## 🛠️ Technologies

* PHP (MVC)
* MySQL
* HTML / CSS / JavaScript
* Composer (PSR-4 Autoload)

---

## 🏗️ Architecture

Le projet respecte :

* ✅ MVC (Model - View - Controller)
* ✅ Router personnalisé
* ✅ Namespaces PSR-4
* ✅ Autoloading avec Composer
* ✅ Zéro `require_once`

---

## 📁 Structure du projet

```id="t5j3k2"
/AJI_NL3BO_MANAGEMENT

/app
 ├── Controllers
 ├── Models
 ├── Views
 └── Router.php

/config
 └── Database.php

/public
 └── css/style.css

index.php
.htaccess
composer.json
README.md
```

---

## 🧠 Fonctionnement technique

### 🔁 Router

* Toutes les requêtes passent par `index.php`
* Le Router analyse l’URL et appelle le bon Controller

Exemple :

```id="p2k9d1"
GET /games → GameController::index()
GET /games/5 → GameController::show()
```

---

### 📦 Namespaces (PSR-4)

```id="x7k21m"
namespace App\Controllers;
namespace App\Models;
```

👉 Chargement automatique via Composer

---

### 🔗 Base de données

* Utilisation de PDO
* Prepared Statements (sécurité)
* Relations avec Foreign Keys

---

## 🚀 Installation

### 1. Cloner le projet

```bash id="v3k8d2"
git clone https://github.com/zinebtalghmet/AJI_NL3BO_MANAGEMENT.git
cd AJI_NL3BO_MANAGEMENT
```

---

### 2. Installer Composer

```bash id="c8d3k1"
composer install
composer dump-autoload
```

---

### 3. Configurer la base de données

* Importer le fichier SQL fourni
* Configurer `config/Database.php`







## ▶️ Utilisation

### 👤 Client

* Voir les jeux
* Filtrer par catégorie
* Faire une réservation
* Consulter ses réservations

### 👨‍💼 Admin

* Gérer les jeux
* Gérer les catégories
* Gérer les réservations
* Démarrer / terminer des sessions
* Voir dashboard temps réel

---

## 🔗 Routes principales

### 🎲 Jeux

| Méthode | Route         | Action         |
| ------- | ------------- | -------------- |
| GET     | /games        | Liste des jeux |
| GET     | /games/{id}   | Détail jeu     |
| POST    | /games        | Ajouter jeu    |
| POST    | /games/update | Modifier       |
| POST    | /games/delete | Supprimer      |

---

### 📅 Réservations

| Méthode | Route                | Action            |
| ------- | -------------------- | ----------------- |
| GET     | /reservations/create | Formulaire        |
| POST    | /reservations        | Créer             |
| GET     | /reservations        | Historique client |
| GET     | /admin/reservations  | Vue admin         |

---

### 🕹️ Sessions

| Méthode | Route               | Action     |
| ------- | ------------------- | ---------- |
| POST    | /sessions/start     | Démarrer   |
| GET     | /sessions/dashboard | Dashboard  |
| POST    | /sessions/end       | Terminer   |
| GET     | /sessions/history   | Historique |

---

## 📊 Modules implémentés

### 🎲 Catalogue de Jeux

* Liste des jeux (US1)
* Détails (US2)
* CRUD admin (US3)
* Filtrage (US4)

---

### 📅 Réservations

* Vérification disponibilité (US5)
* Création (US6)
* Historique (US7)
* Gestion admin (US8)

---

### 🕹️ Sessions

* Démarrage (US9)
* Dashboard temps réel (US10)
* Fin session (US11)
* Historique (US12)

---

## 🔐 Sécurité

* ✅ Prepared Statements (PDO)
* ✅ Validation des formulaires
* ✅ Gestion erreurs (404, validation)

---

## 🤝 Collaboration

* Travail en trinôme
* Jira utilisé pour le suivi
* Daily standups
* Pull Requests avec code review

---



## 📝 Exemples de commits

* Add Game CRUD routes
* Implement Reservation validation
* Fix namespace issue in SessionController

---

## 📄 Contraintes respectées

* ✅ Router obligatoire
* ✅ PSR-4 Namespaces
* ✅ Composer autoload
* ✅ MVC strict

---

