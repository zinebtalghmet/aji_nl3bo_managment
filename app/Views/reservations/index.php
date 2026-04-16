<?php include __DIR__ . '/../includes/header.php'; ?>

<h1>📅 Liste des Réservations</h1>

<?php if (isset($_SESSION['user_id'])) : ?>
    <p>
        <a href="<?= BASE_URL ?>/reservations/create" class="btn">
            ➕ Nouvelle réservation
        </a>
    </p>
<?php endif; ?>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Téléphone</th>
            <th>Table</th>
            <th>Date</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($reservations)) : ?>
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
                        <a href="<?= BASE_URL ?>/reservations/edit/<?= $reservation['id'] ?>">✏️ Modifier</a>
                        |
                        <a href="<?= BASE_URL ?>/reservations/delete/<?= $reservation['id'] ?>"
                           onclick="return confirm('Annuler cette réservation ?')">
                           🗑️ Annuler
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="7" style="text-align:center;">Aucune réservation trouvée.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>