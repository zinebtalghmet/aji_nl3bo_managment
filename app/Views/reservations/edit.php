<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Réservation</title>
</head>
<body>
    <h1>Modifier la Réservation</h1>
    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="client_name"
               value="<?= htmlspecialchars($reservation['client_name']) ?>" required><br>

        <label>Téléphone :</label>
        <input type="text" name="client_phone"
               value="<?= htmlspecialchars($reservation['client_phone']) ?>" required><br>

        <label>Date et Heure :</label>
        <input type="datetime-local" name="reserved_at"
               value="<?= date('Y-m-d\TH:i', strtotime($reservation['reserved_at'])) ?>" required><br>

        <label>Statut :</label>
        <select name="status">
            <option value="pending" <?= $reservation['status'] === 'pending' ? 'selected' : '' ?>>En attente</option>
            <option value="confirmed" <?= $reservation['status'] === 'confirmed' ? 'selected' : '' ?>>Confirmée</option>
            <option value="cancelled" <?= $reservation['status'] === 'cancelled' ? 'selected' : '' ?>>Annulée</option>
        </select><br>

        <button type="submit">Mettre à jour</button>
    </form>
    <a href="/reservations">Retour</a>
</body>
</html>