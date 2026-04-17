<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="dashboard-container">

    <div class="card-header" style="margin-bottom:24px;">
        <h2 class="card-title">📋 Historique des sessions</h2>
        <a href="<?= BASE_URL ?>/admin/sessions" class="btn btn-ghost">
            ← Retour dashboard
        </a>
    </div>

    <?php if (empty($sessions)): ?>
        <div class="empty-state">
            <div class="empty-icon">📋</div>
            <div class="empty-title">Aucune session terminée</div>
            <div class="empty-desc">Les sessions terminées apparaîtront ici.</div>
        </div>

    <?php else: ?>
        <div class="card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Jeu</th>
                    <th>Table</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Durée</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sessions as $session): ?>
                    <tr>
                        <td><?= $session['id'] ?></td>
                        <td><strong><?= htmlspecialchars($session['client_name']) ?></strong></td>
                        <td><span class="badge badge-blue"><?= htmlspecialchars($session['game_name']) ?></span></td>
                        <td><?= htmlspecialchars($session['table_number']) ?></td>
                        <td><?= date('d/m H:i', strtotime($session['start_time'])) ?></td>
                        <td><?= date('d/m H:i', strtotime($session['end_time'])) ?></td>
                        <td><span class="badge badge-gray"><?= $session['duration_minutes'] ?> min</span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
