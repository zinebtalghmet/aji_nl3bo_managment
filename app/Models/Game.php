<?php
namespace App\Models;

use PDO;

class Game{
    private $conn;
private $id;
private $name;
private $category_id;
private $duration;
private $description;
private $difficulty;
private $status;

public function __construct(){
    $this->conn = \Database\Database::getInstance()->getConnexion();
}

public function getId(){
    return $this->id;
}

public function getName(){
    return $this->name;
}

public function getCategoryId(){
    return $this->category_id;
}

public function getDuration(){
    return $this->duration;
}
public function getDescription(){
    return $this->description;
}

public function getDifficulty() {
        return $this->difficulty;
}

public function getStatus() {
        return $this->status;
}


public function getAllGames(){
    $sql='SELECT games.*, categories.name AS category
    FROM games
    LEFT JOIN categories ON games.category_id = categories.id
    ORDER BY games.id DESC';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getGamesByUser($user_id){
    $sql='SELECT games.*, categories.name AS category
    FROM games
    LEFT JOIN categories ON games.category_id = categories.id
    WHERE games.user_id = ?
    ORDER BY games.id DESC';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getGameById($id){
    $sql ='SELECT games.*,categories.name AS category
    FROM games
    LEFT JOIN categories ON games.category_id=categories.id
    WHERE games.id = ?';

    $stmt=$this->conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function createGame($name,$category_id, $duration,$description,$difficulty,$status,$user_id){
$sql = 'INSERT INTO games(name,category_id,duration,description,difficulty,status,user_id)
VALUES (?,?,?,?,?,?,?)';
$stmt=$this->conn->prepare($sql);
$stmt->execute([$name,$category_id, $duration,$description,$difficulty,$status,$user_id]);

}

public function updateGame($id,$name,$category_id, $duration,$description,$difficulty,$status){
    $sql='UPDATE games SET name =?,category_id=?,duration=?,description=?,difficulty=?,status=?
    WHERE games.id = ?';
$stmt = $this->conn->prepare($sql);
$stmt->execute([$name,$category_id, $duration,$description,$difficulty,$status,$id]);
}

public function delete($id){
    $sql ='DELETE FROM games WHERE id =?';
    $stmt=$this->conn->prepare($sql);
    $stmt->execute([$id]);
}
}


?>