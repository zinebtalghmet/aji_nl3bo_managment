<?php
namespace App\Controllers;

use App\Models\Game;
use App\Models\Category;

class ClientController {
    private $gameModel;
    private $categoryModel;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $this->gameModel = new Game();
        $this->categoryModel = new Category();
    }

    public function index() {
        $games = $this->gameModel->getAllGames();
        $categories = $this->categoryModel->getAllCategories();
        require __DIR__ . '/../Views/dashboard/client.php';
    }

    public function client() {
        $games = $this->gameModel->getAllGames();
        $categories = $this->categoryModel->getAllCategories();
        require __DIR__ . '/../Views/dashboard/client.php';
    }
}
