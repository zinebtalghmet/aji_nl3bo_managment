<?php include __DIR__ . '/../includes/header.php'; ?>

<main>
    <div class="dashboard-container">

        <!-- Header -->
        <div class="dashboard-header">
            <div>
                <h1 class="dashboard-title">⚙️ Dashboard Admin</h1>
                <p class="dashboard-subtitle">Bienvenue, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong> 👋</p>
            </div>
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <a href="<?= BASE_URL ?>/games/create" class="btn btn-primary">
                    <i class="fa-solid fa-gamepad"></i> Ajouter un jeu
                </a>
                <a href="<?= BASE_URL ?>/categories/create" class="btn btn-ghost">
                    <i class="fa-solid fa-folder-plus"></i> Ajouter une catégorie
                </a>
                <a href="<?= BASE_URL ?>/reservations" class="btn btn-primary">
                     Voir les réservations
                </a>
                <a href="<?= BASE_URL ?>/admin/sessions" class="btn btn-primary">
                    <i class="fa-solid fa-play"></i> Sessions
                </a>
                <a href="<?= BASE_URL ?>/tables">
    🪑 Gérer les tables
</a>
                <a href="<?= BASE_URL ?>/logout" class="btn btn-danger">
                    <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
                </a>
            </div>
        </div>

        <!-- Stat Cards -->
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
                <div class="stat-value"><?= count(array_filter($games, fn($g) => ($g['status'] ?? '') === 'disponible')) ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Indisponibles</div>
                <div class="stat-value"><?= count(array_filter($games, fn($g) => ($g['status'] ?? '') !== 'disponible')) ?></div>
            </div>
        </div>

        <!-- Catégories -->
        <div class="card">
            <div class="card-header">
                <span class="card-title"><i class="fa-solid fa-folder"></i> Catégories</span>
                <a href="<?= BASE_URL ?>/categories/create" class="btn btn-ghost" style="padding:6px 14px;font-size:12px;">
                    <i class="fa-solid fa-plus"></i> Nouvelle
                </a>
            </div>

            <?php if (!empty($categories)): ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= htmlspecialchars($category['id']) ?></td>
                        <td>
                            <span class="badge badge-purple">
                                <i class="fa-solid fa-tag"></i>
                                <?= htmlspecialchars($category['name']) ?>
                            </span>
                        </td>
                        <td style="display:flex;gap:8px;">
                            <a href="<?= BASE_URL ?>/categories/edit/<?= $category['id'] ?>"
                               class="btn btn-ghost" style="padding:6px 12px;font-size:12px;">
                                <i class="fa-solid fa-pen"></i> Modifier
                            </a>
                            <a href="<?= BASE_URL ?>/categories/destroy/<?= $category['id'] ?>"
                               class="btn btn-danger" style="padding:6px 12px;font-size:12px;"
                               onclick="return confirm('Supprimer cette catégorie ?')">
                                <i class="fa-solid fa-trash"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">📂</div>
                <div class="empty-title">Aucune catégorie</div>
                <div class="empty-desc">Commencez par créer une catégorie.</div>
                <a href="<?= BASE_URL ?>/categories/create" class="btn btn-primary" style="margin-top:16px;">
                    <i class="fa-solid fa-plus"></i> Créer une catégorie
                </a>
            </div>
            <?php endif; ?>
        </div>

        <!-- Jeux -->
        <div class="card">
            <div class="card-header">
                <span class="card-title"><i class="fa-solid fa-gamepad"></i> Jeux 🎮</span>
                <a href="<?= BASE_URL ?>/games/create" class="btn btn-primary" style="padding:6px 14px;font-size:12px;">
                    <i class="fa-solid fa-plus"></i> Nouveau jeu
                </a>
            </div>

            <?php if (!empty($games)): ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Durée</th>
                        <th>Difficulté</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($games as $game): ?>
                    <tr>
                        <td><?= htmlspecialchars($game['id']) ?></td>
                        <td><strong><?= htmlspecialchars($game['name']) ?></strong></td>
                        <td>
                            <span class="badge badge-blue">
                                <?= htmlspecialchars($game['category'] ?? 'Aucune') ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-gray">
                                <i class="fa-regular fa-clock"></i>
                                <?= htmlspecialchars($game['duration']) ?> min
                            </span>
                        </td>
                        <td>
                            <?php
                                $diff = strtolower($game['difficulty'] ?? '');
                                $diffClass = match($diff) {
                                    'facile'    => 'badge-green',
                                    'moyen'     => 'badge-pending',
                                    'difficile' => 'badge-blue',
                                    default     => 'badge-gray',
                                };
                            ?>
                            <span class="badge <?= $diffClass ?>">
                                <?= htmlspecialchars($game['difficulty']) ?>
                            </span>
                        </td>
                        <td>
                            <?php
                                $status = $game['status'] ?? '';
                                if ($status === 'disponible') {
                                    $statusClass = 'badge-green';
                                    $statusLabel = '✅ Disponible';
                                } elseif ($status === 'en_cours') {
                                    $statusClass = 'badge-pending';
                                    $statusLabel = '🎮 En cours';
                                } elseif ($status === 'maintenance') {
                                    $statusClass = 'badge-gray';
                                    $statusLabel = '🔧 Maintenance';
                                } else {
                                    $statusClass = 'badge-gray';
                                    $statusLabel = '❌ Indisponible';
                                }
                            ?>
                            <span class="badge <?= $statusClass ?>"><?= $statusLabel ?></span>
                        </td>
                        <td style="display:flex;gap:8px;">
                            <a href="<?= BASE_URL ?>/games/show/<?= $game['id'] ?>"
                               class="btn btn-ghost" style="padding:6px 10px;font-size:12px;" title="Voir">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="<?= BASE_URL ?>/games/edit/<?= $game['id'] ?>"
                               class="btn btn-ghost" style="padding:6px 10px;font-size:12px;" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="<?= BASE_URL ?>/games/destroy/<?= $game['id'] ?>"
                               class="btn btn-danger" style="padding:6px 10px;font-size:12px;" title="Supprimer"
                               onclick="return confirm('Supprimer ce jeu ?')">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">🎮</div>
                <div class="empty-title">Aucun jeu trouvé</div>
                <div class="empty-desc">Ajoutez votre premier jeu au catalogue.</div>
                <a href="<?= BASE_URL ?>/games/create" class="btn btn-primary" style="margin-top:16px;">
                    <i class="fa-solid fa-plus"></i> Ajouter un jeu
                </a>
            </div>
            <?php endif; ?>
        </div>

    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>