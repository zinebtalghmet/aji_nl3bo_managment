<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="dashboard-container">

    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title">⚙️ Dashboard Admin</h1>
            <p class="dashboard-subtitle">Bienvenue, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong> 👋</p>
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="<?= BASE_URL ?>/games/create"      class="btn btn-primary">+ Ajouter un jeu</a>
            <a href="<?= BASE_URL ?>/categories/create" class="btn btn-ghost">+ Catégorie</a>
            <a href="<?= BASE_URL ?>/reservations"      class="btn btn-ghost">📅 Réservations</a>
            <a href="<?= BASE_URL ?>/admin/sessions"    class="btn btn-ghost">🕹️ Sessions</a>
            <a href="<?= BASE_URL ?>/tables"            class="btn btn-ghost">🪑 Tables</a>
            <a href="<?= BASE_URL ?>/logout"            class="btn btn-danger">🔓 Déconnexion</a>
        </div>
    </div>

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-title">Total Jeux</div>
            <div class="stat-value"><?= count($games) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Catégories</div>
            <div class="stat-value"><?= count($categories) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Disponibles</div>
            <div class="stat-value"><?= count(array_filter($games, fn($g) => $g['status'] === 'disponible')) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-title">En cours</div>
            <div class="stat-value"><?= count(array_filter($games, fn($g) => $g['status'] === 'en_cours')) ?></div>
        </div>
    </div>

    <!-- CATEGORIES -->
    <div class="card">
        <div class="card-header">
            <span class="card-title">🏷️ Catégories</span>
            <a href="<?= BASE_URL ?>/categories/create" class="btn btn-ghost btn-sm">+ Nouvelle</a>
        </div>
        <?php if (!empty($categories)): ?>
        <table class="data-table">
            <thead><tr><th>#</th><th>Nom</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><span class="badge badge-purple"><?= htmlspecialchars($cat['name']) ?></span></td>
                    <td style="display:flex;gap:8px;">
                        <a href="<?= BASE_URL ?>/categories/edit/<?= $cat['id'] ?>"    class="btn btn-ghost btn-sm">✏️</a>
                        <a href="<?= BASE_URL ?>/categories/destroy/<?= $cat['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Supprimer ?')">🗑️</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <div class="empty-state"><div class="empty-icon">📂</div><div class="empty-title">Aucune catégorie</div></div>
        <?php endif; ?>
    </div>

    <!-- JEUX -->
    <div class="card">
        <div class="card-header">
            <span class="card-title">🎲 Jeux</span>
            <a href="<?= BASE_URL ?>/games/create" class="btn btn-primary btn-sm">+ Nouveau</a>
        </div>
        <?php if (!empty($games)): ?>
        <table class="data-table">
            <thead>
                <tr><th>#</th><th>Nom</th><th>Catégorie</th><th>Durée</th><th>Difficulté</th><th>Statut</th><th>Actions</th></tr>
            </thead>
            <tbody>
            <?php foreach ($games as $game):
                $statusClass = match($game['status']) {
                    'disponible'  => 'badge-green',
                    'en_cours'    => 'badge-pending',
                    'maintenance' => 'badge-gray',
                    default       => 'badge-gray'
                };
                $statusLabel = match($game['status']) {
                    'disponible'  => '✅ Disponible',
                    'en_cours'    => '🎮 En cours',
                    'maintenance' => '🔧 Maintenance',
                    default       => $game['status']
                };
                $diffClass = match($game['difficulty']) {
                    'facile'    => 'badge-green',
                    'moyen'     => 'badge-pending',
                    'difficile' => 'badge-blue',
                    'expert'    => 'badge-red',
                    default     => 'badge-gray'
                };
            ?>
                <tr>
                    <td><?= $game['id'] ?></td>
                    <td><strong><?= htmlspecialchars($game['name']) ?></strong></td>
                    <td><span class="badge badge-blue"><?= htmlspecialchars($game['category'] ?? '—') ?></span></td>
                    <td><span class="badge badge-gray">⏱ <?= $game['duration'] ?> min</span></td>
                    <td><span class="badge <?= $diffClass ?>"><?= htmlspecialchars($game['difficulty']) ?></span></td>
                    <td><span class="badge <?= $statusClass ?>"><?= $statusLabel ?></span></td>
                    <td style="display:flex;gap:8px;">
                        <a href="<?= BASE_URL ?>/games/show/<?= $game['id'] ?>"    class="btn btn-ghost btn-sm">👁️</a>
                        <a href="<?= BASE_URL ?>/games/edit/<?= $game['id'] ?>"    class="btn btn-ghost btn-sm">✏️</a>
                        <a href="<?= BASE_URL ?>/games/destroy/<?= $game['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Supprimer ?')">🗑️</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <div class="empty-state"><div class="empty-icon">🎮</div><div class="empty-title">Aucun jeu</div></div>
        <?php endif; ?>
    </div>

</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>