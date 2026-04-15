<?php
namespace App\Models;

use Database\Database;
use PDO;

class Reservation
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnexion();
    }

    public function create(array $data): bool
    {
        $query = "INSERT INTO reservation 
                  (user_id, table_id, client_name, client_phone, reserved_at, status, created_at)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            $data['user_id'],
            $data['table_id'],
            $data['client_name'],
            $data['client_phone'],
            $data['reserved_at'],
            $data['status'],
            $data['created_at'] ?? date('Y-m-d H:i:s')
        ]);
    }

    public function getByUserId(int $user_id): array
    {
        $query = "SELECT * FROM reservation WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $query = "SELECT * FROM reservation WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(int $id, array $data): bool
    {
        $query = "UPDATE reservation 
                  SET client_name = ?, client_phone = ?, reserved_at = ?, status = ?
                  WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            $data['client_name'],
            $data['client_phone'],
            $data['reserved_at'],
            $data['status'],
            $id
        ]);
    }

    public function delete(int $id): bool
    {
        $query = "DELETE FROM reservation WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

   public function getAll(): array
{
    $query = "SELECT r.*, t.number AS table_number, t.capacity
              FROM reservation r
              JOIN tables t ON r.table_id = t.id
              ORDER BY r.reserved_at DESC";

    return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
}
}
?>