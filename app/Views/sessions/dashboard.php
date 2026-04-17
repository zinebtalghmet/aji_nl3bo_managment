<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="dashboard-container">

    <div class="dashboard-header" style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h1 class="dashboard-title">📺 Sessions actives</h1>
            <p class="dashboard-subtitle">Gérez les sessions de jeux en cours</p>
        </div>
        <div style="display:flex; gap:10px;">
            <a href="<?= BASE_URL ?>/admin/sessions/create" class="btn btn-primary">
                <i class="fa-solid fa-play"></i> Démarrer une session
            </a>
            <a href="<?= BASE_URL ?>/admin/sessions/history" class="btn btn-ghost">
                <i class="fa-solid fa-clock-rotate-left"></i> Historique
            </a>
            <a href="<?= BASE_URL ?>/dashboard/admin" class="btn btn-ghost">
                <i class="fa-solid fa-arrow-left"></i> Dashboard
            </a>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-title">Sessions Actives</div>
            <div class="stat-value"><?= count($sessions) ?></div>
        </div>
    </div>

    <?php if (empty($sessions)): ?>
        <div class="card">
            <div class="empty-state">
                <div class="empty-icon">🎲</div>
                <div class="empty-title">Aucune session active</div>
                <div class="empty-desc">Démarrez une nouvelle session de jeu.</div>
                <a href="<?= BASE_URL ?>/admin/sessions/create" class="btn btn-primary" style="margin-top:16px;">
                    <i class="fa-solid fa-play"></i> Démarrer une session
                </a>
            </div>
        </div>

    <?php else: ?>
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:24px;">
            <?php foreach ($sessions as $session): ?>
                <div style="background:white; border-radius:var(--radius-xl); border:1px solid var(--border); box-shadow:var(--shadow-sm); overflow:hidden; transition:box-shadow 0.2s ease, transform 0.2s ease;"
                     onmouseover="this.style.boxShadow='var(--shadow-lg)';this.style.transform='translateY(-3px)'"
                     onmouseout="this.style.boxShadow='var(--shadow-sm)';this.style.transform='translateY(0)'">

                    <!-- Header card -->
                    <div style="background:linear-gradient(135deg, #10b981, #059669); padding:14px 20px; display:flex; justify-content:space-between; align-items:center;">
                        <span style="color:white; font-size:13px; font-weight:600;">🟢 Active</span>
                        <span style="color:white; font-size:14px; font-weight:700;"
                              id="timer-<?= $session['id'] ?>"
                              data-start="<?= $session['start_time'] ?>"
                              data-duration="<?= $session['duration'] ?? 60 ?>">
                            ⏱️ Chargement...
                        </span>
                    </div>

                    <!-- Body -->
                    <div style="padding:20px;">
                        <h3 style="font-size:17px; font-weight:700; color:var(--text-primary); margin-bottom:12px;">
                            🎲 <?= htmlspecialchars($session['game_name']) ?>
                        </h3>

                        <div style="display:flex; flex-direction:column; gap:8px; margin-bottom:16px;">
                            <div style="display:flex; align-items:center; gap:8px;">
                                <span class="badge badge-blue">🍽️ Table <?= $session['table_number'] ?></span>
                            </div>
                            <div style="display:flex; align-items:center; gap:8px;">
                                <span class="badge badge-purple">👤 <?= htmlspecialchars($session['client_name']) ?></span>
                            </div>
                            <div style="display:flex; align-items:center; gap:8px;">
                                <span class="badge badge-gray">🕐 Début: <?= date('H:i', strtotime($session['start_time'])) ?></span>
                            </div>
                        </div>

                        <!-- Bouton terminer -->
                        <form action="<?= BASE_URL ?>/admin/sessions/<?= $session['id'] ?>/end"
                              method="POST"
                              onsubmit="return confirm('Terminer cette session ?')">
                            <button type="submit" class="btn btn-danger" style="width:100%; justify-content:center;">
                                <i class="fa-solid fa-stop"></i> Terminer la session
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<script>
function updateTimers() {
    document.querySelectorAll('[id^="timer-"]').forEach(function(el) {
        var start = new Date(el.dataset.start).getTime();
        var duration = parseInt(el.dataset.duration) * 60 * 1000;
        var end = start + duration;
        var now = new Date().getTime();
        var remaining = end - now;

        if (remaining <= 0) {
            el.innerHTML = '🔴 Temps écoulé!';
            el.closest('div[style*="background:linear-gradient"]').style.background = 'linear-gradient(135deg, #ef4444, #dc2626)';
        } else {
            var min = Math.floor(remaining / 60000);
            var sec = Math.floor((remaining % 60000) / 1000);
            el.innerHTML = '⏱️ ' + min + ':' + (sec < 10 ? '0' + sec : sec) + ' restant';
        }
    });
}

updateTimers();
setInterval(updateTimers, 1000);
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
