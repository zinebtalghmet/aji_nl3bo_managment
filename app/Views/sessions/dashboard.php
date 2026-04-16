<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="admin-container">

    <div class="page-header">
        <h2>📺 Sessions actives</h2>
        <a href="/aji_nl3bo_managment/admin/sessions/create" class="btn btn-primary">
            ▶️ Démarrer une session
        </a>
    </div>

    <?php if (empty($sessions)): ?>
        <div class="empty-state">
            <p>🎲 Aucune session active pour le moment.</p>
            <a href="/aji_nl3bo_managment/admin/sessions/create" class="btn btn-primary">
                Démarrer une session
            </a>
        </div>

    <?php else: ?>
        <div class="sessions-grid">
            <?php foreach ($sessions as $session): ?>
                <div class="session-card">

                    <div class="session-card-header">
                        <span class="badge badge-active">🟢 Active</span>
                        <span class="session-time">
                            ⏱️ <?= $session['elapsed_minutes'] ?> min
                        </span>
                    </div>

                    <div class="session-card-body">
                        <h3>🎲 <?= htmlspecialchars($session['game_name']) ?></h3>
                        <p>🍽️ Table <?= htmlspecialchars($session['table_number']) ?></p>
                        <p>👤 <?= htmlspecialchars($session['client_name']) ?></p>
                        <p>👥 <?= $session['number_of_people'] ?> personnes</p>
                        <p>🕐 Début : <?= date('H:i', strtotime($session['start_time'])) ?></p>
                    </div>

                    <div class="session-card-footer">
                        <form action="/aji_nl3bo_managment/admin/sessions/<?= $session['id'] ?>/end"
                              method="POST"
                              onsubmit="return confirm('Terminer cette session ?')">
                            <button type="submit" class="btn btn-danger btn-full">
                                ⏹️ Terminer la session
                            </button>
                        </form>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="history-link">
        <a href="/aji_nl3bo_managment/admin/sessions/history">
            📋 Voir l'historique complet →
        </a>
    </div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>