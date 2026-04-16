<?php
namespace App\Models;

use PDO;
use Config\Database;

class Category {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllCategories() {
        $sql = 'SELECT * FROM categories ORDER BY name';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $sql = 'SELECT * FROM categories WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCategory($name) {
        $sql = 'INSERT INTO categories (name) VALUES (?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name]);
    }

    public function updateCategory($id, $name) {
        $sql = 'UPDATE categories SET name = ? WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $id]);
    }

    public function delete($id) {
        $sql = 'DELETE FROM categories WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }
}
