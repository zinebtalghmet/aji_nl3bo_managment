<?php
namespace App\Controllers;
use App\Models\Game;
use App\Models\Category;
class GameController{
    private $gameModel ;
    private $categoryModel;  

    public function __construct(){
        $this->gameModel = new Game();
        $this->categoryModel = new Category();
    }

    public function index(){
        $games =$this->gameModel->getAllGames();
        require __DIR__ . '/../Views/games/index.php';

    }

    public function create(){
        $categories = $this->categoryModel->getAllCategories();
        require __DIR__ . '/../Views/games/create.php';
    }

    public function store(){
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $duration = $_POST['duration'];
        $description = $_POST['description'];
        $difficulty = $_POST['difficulty'];
        $status = $_POST['status'];

        $this->gameModel->createGame($name, $category_id,$duration,$description,$difficulty,$status);
        header('Location: ' . BASE_URL . '/games');
        exit;
    }

    public function show($id){
        $game=$this->gameModel->getGameById($id);
        require __DIR__ . '/../Views/games/show.php';
    }

    public function edit($id){
       $game=$this->gameModel->getGameById($id);
       $categories=$this->categoryModel->getAllCategories();
        require __DIR__ . '/../Views/games/edit.php';

    }

    public function update($id){
        $name=$_POST['name'];
        $category_id=$_POST['category_id'];
        $duration=$_POST['duration'];
        $description=$_POST['description'];
        $difficulty = $_POST['difficulty'];
        $status=$_POST['status'];

        $this->gameModel->updateGame($id,$name,$category_id,$duration,$description,$difficulty,$status);
        header('Location: ' . BASE_URL . '/games');
        exit;
    }

    public function destroy($id){
        $this->gameModel->delete($id);
        header('Location: ' . BASE_URL . '/games');
        exit;
    }


}



?>