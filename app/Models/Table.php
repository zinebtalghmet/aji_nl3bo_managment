<?php
namespace App\Models;

use Database\Database;
use PDO;

class Table
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnexion();
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM tables ORDER BY number";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFreeTables(): array
    {
        $query = "SELECT * FROM tables WHERE status = 'free' ORDER BY number";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $query = "SELECT * FROM tables WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStatus(int $id, string $status): bool
    {
        $query = "UPDATE tables SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$status, $id]);
    }
}