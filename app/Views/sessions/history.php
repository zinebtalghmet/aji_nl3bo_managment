<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="admin-container">

    <div class="page-header">
        <h2>📋 Historique des sessions</h2>
        <a href="/aji_nl3bo_managment/admin/sessions" class="btn btn-outline">
            ← Retour dashboard
        </a>
    </div>

    <?php if (empty($sessions)): ?>
        <div class="empty-state">
            <p>Aucune session terminée pour le moment.</p>
        </div>

    <?php else: ?>
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
                    <th>Personnes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sessions as $session): ?>
                    <tr>
                        <td><?= $session['id'] ?></td>
                        <td>
                            <?= htmlspecialchars($session['client_name']) ?><br>
                            <small><?= htmlspecialchars($session['client_phone']) ?></small>
                        </td>
                        <td><?= htmlspecialchars($session['game_name']) ?></td>
                        <td>Table <?= htmlspecialchars($session['table_number']) ?></td>
                        <td><?= date('d/m H:i', strtotime($session['start_time'])) ?></td>
                        <td><?= date('d/m H:i', strtotime($session['end_time'])) ?></td>
                        <td><?= $session['duration_minutes'] ?> min</td>
                        <td><?= $session['number_of_people'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>