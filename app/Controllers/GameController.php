<?php
namespace App\Controllers;
use App\Models\Game;

class GameController{
    private $gameModel ;

    public function __construct(){
        $this->gameModel = new Game();
    }

    public function index(){
        $games =$this->gameModel->getAllGames();
        require __DIR__ . '/../Views/games/index.php';
    }

    public function create(){
        require __DIR__ . '/../Views/games/create.php';
    }

    public function store(){
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $duration = $_POST['duration'];
        $difficulty = $_POST['difficulty'];
        $status = $_POST['status'];

        $this->gameModel->createGame($name, $category_id,$duration,$difficulty,$status);
        header('Location: /games');
        exit;
    }

    public function show($id){
        $game=$this->gameModel->getGameById($id);
        require __DIR__ . '/../Views/games/show.php';
    }
}



?>