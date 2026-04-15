<?php

namespace App\Models;

use PDO;

class User
{
    // ---- ATTRIBUTS ----
    private PDO    $db;
    private int    $id;
    private string $name;
    private string $email;
    private string $password;
    private string $role;
    private string $created_at;

    // ---- CONSTRUCTEUR ----
    public function __construct()
    {
        $this->db = \Database\Database::getInstance()->getConnexion();
    }

    // ---- GETTERS ----
    public function getId()        { return $this->id; }
    public function getName()      { return $this->name; }
    public function getEmail()     { return $this->email; }
    public function getPassword()  { return $this->password; }
    public function getRole()      { return $this->role; }
    public function getCreatedAt() { return $this->created_at; }

    // ---- HYDRATE ----
    private function hydrate(array $data): void
    {
        $this->id         = $data['id']         ?? 0;
        $this->name       = $data['name']       ?? '';
        $this->email      = $data['email']      ?? '';
        $this->password   = $data['password']   ?? '';
        $this->role       = $data['role']       ?? 'client';
        $this->created_at = $data['created_at'] ?? '';
    }

    // ---- REGISTER ----
    public function register(string $name, string $email, string $password): int|false
    {
        if ($this->findByEmail($email)) {
            return false;
        }

        $stmt = $this->db->prepare(
            'INSERT INTO users (name, email, password, role)
             VALUES (:name, :email, :password, "client")'
        );

        $stmt->execute([
            ':name'     => htmlspecialchars(trim($name)),
            ':email'    => strtolower(trim($email)),
            ':password' => password_hash($password, PASSWORD_BCRYPT),
        ]);

        return (int) $this->db->lastInsertId();
    }

    // ---- LOGIN ----
    public function login(string $email, string $password): array|null
    {
        $user = $this->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $this->hydrate($user);
            return $user;
        }

        return null;
    }

    // ---- FIND BY EMAIL ----
    public function findByEmail(string $email): array|false
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM users WHERE email = :email LIMIT 1'
        );
        $stmt->execute([':email' => strtolower(trim($email))]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) $this->hydrate($data);

        return $data;
    }

    // ---- FIND BY ID ----
    public function findById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM users WHERE id = :id LIMIT 1'
        );
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) $this->hydrate($data);

        return $data;
    }

    // ---- IS ADMIN ----
    public function isAdmin(int $id): bool
    {
        $user = $this->findById($id);
        return $user && $user['role'] === 'admin';
    }

    // ---- ADMIN : tous les users ----
    public function getAllUsers(): array
    {
        $stmt = $this->db->prepare(
            'SELECT id, name, email, role, created_at
             FROM users ORDER BY name ASC'
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ---- ADMIN : supprimer un user ----
    public function deleteUser(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    // ---- ADMIN : compter tous les users ----
    public function countAll(): int
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) AS total FROM users');
        $stmt->execute();
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}