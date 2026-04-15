<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    // ---- ATTRIBUTS ----
    private User $userModel;

    // ---- CONSTRUCTEUR ----
    public function __construct()
    {
        $this->userModel = new User();
    }

    // ---- GET /splash ----
    public function splash(): void
    {
        require_once __DIR__ . '/../Views/auth/splash.php';
    }

    // ---- GET /login ----
    public function loginForm(): void
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirectByRole();
            return;
        }
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    // ---- POST /login ----
    public function login(): void
    {
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');
        $errors   = [];

        if (empty($email) || empty($password)) {
            $errors[] = "Email et mot de passe sont requis.";
        }

        if (empty($errors)) {
            $user = $this->userModel->login($email, $password);

            if (!$user) {
                $errors[] = "Email ou mot de passe incorrect.";
            } else {
                session_regenerate_id(true);
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];

                $this->redirectByRole();
                return;
            }
        }

        require_once __DIR__ . '/../Views/auth/login.php';
    }

    // ---- GET /register ----
    public function registerForm(): void
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirectByRole();
            return;
        }
        require_once __DIR__ . '/../Views/auth/register.php';
    }

    // ---- POST /register ----
    public function register(): void
    {
        $name     = trim($_POST['name']             ?? '');
        $email    = trim($_POST['email']            ?? '');
        $password = trim($_POST['password']         ?? '');
        $confirm  = trim($_POST['password_confirm'] ?? '');
        $errors   = [];

        // ---- VALIDATIONS ----
        if (empty($name)) {
            $errors[] = "Le nom est requis.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email invalide.";
        }
        if (strlen($password) < 6) {
            $errors[] = "Mot de passe minimum 6 caractères.";
        }
        if ($password !== $confirm) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        }

        // ---- INSERTION BDD ----
        if (empty($errors)) {
            $userId = $this->userModel->register($name, $email, $password);

            if ($userId === false) {
                $errors[] = "Cet email est déjà utilisé.";
            } else {
                session_regenerate_id(true);
                $_SESSION['user_id']   = $userId;
                $_SESSION['user_name'] = $name;
                $_SESSION['user_role'] = 'client';

                // CORRECTION : Redirection relative sans le slash "/" au début
                header('Location: dashboard/client');
                exit;
            }
        }

        require_once __DIR__ . '/../Views/auth/register.php';
    }

    // ---- GET /logout ----
    public function logout(): void
    {
        session_destroy();
        // CORRECTION : Vers la route splash sans "/"
        header('Location: splash');
        exit;
    }

    // ---- REDIRECT SELON ROLE ----
    private function redirectByRole(): void
    {
        // CORRECTION : Redirections relatives pour rester dans le projet
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            header('Location: dashboard/admin');
        } else {
            header('Location: dashboard/client');
        }
        exit;
    }

    // ---- DASHBOARDS (VUES TEMPORAIRES) ----
    public function adminDashboard() {
        echo "<h1>Bienvenue Admin : " . htmlspecialchars($_SESSION['user_name']) . "</h1>";
        echo "<a href='logout'>Déconnexion</a>";
    }

    public function clientDashboard() {
        echo "<h1>Bienvenue Client : " . htmlspecialchars($_SESSION['user_name']) . "</h1>";
        echo "<a href='logout'>Déconnexion</a>";
    }
}