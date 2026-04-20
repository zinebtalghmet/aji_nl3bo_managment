<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="dashboard-container">

    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title">🪑 Gestion des tables</h1>
            <p class="dashboard-subtitle">Gérez le statut des tables du café</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><span class="card-title">Liste des tables</span></div>
        <table class="data-table">
            <thead><tr><th>Numéro</th><th>Capacité</th><th>Statut</th><th>Action</th></tr></thead>
            <tbody>
            <?php foreach ($tables as $table): ?>
                <tr>
                    <td><strong>Table <?= htmlspecialchars($table['number']) ?></strong></td>
                    <td><span class="badge badge-gray"><?= $table['capacity'] ?> pers.</span></td>
                    <td>
                        <?php if ($table['status'] === 'free'): ?>
                            <span class="badge badge-green">🟢 Libre</span>
                        <?php else: ?>
                            <span class="badge badge-red">🔴 Occupée</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form method="POST" action="<?= BASE_URL ?>/tables/update/<?= $table['id'] ?>"
                              style="display:flex;align-items:center;gap:8px;">
                            <select name="status" class="form-input" style="width:auto;padding:6px 10px;">
                                <option value="free"     <?= $table['status']==='free'     ? 'selected':'' ?>>🟢 Libre</option>
                                <option value="occupied" <?= $table['status']==='occupied' ? 'selected':'' ?>>🔴 Occupée</option>
                            </select>
                            <button type="submit" class="btn btn-ghost btn-sm">💾 Sauver</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>