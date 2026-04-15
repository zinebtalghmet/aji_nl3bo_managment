<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une Réservation</title>
</head>
<body>
    <h1>Nouvelle Réservation</h1>

    <form method="POST">
        <label>Nom du client :</label>
        <input type="text" name="client_name" required><br><br>

        <label>Téléphone :</label>
        <input type="text" name="client_phone" required><br><br>

        <label>Nombre de personnes :</label>
        <input type="number" name="number_of_people" min="1" required><br><br>

        <label>Table :</label>
        <select name="table_id" required>
            <option value="">-- Sélectionner une table --</option>
            <?php foreach ($tables as $table): ?>
                <option value="<?= $table['id']; ?>">
                    Table <?= htmlspecialchars($table['number']); ?> 
                    (Capacité: <?= htmlspecialchars($table['capacity']); ?>)
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Date et Heure :</label>
        <input type="datetime-local" name="reserved_at" required><br><br>

        <button type="submit">Réserver</button>
    </form>

    <a href="/reservations">Retour</a>
</body>
</html>