<?php include __DIR__ . '/../includes/header.php'; ?>

<main>
<div class="dashboard-container">

<h1>📅 Mes Réservations</h1>

<?php if (!empty($reservations)) : ?>

<table class="data-table">
    <thead>
        <tr>
            <th>Table</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($reservations as $r): ?>
        <tr>
            <td>Table <?= $r['table_id'] ?></td>
            <td><?= $r['reserved_at'] ?></td>
            <td><?= $r['status'] ?></td>

            <td>
                <a href="<?= BASE_URL ?>/reservations/delete/<?= $r['id'] ?>"
                   class="btn btn-danger"
                   onclick="return confirm('Annuler ?')">
                    ❌ Annuler
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
    <p>Aucune réservation</p>
<?php endif; ?>

</div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>