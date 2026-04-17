<?php
namespace App\Controllers;

use App\Models\Game;
use App\Models\Category;
use App\Models\Reservation;

class ClientController {
    private $gameModel;
    private $categoryModel;
    private $reservationModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $this->gameModel        = new Game();
        $this->categoryModel    = new Category();
        $this->reservationModel = new Reservation();
    }

    public function index() {
        $this->client();
    }

    public function client() {
        // ---- Jeux ----
        $games      = $this->gameModel->getAllGames();
        $categories = $this->categoryModel->getAllCategories();

        // ---- Stats réservations du client connecté ----
        $allReservations   = $this->reservationModel->getByUserId($_SESSION['user_id']);
        $totalReservations = count($allReservations);
        $confirmedCount    = count(array_filter($allReservations, fn($r) => $r['status'] === 'confirmed'));
        $pendingCount      = count(array_filter($allReservations, fn($r) => $r['status'] === 'pending'));
        $cancelledCount    = count(array_filter($allReservations, fn($r) => $r['status'] === 'cancelled'));

        require __DIR__ . '/../Views/dashboard/client.php';
    }
}