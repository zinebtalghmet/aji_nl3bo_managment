<?php include __DIR__ . '/../includes/header.php'; ?>

<h1>🪑 Gestion des tables</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>Numéro</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php foreach ($tables as $table): ?>
        <tr>
            <td><?= htmlspecialchars($table['number']) ?></td>

            <td>
                <form method="POST" action="<?= BASE_URL ?>/tables/update/<?= $table['id'] ?>">
                    <select name="status">
                        <option value="free" <?= $table['status'] === 'free' ? 'selected' : '' ?>>
                            Libre
                        </option>
                        <option value="occupied" <?= $table['status'] === 'occupied' ? 'selected' : '' ?>>
                            Occupée
                        </option>
                    </select>
            </td>

            <td>
                    <button type="submit">💾 Modifier</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>