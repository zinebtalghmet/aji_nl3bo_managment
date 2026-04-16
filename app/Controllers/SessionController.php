<?php

namespace App\Controllers;

use App\Models\Session;
use App\Models\Reservation;
use App\Models\Game;
use App\Models\Table;

class SessionController
{
    // ---- ATTRIBUTS ----
    private Session     $sessionModel;
    private Reservation $reservationModel;
    private Game        $gameModel;
    private Table       $tableModel;

    // ---- CONSTRUCTEUR ----
    public function __construct()
    {
        $this->sessionModel     = new Session();
        $this->reservationModel = new Reservation();
        $this->gameModel        = new Game();
        $this->tableModel       = new Table();
    }

    // ---- GET /admin/sessions/create ----
    // Formulaire pour démarrer une session
    public function create(): void
    {
        $this->checkAdmin();

        // Récupérer les données pour les selects
        $reservations = $this->reservationModel->getConfirmed();
        $games        = $this->gameModel->getAvailable();
        $tables       = $this->tableModel->getFree();

        require_once __DIR__ . '/../Views/sessions/create.php';
    }

    // ---- POST /admin/sessions ----
    // Démarrer une session
    public function store(): void
    {
        $this->checkAdmin();

        $reservation_id = (int) ($_POST['reservation_id'] ?? 0);
        $game_id        = (int) ($_POST['game_id']        ?? 0);
        $table_id       = (int) ($_POST['table_id']       ?? 0);
        $errors         = [];

        // ---- VALIDATIONS ----
        if ($reservation_id === 0) $errors[] = "Réservation requise.";
        if ($game_id === 0)        $errors[] = "Jeu requis.";
        if ($table_id === 0)       $errors[] = "Table requise.";

        if (empty($errors)) {
            $this->sessionModel->start($reservation_id, $game_id, $table_id);
            header('Location: /aji_nl3bo_managment/admin/sessions');
            exit;
        }

        // Erreurs → repasser les selects à la vue
        $reservations = $this->reservationModel->getConfirmed();
        $games        = $this->gameModel->getAvailable();
        $tables       = $this->tableModel->getFree();

        require_once __DIR__ . '/../Views/sessions/create.php';
    }

    // ---- GET /admin/sessions ----
    // Dashboard sessions actives
    public function dashboard(): void
    {
        $this->checkAdmin();

        $sessions = $this->sessionModel->getActive();

        require_once __DIR__ . '/../Views/sessions/dashboard.php';
    }

    // ---- POST /admin/sessions/:id/end ----
    // Terminer une session
    public function end(int $id): void
    {
        $this->checkAdmin();

        $this->sessionModel->end($id);

        header('Location: /aji_nl3bo_managment/admin/sessions');
        exit;
    }

    // ---- GET /admin/sessions/history ----
    // Historique des sessions
    public function history(): void
    {
        $this->checkAdmin();

        $sessions = $this->sessionModel->getHistory();

        require_once __DIR__ . '/../Views/sessions/history.php';
    }

    // ---- PROTECTION ADMIN ----
    private function checkAdmin(): void
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /aji_nl3bo_managment/login');
            exit;
        }
    }
}