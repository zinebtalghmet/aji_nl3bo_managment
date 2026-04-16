<?php

namespace App\Models;

use PDO;

class Session
{
    // ---- ATTRIBUTS ----
    private PDO    $db;
    private int    $id;
    private int    $reservation_id;
    private int    $game_id;
    private int    $table_id;
    private string $start_time;
    private ?string $end_time;
    private string $status;

    // ---- CONSTRUCTEUR ----
    public function __construct()
    {
        $this->db = \Database\Database::getInstance()->getConnexion();
    }

    // ---- GETTERS ----
    public function getId()            { return $this->id; }
    public function getReservationId() { return $this->reservation_id; }
    public function getGameId()        { return $this->game_id; }
    public function getTableId()       { return $this->table_id; }
    public function getStartTime()     { return $this->start_time; }
    public function getEndTime()       { return $this->end_time; }
    public function getStatus()        { return $this->status; }

    // ---- HYDRATE ----
    private function hydrate(array $data): void
    {
        $this->id             = $data['id']             ?? 0;
        $this->reservation_id = $data['reservation_id'] ?? 0;
        $this->game_id        = $data['game_id']        ?? 0;
        $this->table_id       = $data['table_id']       ?? 0;
        $this->start_time     = $data['start_time']     ?? '';
        $this->end_time       = $data['end_time']       ?? null;
        $this->status         = $data['status']         ?? 'active';
    }

    // ---- START SESSION ----
    public function start(int $reservation_id, int $game_id, int $table_id): int
    {
        // 1. Créer la session
        $stmt = $this->db->prepare(
            'INSERT INTO sessions (reservation_id, game_id, table_id, start_time, status)
             VALUES (:reservation_id, :game_id, :table_id, NOW(), "active")'
        );
        $stmt->execute([
            ':reservation_id' => $reservation_id,
            ':game_id'        => $game_id,
            ':table_id'       => $table_id,
        ]);

        $sessionId = (int) $this->db->lastInsertId();

        // 2. Marquer le jeu comme "en_cours"
        $this->db->prepare(
            'UPDATE games SET status = "en_cours" WHERE id = :id'
        )->execute([':id' => $game_id]);

        // 3. Marquer la table comme "occupied"
        $this->db->prepare(
            'UPDATE tables SET status = "occupied" WHERE id = :id'
        )->execute([':id' => $table_id]);

        // 4. Confirmer la réservation
        $this->db->prepare(
            'UPDATE reservations SET status = "confirmed" WHERE id = :id'
        )->execute([':id' => $reservation_id]);

        return $sessionId;
    }

    // ---- GET SESSIONS ACTIVES (avec JOIN) ----
    public function getActive(): array
    {
        $stmt = $this->db->prepare(
            'SELECT 
                s.id,
                s.start_time,
                s.status,
                g.name      AS game_name,
                g.id        AS game_id,
                t.number    AS table_number,
                t.id        AS table_id,
                r.client_name,
                r.client_phone,
                r.number_of_people,
                TIMESTAMPDIFF(MINUTE, s.start_time, NOW()) AS elapsed_minutes
             FROM sessions s
             JOIN games        g ON s.game_id        = g.id
             JOIN tables       t ON s.table_id       = t.id
             JOIN reservations r ON s.reservation_id = r.id
             WHERE s.status = "active"
             ORDER BY s.start_time ASC'
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ---- END SESSION ----
    public function end(int $id): bool
    {
        // Récupérer game_id et table_id avant de terminer
        $stmt = $this->db->prepare(
            'SELECT game_id, table_id FROM sessions WHERE id = :id'
        );
        $stmt->execute([':id' => $id]);
        $session = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$session) return false;

        // 1. Terminer la session
        $this->db->prepare(
            'UPDATE sessions 
             SET end_time = NOW(), status = "terminée" 
             WHERE id = :id'
        )->execute([':id' => $id]);

        // 2. Libérer le jeu
        $this->db->prepare(
            'UPDATE games SET status = "disponible" WHERE id = :id'
        )->execute([':id' => $session['game_id']]);

        // 3. Libérer la table
        $this->db->prepare(
            'UPDATE tables SET status = "free" WHERE id = :id'
        )->execute([':id' => $session['table_id']]);

        return true;
    }

    // ---- GET HISTORY ----
    public function getHistory(): array
    {
        $stmt = $this->db->prepare(
            'SELECT 
                s.id,
                s.start_time,
                s.end_time,
                s.status,
                g.name   AS game_name,
                t.number AS table_number,
                r.client_name,
                r.client_phone,
                r.number_of_people,
                TIMESTAMPDIFF(MINUTE, s.start_time, s.end_time) AS duration_minutes
             FROM sessions s
             JOIN games        g ON s.game_id        = g.id
             JOIN tables       t ON s.table_id       = t.id
             JOIN reservations r ON s.reservation_id = r.id
             WHERE s.status = "terminée"
             ORDER BY s.end_time DESC'
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ---- COMPTER SESSIONS ACTIVES ----
    public function countActive(): int
    {
        $stmt = $this->db->prepare(
            'SELECT COUNT(*) AS total FROM sessions WHERE status = "active"'
        );
        $stmt->execute();
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}