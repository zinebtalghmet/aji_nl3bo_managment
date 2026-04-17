<?php

namespace App\Models;

use PDO;

class Session
{
    private PDO $db;

    public function __construct()
    {
        $this->db = \Database\Database::getInstance()->getConnexion();
    }

    // ---- START SESSION ----
    public function start(int $user_id, int $game_id, int $table_id): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO sessions (user_id, game_id, table_id, start_time, status)
             VALUES (:user_id, :game_id, :table_id, NOW(), "active")'
        );
        $stmt->execute([
            ':user_id'  => $user_id,
            ':game_id'  => $game_id,
            ':table_id' => $table_id,
        ]);

        $sessionId = (int) $this->db->lastInsertId();

        // Marquer le jeu comme "en_cours"
        $this->db->prepare(
            'UPDATE games SET status = "en_cours" WHERE id = :id'
        )->execute([':id' => $game_id]);

        // Marquer la table comme "occupied"
        $this->db->prepare(
            'UPDATE tables SET status = "occupied" WHERE id = :id'
        )->execute([':id' => $table_id]);

        return $sessionId;
    }

    // ---- GET SESSIONS ACTIVES ----
    public function getActive(): array
    {
        $stmt = $this->db->prepare(
            'SELECT
                s.id,
                s.start_time,
                s.status,
                g.name      AS game_name,
                g.id        AS game_id,
                g.duration  AS duration,
                t.id        AS table_number,
                u.name      AS client_name,
                TIMESTAMPDIFF(MINUTE, s.start_time, NOW()) AS elapsed_minutes
             FROM sessions s
             JOIN games g ON s.game_id = g.id
             JOIN tables t ON s.table_id = t.id
             JOIN users  u ON s.user_id = u.id
             WHERE s.status = "active"
             ORDER BY s.start_time ASC'
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ---- END SESSION ----
    public function end(int $id): bool
    {
        $stmt = $this->db->prepare(
            'SELECT game_id, table_id FROM sessions WHERE id = :id'
        );
        $stmt->execute([':id' => $id]);
        $session = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$session) return false;

        $this->db->prepare(
            'UPDATE sessions SET end_time = NOW(), status = "terminee" WHERE id = :id'
        )->execute([':id' => $id]);

        $this->db->prepare(
            'UPDATE games SET status = "disponible" WHERE id = :id'
        )->execute([':id' => $session['game_id']]);

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
                t.id     AS table_number,
                u.name   AS client_name,
                TIMESTAMPDIFF(MINUTE, s.start_time, s.end_time) AS duration_minutes
             FROM sessions s
             JOIN games g ON s.game_id = g.id
             JOIN tables t ON s.table_id = t.id
             JOIN users  u ON s.user_id = u.id
             WHERE s.status = "terminee"
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
