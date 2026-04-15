<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Réservations</title>
</head>
<body>
    <h1>Liste des Réservations</h1>
    <a href="/reservations/create">Nouvelle réservation</a>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Téléphone</th>
            <th>Table</th>
            <th>Date</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($reservations as $reservation): ?>
            <tr>
                <td><?= htmlspecialchars($reservation['id']) ?></td>
                <td><?= htmlspecialchars($reservation['client_name']) ?></td>
                <td><?= htmlspecialchars($reservation['client_phone']) ?></td>
                <td>
                    Table <?= htmlspecialchars($reservation['table_number']); ?>
                    (<?= htmlspecialchars($reservation['capacity']); ?> pers.)
                </td>
                <td><?= htmlspecialchars($reservation['reserved_at']) ?></td>
                <td><?= htmlspecialchars($reservation['status']) ?></td>
                <td>
                    <a href="/reservations/edit/<?= $reservation['id'] ?>">Modifier</a>
                    <a href="/reservations/cancel/<?= $reservation['id'] ?>"
                       onclick="return confirm('Annuler cette réservation ?')">
                       Annuler
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>