<?php
namespace Database;
use PDO;
use PDOException;
class Database{
    private static ?Database $instance=null;
    private PDO $pdo;
    public function __construct(){
       try{
       $this->pdo = new PDO(
    "mysql:host=localhost;dbname=game_cafe;charset=utf8",
    "root",
    ""
);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
       }catch(PDOException $e){
        die( "Erreur".$e->getMessage());

       }
    }
       public static  function getInstance() :Database{
        if(self::$instance === null){
            self::$instance=new Database();

        }
          return self::$instance;
       }
       public function getConnexion():PDO{
        return $this->pdo;
       }
    
}
?>